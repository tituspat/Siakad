<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spp')->insert([
            'jenis_spp' => 'Siswa Lama',
            'nominal' => 250000
        ]);
        DB::table('spp')->insert([
            'jenis_spp' => 'Siswa Baru',
            'nominal' => 300000
        ]);
    }
}
