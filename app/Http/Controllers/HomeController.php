<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;

class HomeController extends Controller
{
    // Hiển thị giao diện trang chủ
    public function index()
    {
        // Truy xuất 4 sản phẩm mới nhất từ cơ sở dữ liệu để làm sản phẩm nổi bật
        $featuredProducts = Product::latest()->take(4)->get();
        
        // Lấy danh sách 3 bài viết nổi bật để hiển thị trên trang chủ
        $featuredPosts = Post::where('is_featured', true)->latest()->take(3)->get();

        return view('home', compact('featuredProducts', 'featuredPosts'));
    }
}
