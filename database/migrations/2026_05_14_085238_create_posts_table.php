<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable(); // Ảnh đại diện bài viết
            $table->text('summary')->nullable(); // Tóm tắt ngắn để hiện ở trang chủ
            $table->longText('content');         // Nội dung chi tiết
            $table->string('author')->nullable();
            $table->boolean('is_featured')->default(false); // Để đánh dấu bài viết nổi bật
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};