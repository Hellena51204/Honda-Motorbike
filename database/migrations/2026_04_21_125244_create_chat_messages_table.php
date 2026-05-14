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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable(); // Dành cho khách chưa đăng nhập
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // ID người dùng (nếu đã đăng nhập)
            $table->boolean('is_admin_reply')->default(false); // Xác định xem tin nhắn này là của khách hay của Admin
            $table->text('message'); // Nội dung tin nhắn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
