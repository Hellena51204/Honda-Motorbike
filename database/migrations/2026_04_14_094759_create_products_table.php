<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // Phân loại: Xe Tay Ga, Xe Thể Thao...
            $table->string('image');
            $table->text('description');
            $table->decimal('price', 15, 2); // Giá tiền
            $table->string('year')->default('2024');
            $table->json('colors')->nullable(); // Lưu mã màu dạng mảng
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};