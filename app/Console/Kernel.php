<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $bills = Bill::where('status', 'unpaid')
                ->where('due_date', '<=', Carbon::now())
                ->get();
    
            foreach ($bills as $bill) {
                // Update status tagihan menjadi "pending" jika jatuh tempo sudah lewat
                $bill->update(['status' => 'pending']);
            }
        })->monthly();
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
