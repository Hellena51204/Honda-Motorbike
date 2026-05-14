<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'Honda ra mắt SH 2026 với thiết kế đột phá và động cơ eSP+',
                'image' => 'https://images.unsplash.com/photo-1622185135505-2d795003994a?w=800&auto=format&fit=crop',
                'summary' => 'Mẫu xe ga cao cấp Honda SH 2026 vừa chính thức được giới thiệu với hàng loạt nâng cấp về công nghệ, an toàn và kiểu dáng, hứa hẹn tiếp tục thống trị phân khúc.',
                'content' => 'Nội dung chi tiết của bài viết sẽ được hiển thị ở đây. Bạn có thể chèn các thẻ HTML như <b>in đậm</b> hoặc <i>in nghiêng</i> để bài viết sinh động hơn.',
                'author' => 'Honda Vietnam',
                'is_featured' => true, // Đánh dấu là nổi bật để hiện ra trang chủ
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Bảo dưỡng xe máy định kỳ: 5 mốc quan trọng không thể bỏ qua',
                'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800&auto=format&fit=crop',
                'summary' => 'Để chiếc xe Honda của bạn luôn bền bỉ và vận hành êm ái, việc ghi nhớ 5 cột mốc bảo dưỡng định kỳ này là vô cùng quan trọng.',
                'content' => 'Bao gồm các hạng mục: Thay nhớt máy, thay nhớt hộp số (xe ga), kiểm tra nước làm mát, vệ sinh nồi/nhông sên dĩa và thay lọc gió.',
                'author' => 'Chuyên gia kỹ thuật',
                'is_featured' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Hành trình chinh phục Tây Bắc cùng Honda Winner X',
                'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=800&auto=format&fit=crop',
                'summary' => 'Trải nghiệm thực tế sức mạnh và khả năng bứt tốc của Honda Winner X trên những cung đường đèo hiểm trở bậc nhất Việt Nam.',
                'content' => 'Winner X mang lại cảm giác lái đầm chắc, hệ thống phanh ABS hoạt động cực kỳ hiệu quả khi đổ đèo...',
                'author' => 'Phượt thủ',
                'is_featured' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Công nghệ phanh ABS trên xe máy hoạt động như thế nào?',
                'image' => 'https://images.unsplash.com/photo-1590005354167-6da97ce7b4dc?w=800&auto=format&fit=crop',
                'summary' => 'Hệ thống chống bó cứng phanh (ABS) là một trang bị an toàn tối quan trọng. Hãy cùng tìm hiểu cơ chế hoạt động của nó.',
                'content' => 'ABS sử dụng các cảm biến tốc độ ở bánh xe để phát hiện nguy cơ trượt, từ đó nhấp/nhả phanh liên tục hàng chục lần mỗi giây...',
                'author' => 'Honda Vietnam',
                'is_featured' => false, // Cái này không nổi bật, chỉ hiện trong trang Blog
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ]
        ]);
    }
}