<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guru')->insert([
            'id_card' => '00001',
            'nama_guru' => 'Guru TK',
            'jk' => 'P',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00002',
            'nama_guru' => 'Guru 1 SD',
            'jk' => 'P',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00003',
            'nama_guru' => 'Guru 2 SD',
            'jk' => 'P',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00004',
            'nama_guru' => 'Guru 3 SD',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00005',
            'nama_guru' => 'Guru 4 SD',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00006',
            'nama_guru' => 'Guru 5 SD',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00007',
            'nama_guru' => 'Guru 6 SD',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00008',
            'nama_guru' => 'Guru 1 SMP',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00009',
            'nama_guru' => 'Guru 2 SMP',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('guru')->insert([
            'id_card' => '00010',
            'nama_guru' => 'Guru 3 SMP',
            'jk' => 'L',
            'foto' => '/public/img/male.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
