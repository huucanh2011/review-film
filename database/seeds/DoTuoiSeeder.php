<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoTuoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('do_tuois')->insert([
            ['ma' => 'P'],
            ['ma' => 'C13'],
            ['ma' => 'C16'],
            ['ma' => 'C18'],
        ]);
    }
}
