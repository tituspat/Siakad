<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('siswa')->insert([
            'no_induk' => '000001',
            'nama_siswa' => 'Siswa TK',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'kelas_id' => '1',
            'id_spp' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('siswa')->insert([
            'no_induk' => '000002',
            'nama_siswa' => 'Siswa 1 SD',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'kelas_id' => '2',
            'id_spp' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
