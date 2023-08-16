<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Spp;
use App\Models\Tagihan;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Ambil siswa yang belum memiliki tagihan untuk bulan ini
            $siswas = Siswa::doesntHave('tagihans')->get();
    
            foreach ($siswas as $siswa) {
                $jenisSppLama = 'lama';
                $nominalLama = 250000; // ganti dengan nominal yang sesuai
    
                Tagihan::create([
                    'no_induk_siswa' => $siswa->id,
                    'spp_id' => Spp::where('jenis_spp', $jenisSppLama)->first()->id,
                    'jatuh_tempo' => now()->addDays(10), // Menambahkan tagihan pada tanggal 10 bulan berikutnya
                    'status' => 'unpaid',
                ]);
            }
        })->monthlyOn(10, '00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
