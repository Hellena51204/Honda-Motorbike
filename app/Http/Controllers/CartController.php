<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Hàm hiển thị trang Giỏ hàng
    public function index()
    {
        // Lấy giỏ hàng từ session (phiên làm việc), nếu không có thì trả về mảng rỗng []
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart', compact('cart', 'total'));
    }

    // Hàm xử lý việc Thêm một sản phẩm vào Giỏ hàng
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $cart = session()->get('cart', []);
        
        // Nếu sản phẩm đã có trong giỏ hàng, chỉ cần tăng số lượng (quantity) lên 1
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        // Nếu sản phẩm chưa có trong giỏ hàng, tạo mới một mục sản phẩm với số lượng là 1
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

    // Hàm xử lý việc Xóa một sản phẩm khỏi Giỏ hàng
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
