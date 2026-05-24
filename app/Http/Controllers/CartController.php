<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Hiển thị giao diện trang giỏ hàng
    public function index()
    {
        // Khởi tạo giỏ hàng từ session, trả về mảng rỗng nếu chưa có sản phẩm
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart', compact('cart', 'total'));
    }

    // Xử lý logic thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm này hiện đã tạm hết hàng!');
        }

        $cart = session()->get('cart', []);
        
        // Nếu sản phẩm đã tồn tại trong giỏ thì chỉ tăng số lượng
        if(isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                return redirect()->back()->with('error', 'Số lượng thêm vào vượt quá số lượng tồn kho hiện có!');
            }
            $cart[$id]['quantity']++;
        // Nếu chưa có thì khởi tạo sản phẩm mới lưu vào session
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // Xử lý xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
