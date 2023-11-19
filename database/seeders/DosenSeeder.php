<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Data = [
            [
                'nip' => '198608282022031006',
                'nama' => 'Agus Susanto',
                'email' => 'agussusanto@gmail.com',
                'foto' => null
            ],
            [
                'nip' => '195904241986021002',
                'nama' => 'Boko Susilo',
                'email' => 'bokosusilo@gmail.com',
                'foto' => null
            ],
            [
                'nip' => '198101122005011002',
                'nama' => 'Rusdi Efendi',
                'email' => 'rusdiefendi@gmail.com',
                'foto' => null
            ],
            [
                'nip' => '198112222008011011',
                'nama' => 'Aan Erlansari',
                'email' => 'aanerlansari@gmail.com',
                'foto' => null
            ],
        ];
        foreach ($Data as $key => $value) {
            Dosen::create($value);
        }
    }
}
