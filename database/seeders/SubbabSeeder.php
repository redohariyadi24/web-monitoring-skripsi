<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubbabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subbabs')->insert([
            ['nama' => '1.1 Latar Belakang', 'bab_id' => 2],
            ['nama' => '1.2 Rumusan Masalah', 'bab_id' => 2],
            ['nama' => '1.3 Batasan Masalah', 'bab_id' => 2],
            ['nama' => '1.4 Tujuan Penelitian', 'bab_id' => 2],
            ['nama' => '1.5 Manfaat Penelitian', 'bab_id' => 2],
            ['nama' => '1.6 Sistematika Penulisan', 'bab_id' => 2],
            ['nama' => '2.1 Landasan Teori', 'bab_id' => 3],
            ['nama' => '2.2 Kajian Pustaka', 'bab_id' => 3],
            ['nama' => '2.3 Kerangka Pemikiran', 'bab_id' => 3],
            ['nama' => '2.4 Hipotesis Penelitian', 'bab_id' => 3],
            ['nama' => '3.1 Jenis Penelitian', 'bab_id' => 4],
            ['nama' => '3.2 Lokasi Penelitian', 'bab_id' => 4],
            ['nama' => '3.3 Definisi Operasional Variabel', 'bab_id' => 4],
            ['nama' => '3.4 Populasi dan Sampel', 'bab_id' => 4],
            ['nama' => '3.5 Metode Pengumpulan Data', 'bab_id' => 4],
            ['nama' => '3.6 Metode Analisis Data', 'bab_id' => 4],
            ['nama' => '4.1 Analisis Data', 'bab_id' => 5],
            ['nama' => '4.2 Pembahasan Penelitian', 'bab_id' => 5],
            ['nama' => '5.1 Kesimpulan', 'bab_id' => 6],
            ['nama' => '5.2 Saran', 'bab_id' => 6],
        ]);
    }
}
