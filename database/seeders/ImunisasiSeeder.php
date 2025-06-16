<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImunisasiSeeder extends Seeder
{
    public function run()
    {
        DB::table('imunisasi')->insert([
            ['name' => 'Hepatitis B'],
            ['name' => 'BCH'],
            ['name' => 'Polio tetes 1'],
            ['name' => 'DPT-HB-Hib 1'],
            ['name' => 'Polio tetes 2'],
            ['name' => 'DPT-HB-Hib 2'],
            ['name' => 'Polio Tetes 3'],
            ['name' => 'DPT-HB-Hib 3'],
            ['name' => 'Polio Tetes 4'],
            ['name' => 'Polio suntik (IPV)'],
            ['name' => 'Campak-Rubella (MR)'],
            ['name' => 'DPT-Hib-HB lanjutan'],
            ['name' => 'Campak-Rubella (MR) lanjutan'],
            ['name' => 'PCV 1'],
            ['name' => 'PCV 2'],
            ['name' => 'Japanese Encephalitis'],
            ['name' => 'PCV 3'],
        ]);
    }
}