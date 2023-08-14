<?php

namespace App\Listeners;

use App\Events\RegistrasiSiswaBaru;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Tagihan;

class BuatTagihanSiswaBaru
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegistrasiSiswaBaru $event): void
    {
                // Buat tagihan untuk siswa baru
                Tagihan::create([
                    'user_id' => $event->user->id,
                    'spp_id' => '2', // Ganti sesuai biaya yang diperlukan4
                    'jatuh_tempo' => '',
                    'status' => 'unpaid', // Status awal tagihan
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
    }

    
}
