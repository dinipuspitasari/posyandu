<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        FacadesDB::table('users')->insert([
            [
                'name' => 'Test Admin',
                'nik' => '1234567890123457',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Admin Posyandu No. 1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'id_level' => 1, // pastikan id 1 di tabel levels adalah "admin"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kader Posyandu',
                'nik' => '6543210987654322',
                'no_telp' => '082345678901',
                'alamat' => 'Jl. Kader Sehat No. 2',
                'email' => 'kader@gmail.com',
                'password' => Hash::make('kader123'),
                'id_level' => 2, // pastikan id 2 di tabel levels adalah "kader"
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}