<?php

namespace Database\Seeders;

use App\Models\Skripsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Data = [
            [
                'mahasiswa_id' => 5,
                'dosen1_id' => 1,
                'dosen2_id' => 2,
                'judul' => 'Sistem Informasi Penyewaan Lapangan Bencolen Mall',
                'progres' => 100
            ],
            [
                'mahasiswa_id' => 3,
                'dosen1_id' => 2,
                'dosen2_id' => 3,
                'judul' => 'Sistem Informasi Pengelolaan Kost-kostan',
                'progres' => 100
            ],
            [
                'mahasiswa_id' => 4,
                'dosen1_id' => 4,
                'dosen2_id' => 3,
                'judul' => 'Pengaruh Waktu Tidur Terhadap Kenerja Coding Mahasiswa TI',
                'progres' => 0
            ],
        ];
        foreach ($Data as $key => $value) {
            Skripsi::create($value);
        }
    }
}
