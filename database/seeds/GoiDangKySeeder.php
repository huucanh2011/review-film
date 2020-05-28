<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoiDangKySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goi_dang_kys')->insert([
            ['ten_goi' => '10 phim - 300,000 VNĐ - 1 tháng', 'so_luong_phim' => 10, 'thang' => 1],
            ['ten_goi' => '20 phim - 500,000 VNĐ - 1 tháng', 'so_luong_phim' => 20, 'thang' => 1],
            ['ten_goi' => '20 phim - 600,000 VNĐ - 1 tháng', 'so_luong_phim' => 30, 'thang' => 1],
        ]);
    }
}
