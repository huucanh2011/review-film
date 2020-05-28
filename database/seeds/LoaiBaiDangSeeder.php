<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiBaiDangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loai_bai_dangs')->insert([
            ['ten_loai' => 'Tin tức'],
            ['ten_loai' => 'Phân tích'],
            ['ten_loai' => 'Hỏi đáp'],
            ['ten_loai' => 'Chia sẻ'],
        ]);
    }
}
