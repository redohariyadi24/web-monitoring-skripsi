<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Redo Hariyadi',
                'username' => 'G1A021034',
                'role' => 'mahasiswa',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Seprina Dwi Cahyani',
                'username' => 'G1A021012',
                'role' => 'mahasiswa',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Agus Susanto',
                'username' => '198608282022031006',
                'role' => 'dosen',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Budi',
                'username' => 'Admin01',
                'role' => 'admin',
                'password' => bcrypt('123456')
            ]
        ];
        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}
