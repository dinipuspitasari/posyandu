<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'nama' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'id_level' => 1,
        ]);

        Petugas::create([
            'nama' => 'kader',
            'email' => 'kader@gmail.com',
            'password' => Hash::make('kader123'),
            'id_level' => 2,
        ]);
    }
}
