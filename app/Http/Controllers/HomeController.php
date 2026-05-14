<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;

class HomeController extends Controller
{
    // Hàm hiển thị Trang chủ
    public function index()
    {
        // Lấy 4 sản phẩm mới nhất làm sản phẩm nổi bật
        $featuredProducts = Product::latest()->take(4)->get();
        
        // Lấy 3 bài viết được đánh dấu nổi bật
        $featuredPosts = Post::where('is_featured', true)->latest()->take(3)->get();

        return view('home', compact('featuredProducts', 'featuredPosts'));
    }
}
