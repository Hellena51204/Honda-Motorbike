<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Kiểm tra quyền admin để truy xuất toàn bộ đơn hàng
        if (Auth::user()->role === 'admin') {
            $orders = Order::with(['user', 'items'])->orderBy('created_at', 'desc')->get();
            return view('admin.orders.index', compact('orders'));
        }

        // Khách hàng thông thường chỉ xem được danh sách đơn của cá nhân
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Lấy thông tin chi tiết của đơn hàng
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
