<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('babs')->insert([
            ['nama' => 'Abstrak'],
            ['nama' => 'Bab 1'],
            ['nama' => 'Bab 2'],
            ['nama' => 'Bab 3'],
            ['nama' => 'Bab 4'],
            ['nama' => 'Bab 5'],
        ]);
    }
}
