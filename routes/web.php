<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Gọi hàm index trong HomeController khi truy cập trang chủ
Route::get('/', [HomeController::class, 'index']);


##Khang
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
