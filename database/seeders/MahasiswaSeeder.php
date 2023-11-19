<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Data = [
            [
                'npm' => 'G1A021034',
                'nama' => 'Redo Hariyadi',
                'email' => 'redhohariyadi@gmail.com',
                'semester' => 5,
                'foto' => 'g1a021034231119071832.png'
            ],
            [
                'npm' => 'G1A021008',
                'nama' => 'Elisa',
                'email' => 'elisa@gmail.com',
                'semester' => 5,
                'foto' => 'g1a021008231119071832.png'
            ],
            [
                'npm' => 'G1A021019',
                'nama' => 'Rose Enjellina',
                'email' => 'enjellinarose@gmail.com',
                'semester' => 5,
                'foto' => null
            ],
            [
                'npm' => 'G1A021011',
                'nama' => 'Paksi Dwi Jayanto',
                'email' => 'paksidwi01@gmail.com',
                'semester' => 5,
                'foto' => null
            ],
            [
                'npm' => 'G1A021012',
                'nama' => 'Seprina Dwi Cahyani',
                'email' => 'seprinacahyani@gmail.com',
                'semester' => 5,
                'foto' => 'g1a021012231119071832.png'
            ],
        ];
        foreach ($Data as $key => $value) {
            Mahasiswa::create($value);
        }
    }
}
