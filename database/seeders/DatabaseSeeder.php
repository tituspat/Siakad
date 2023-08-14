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
            SppSeeder::class,
            SiswaSeeder::class,
            KehadiranSeeder::class,
            HariSeeder::class,
            UsersSeeder::class,
            KelasSeeder::class
        ]);
    }
}
