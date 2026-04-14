<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Gọi Model Product vào

class ProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm từ Database
        $products = Product::all();

        // Gửi biến $products sang file view products.blade.php
        return view('products', compact('products'));
    }
}