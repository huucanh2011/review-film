<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DoTuoiSeeder::class,
            GoiDangKySeeder::class,
            LoaiBaiDangSeeder::class,
            QuocGiaTableSeeder::class,
            QuyenSeeder::class,
            TheLoaiSeeder::class,
            UserSeeder::class,
        ]);
    }
}
