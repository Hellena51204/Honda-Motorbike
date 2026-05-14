<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// Các trang thông tin cơ bản cho Khách hàng
Route::get('/', [HomeController::class, 'index'])->name('home');

// Quản lý Sản phẩm (Hiển thị danh sách và chi tiết)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Liên hệ và Gửi tin nhắn cho cửa hàng
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Giỏ hàng (Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Thanh toán Momo
Route::post('/checkout/momo', [CheckoutController::class, 'momoPayment'])->name('checkout.momo')->middleware('auth');
Route::get('/checkout/momo/return', [CheckoutController::class, 'momoReturn'])->name('checkout.momo.return')->middleware('auth');

// Dashboard (cho cả admin và user)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Cập nhật thông tin cá nhân (user)
// Các tính năng yêu cầu người dùng phải đăng nhập mới được sử dụng
Route::middleware('auth')->group(function () {
    Route::patch('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::post('/dashboard/avatar', [DashboardController::class, 'updateAvatar'])->name('dashboard.avatar.update');
});

// Phần quản trị Admin
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::delete('contacts/{contact}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contacts.destroy');

    // Quản lý thành viên
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/membership', [\App\Http\Controllers\Admin\UserController::class, 'updateMembership'])->name('users.membership');
});

// Quản lý thông tin tài khoản và Đơn hàng của người dùng hiện tại
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Lịch sử mua hàng
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Load các route liên quan đến xác thực (Đăng nhập, Đăng ký, Quên mật khẩu...) từ file auth.php
require __DIR__ . '/auth.php';

Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'store']);


Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    // Trang danh sách các cuộc trò chuyện
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'adminIndex'])->name('admin.chat.index');
    // Lấy nội dung chat của một khách cụ thể
    Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'adminShow'])->name('admin.chat.show');
    // Admin gửi tin nhắn trả lời
    Route::post('/chat/reply/{id}', [App\Http\Controllers\ChatController::class, 'adminReply'])->name('admin.chat.reply');
});
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
