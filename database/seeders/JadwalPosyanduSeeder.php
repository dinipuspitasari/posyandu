<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_posyandu')->insert([
            [
                'nama_kegiatan' => 'Penimbangan Balita',
                'tanggal'       => '2025-06-05',
                'waktu'         => '08:00:00',
                'lokasi'        => 'Balai RW 03',
                'keterangan'    => 'Bawa KMS dan alat tulis',
                'id_petugas'    => 1, // pastikan ID petugas 1 ada
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'nama_kegiatan' => 'Imunisasi DPT',
                'tanggal'       => '2025-06-12',
                'waktu'         => '09:00:00',
                'lokasi'        => 'Posyandu Melati',
                'keterangan'    => 'Balita umur 2-5 bulan',
                'id_petugas'    => 2, // pastikan ID petugas 2 ada
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
