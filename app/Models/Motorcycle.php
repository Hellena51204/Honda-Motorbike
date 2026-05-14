<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorcycle extends Model
{
    use HasFactory, SoftDeletes;

    // Khai báo các cột được phép nhập dữ liệu
    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'description',
        'status',
    ];
}
