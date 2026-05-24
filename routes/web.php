<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// Nhóm định tuyến các trang thông tin cơ bản
Route::get('/', [HomeController::class, 'index'])->name('home');

// Nhóm định tuyến hiển thị danh mục và chi tiết sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Định tuyến chức năng liên hệ và phản hồi
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Định tuyến các thao tác xử lý giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Nhóm định tuyến tích hợp thanh toán qua ví MoMo
Route::post('/checkout/momo', [CheckoutController::class, 'momoPayment'])->name('checkout.momo')->middleware('auth');
Route::get('/checkout/momo/return', [CheckoutController::class, 'momoReturn'])->name('checkout.momo.return')->middleware('auth');

// Định tuyến giao diện Dashboard chung (yêu cầu xác thực)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Nhóm định tuyến cập nhật thông tin hồ sơ người dùng (yêu cầu xác thực)
Route::middleware('auth')->group(function () {
    Route::patch('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::post('/dashboard/avatar', [DashboardController::class, 'updateAvatar'])->name('dashboard.avatar.update');
});

// Nhóm định tuyến dành riêng cho quyền quản trị viên (Admin)
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::delete('contacts/{contact}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contacts.destroy');

    // Định tuyến chức năng quản lý người dùng
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/membership', [\App\Http\Controllers\Admin\UserController::class, 'updateMembership'])->name('users.membership');
});

// Nhóm định tuyến quản lý tài khoản và theo dõi đơn hàng cá nhân
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Định tuyến lịch sử giao dịch
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Import các định tuyến xác thực từ tệp cấu hình auth.php
require __DIR__ . '/auth.php';

Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'store']);


Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    // Giao diện danh sách phiên hỗ trợ trực tuyến
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'adminIndex'])->name('admin.chat.index');
    // Hiển thị lịch sử trò chuyện của người dùng cụ thể
    Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'adminShow'])->name('admin.chat.show');
    // Xử lý logic gửi tin nhắn phản hồi từ quản trị viên
    Route::post('/chat/reply/{id}', [App\Http\Controllers\ChatController::class, 'adminReply'])->name('admin.chat.reply');
});
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
