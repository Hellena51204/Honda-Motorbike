<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Hàm hiển thị Trang chủ
    public function index()
    {
        return view('home');
    }
}
