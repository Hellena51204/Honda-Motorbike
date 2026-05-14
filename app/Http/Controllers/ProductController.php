<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Gọi Model Product để tương tác với Database

class ProductController extends Controller
{
    /**
     * Hàm hiển thị trang Danh sách sản phẩm (products.blade.php)
     */
    public function index()
    {
        // Lấy tất cả sản phẩm từ Database
        $products = Product::all();

        // Gửi biến $products sang file view products.blade.php
        return view('products', compact('products'));
    }

    /**
     * Hàm hiển thị trang Chi tiết sản phẩm (detail.blade.php)
     */
    public function show($id)
    {
        // Tìm sản phẩm trong DB theo ID
        // findOrFail: Nếu khách hàng gõ bừa ID không có thật trên thanh địa chỉ, nó sẽ báo lỗi 404 chứ không sập web
        $product = Product::findOrFail($id);

        // Gửi dữ liệu chiếc xe vừa tìm được sang file detail.blade.php
        return view('detail', compact('product'));
    }
}