<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specificDate = '2023-11-21T23:00';
        $Data = [
            [
                'tanggal' => $specificDate,
                'skripsi_id' => 1,
                'jenis' => 'Sidang Skripsi',
            ],
        ];
        foreach ($Data as $key => $value) {
            Jadwal::create($value);
        }
    }
}
