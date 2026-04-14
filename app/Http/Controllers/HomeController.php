<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Trả về giao diện trang chủ (nếu bạn kia đã làm file resources/views/home.blade.php)
        return view('home');
    }
}