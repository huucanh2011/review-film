<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TheLoaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('the_loais')->insert([
            ['ten_the_loai' => 'Hành động'],
            ['ten_the_loai' => 'Phiêu lưu'],
            ['ten_the_loai' => 'Hoạt hình'],
            ['ten_the_loai' => 'Tiểu sử'],
            ['ten_the_loai' => 'Hài'],
            ['ten_the_loai' => 'Tội phạm'],
            ['ten_the_loai' => 'Tài liệu'],
            ['ten_the_loai' => 'Chính kịch'],
            ['ten_the_loai' => 'Gia đình'],
            ['ten_the_loai' => 'Thần thoại'],
            ['ten_the_loai' => 'Lịch sử'],
            ['ten_the_loai' => 'Kinh dị'],
            ['ten_the_loai' => 'Âm nhạc/nhạc kịch'],
            ['ten_the_loai' => 'Bí ẩn'],
            ['ten_the_loai' => 'Tình cảm'],
            ['ten_the_loai' => 'Viễn tưởng'],
            ['ten_the_loai' => 'Ngắn'],
            ['ten_the_loai' => 'Thể thao'],
            ['ten_the_loai' => 'Siêu anh hùng'],
            ['ten_the_loai' => 'Giật gân'],
            ['ten_the_loai' => 'Chiến tranh'],
        ]);
    }
}
