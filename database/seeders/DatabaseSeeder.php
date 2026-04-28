<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo tự động 1 tài khoản Admin
        User::create([
            'name' => 'Quản trị viên Honda',
            'email' => 'admin@honda.com',
            'password' => bcrypt('12345678'), // Mật khẩu đăng nhập
            'role' => 'admin',
        ]);

        // Tạo tự động 1 tài khoản Khách hàng để test
        User::create([
            'name' => 'User',
            'email' => 'user@honda.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);

        // Tạo dữ liệu xe máy mẫu
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
