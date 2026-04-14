<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Cho phép thêm dữ liệu vào các cột này
    protected $fillable = [
        'name', 'category', 'image', 'description', 'price', 'year', 'colors'
    ];

    // Tự động chuyển đổi cột colors từ JSON (trong DB) sang mảng (trong PHP)
    protected $casts = [
        'colors' => 'array',
    ];
}