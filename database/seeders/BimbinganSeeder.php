<?php

namespace Database\Seeders;

use App\Models\Bimbingan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Data = [
            [
                'nama' => 'Bimbingan 1',
                'tanggal' => '2023-12-01',
                'mahasiswa_id' => 1,
                'skripsi_id' => 1,
                'dospem_id' => 1,
                'bab_id' => 1,
                'status' => 'acc',
            ]
        ];
        foreach ($Data as $key => $value) {
            Bimbingan::create($value);
        }
    }
}
