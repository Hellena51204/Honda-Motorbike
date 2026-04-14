<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController; // Thêm dòng này

Route::get('/', [HomeController::class , 'index']);
Route::get('/products', [ProductController::class , 'index']); // Thêm dòng này