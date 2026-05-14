<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Hàm hiển thị trang danh sách bài viết
    public function index()
    {
        // Lấy bài viết mới nhất, phân trang 9 bài / 1 trang
        $posts = Post::latest()->paginate(9);
        return view('blog.index', compact('posts'));
    }

    // Hàm hiển thị trang chi tiết của 1 bài viết cụ thể
    public function show($id)
    {
        // Tìm bài viết theo ID, nếu không thấy sẽ tự động báo lỗi 404
        $post = Post::findOrFail($id);
        
        // Trả về view show.blade.php kèm dữ liệu $post
        return view('blog.show', compact('post'));
    }
}