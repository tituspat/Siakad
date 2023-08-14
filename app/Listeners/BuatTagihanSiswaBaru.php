<?php

namespace App\Listeners;

use App\Events\RegistrasiSiswaBaru;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Bill;

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
                Bill::create([
                    'user_id' => $event->user->id,
                    'amount' => 100000, // Ganti sesuai biaya yang diperlukan
                    'status' => 'unpaid', // Status awal tagihan
                ]);
    }

    
}
