<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Lấy danh sách các bài viết để hiển thị trên trang chủ Blog
    public function index()
    {
        // Lấy các bài viết mới nhất và phân trang 9 bài một trang
        $posts = Post::latest()->paginate(9);
        return view('blog.index', compact('posts'));
    }

    // Hiển thị nội dung chi tiết của một bài viết cụ thể
    public function show($id)
    {
        // Tìm kiếm bài viết theo ID, trả về lỗi 404 nếu không tìm thấy
        $post = Post::findOrFail($id);
        
        // Truyền dữ liệu bài viết sang view chi tiết
        return view('blog.show', compact('post'));
    }
}