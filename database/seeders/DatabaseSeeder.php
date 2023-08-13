<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GuruSeeder::class,
            KelasSeeder::class,
            SppSeeder::class,
            SiswaSeeder::class,
            KehadiranSeeder::class,
            RuangSeeder::class,
            HariSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
