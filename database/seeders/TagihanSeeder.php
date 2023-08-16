<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tagihan')->insert([
            'siswa_id' => '1',
            'spp_id' => 2,
            'jatuh_tempo' => date('Y-m-d'),
            'status' => 'paid',
        ]);
        DB::table('tagihan')->insert([
            'siswa_id' => '2',
            'spp_id' => 2,
            'jatuh_tempo' => date('Y-m-d'),
            'status' => 'paid',
        ]);
    }
}
