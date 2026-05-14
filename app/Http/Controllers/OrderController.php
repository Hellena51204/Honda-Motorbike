<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Kiểm tra nếu người dùng đang đăng nhập là 'admin', lấy toàn bộ đơn hàng trong hệ thống
        if (Auth::user()->role === 'admin') {
            $orders = Order::with(['user', 'items'])->orderBy('created_at', 'desc')->get();
            return view('admin.orders.index', compact('orders'));
        }

        // Nếu là người dùng bình thường, chỉ lấy danh sách các đơn hàng của chính người dùng đó
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Hiển thị chi tiết của một đơn hàng cụ thể
    public function show($id)
    {
        if (Auth::user() && Auth::user()->role === 'admin') {
            $order = Order::with('items')->findOrFail($id);
        } else {
            $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        }
        
        return view('orders.show', compact('order'));
    }
}
