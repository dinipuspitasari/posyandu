<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('levels')->insert([
        ['id_level' => 1, 'name_level' => 'Admin'],
        ['id_level' => 2, 'name_level' => 'Kader'],
        ]);
    }
}

