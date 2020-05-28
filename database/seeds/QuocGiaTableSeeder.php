<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuocGiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quoc_gias')->insert([
            ['ten_quoc_gia' => 'Mỹ'],
            ['ten_quoc_gia' => 'Pháp'],
            ['ten_quoc_gia' => 'Hàn Quốc'],
            ['ten_quoc_gia' => 'Trung Quốc'],
            ['ten_quoc_gia' => 'Hồng Kông'],
            ['ten_quoc_gia' => 'Việt Nam'],
            ['ten_quoc_gia' => 'Nhật Bản'],
            ['ten_quoc_gia' => 'Anh'],
            ['ten_quoc_gia' => 'Ấn Độ'],
            ['ten_quoc_gia' => 'Thái Lan'],
        ]);
    }
}
