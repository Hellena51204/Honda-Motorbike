<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function momoPayment(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($total == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        // Thay bằng credentials thật khi chạy thực tế
        $partnerCode = env('MOMO_PARTNER_CODE', 'MOMO');
        $accessKey = env('MOMO_ACCESS_KEY', 'F8BBA842ECF85');
        $secretKey = env('MOMO_SECRET_KEY', 'K951B6PE1waDMi640xX08PD3vg6EkVlz');

        $orderInfo = "Thanh toán đơn hàng mua xe qua Momo";
        $amount = "50000";
        //-$amount = (string)$total
        $orderId = time() . "";
        $redirectUrl = route('checkout.momo.return');
        $ipnUrl = route('checkout.momo.return');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM"; // Hoặc captureWallet / payWithATM payWithCC

        // Lưu Order vào database với trạng thái pending
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'total_amount' => $total,
            'payment_method' => 'momo',
            'payment_status' => 'pending',
            'momo_order_id' => $orderId
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => is_numeric($id) ? $id : null,
                'product_name' => $item['name'] ?? 'Product',
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Honda Motorbike Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        }

        return redirect()->route('cart.index')->with('error', 'Lỗi khởi tạo thanh toán Momo: ' . ($jsonResult['message'] ?? ''));
    }

    public function momoReturn(Request $request)
    {
        $order = Order::with('items')->where('momo_order_id', $request->orderId)->first();

        if ($request->resultCode == 0) {
            if ($order && $order->payment_status != 'completed') {
                $order->update([
                    'payment_status' => 'completed',
                    'momo_trans_id' => $request->transId ?? null
                ]);

                // Trừ tồn kho sản phẩm và cộng số lượng đã bán
                foreach ($order->items as $item) {
                    $product = \App\Models\Product::find($item->product_id);
                    if ($product) {
                        $product->stock = max(0, $product->stock - $item->quantity);
                        $product->sold += $item->quantity;
                        $product->save();
                    }
                }
            }
            session()->forget('cart'); // Xóa giỏ hàng sau khi thanh toán thành công
            return redirect()->route('home')->with('success', 'Thanh toán đơn hàng thành công qua Momo!');
        } else {
            if ($order && $order->payment_status != 'completed') {
                $order->update([
                    'payment_status' => 'failed'
                ]);
            }
            return redirect()->route('cart.index')->with('error', 'Thanh toán thất bại hoặc đã bị hủy!');
        }
    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
