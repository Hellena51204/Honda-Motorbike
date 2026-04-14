<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController; // Thêm dòng này
use App\Http\Controllers\ContactController;

// Gọi hàm index trong HomeController khi truy cập trang chủ
Route::get('/', [HomeController::class, 'index']);

// === Tuyến đường (Routes) cho Sản phẩm (Products) ===
Route::get('/products', [ProductController::class , 'index']); // Thêm dòng này
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class , 'show'])->name('products.show');

// === Tuyến đường (Routes) cho Liên hệ (Contact) ===
##Khang
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
