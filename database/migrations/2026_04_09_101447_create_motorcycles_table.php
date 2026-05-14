<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên xe (VD: Honda Vision)
            $table->string('category')->nullable(); // Loại xe (VD: Scooter, Sport)
            $table->decimal('price', 15, 2); // Giá bán (Cho phép lưu số tiền tỷ VND)
            $table->string('image')->nullable(); // Tên file ảnh đại diện
            $table->text('description')->nullable(); // Mô tả xe
            $table->string('status')->default('active'); // Trạng thái: active (đang bán), inactive (ngừng bán)
            $table->softDeletes(); // Chức năng xóa mềm (Thùng rác)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycles');
    }
};
