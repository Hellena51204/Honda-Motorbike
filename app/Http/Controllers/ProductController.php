<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import model Product để tương tác với cơ sở dữ liệu

class ProductController extends Controller
{
    /**
     * Hiển thị giao diện danh sách toàn bộ sản phẩm
     */
    public function index()
    {
        // Truy xuất tất cả dữ liệu sản phẩm từ cơ sở dữ liệu
        $products = Product::all();

        // Truyền biến chứa danh sách sản phẩm sang giao diện view
        return view('products', compact('products'));
    }

    /**
     * Hiển thị giao diện chi tiết của một sản phẩm
     */
    public function show($id)
    {
        // Tìm kiếm sản phẩm theo ID
        // Hàm findOrFail sẽ trả về lỗi 404 nếu không tìm thấy ID sản phẩm, ngăn chặn lỗi hệ thống
        $product = Product::findOrFail($id);

        // Chuyển dữ liệu sản phẩm đã tìm thấy sang giao diện view chi tiết
        return view('detail', compact('product'));
    }
}