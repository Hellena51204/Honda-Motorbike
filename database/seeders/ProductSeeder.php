<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Honda Vision',
            'category' => 'Xe Tay Ga',
            'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070',
            'description' => 'Honda Vision mang đến phong cách trẻ trung, thanh lịch, là mẫu xe tay ga hoàn hảo cho việc di chuyển linh hoạt trong đô thị...',
            'price' => 29900000,
            'colors' => ['#cc0000', '#000000', '#ffffff']
        ]);

        Product::create([
            'name' => 'Honda Air Blade',
            'category' => 'Xe Tay Ga',
            'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2070',
            'description' => 'Honda Air Blade sở hữu các tính năng cao cấp cùng kiểu dáng thể thao. Khối động cơ 125cc mạnh mẽ...',
            'price' => 43900000,
            'colors' => ['#ffffff', '#cc0000', '#000000']
        ]);

        Product::create([
            'name' => 'Honda SH',
            'category' => 'Tay Ga Cao Cấp',
            'image' => 'https://images.unsplash.com/photo-1449426468159-d96dbf08f19f?q=80&w=2070',
            'description' => 'Honda SH đại diện cho đỉnh cao của thiết kế xe tay ga cao cấp. Lấy cảm hứng từ phong cách Ý sang trọng...',
            'price' => 95900000,
            'colors' => ['#000000', '#ffffff', '#990000']
        ]);

        Product::create([
            'name' => 'Honda Winner X',
            'category' => 'Xe Thể Thao',
            'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bfce87?q=80&w=2070',
            'description' => 'Honda Winner X được thiết kế dành cho những ai khao khát hiệu suất thể thao và kiểu dáng mạnh mẽ...',
            'price' => 46900000,
            'colors' => ['#cc0000', '#000000', '#ffffff']
        ]);
    }
}