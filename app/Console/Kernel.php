<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // // $schedule->command('download:csv')->daily();
        // $now = now()->addMinutes(1);
        // $schedule->command('download:csv')->at($now);

    // Schedule the DownloadFile command (adjust the frequency as needed)
    
    // $now = now()->addMinutes(1);
    // $schedule->command('download:file')->at($now);
    
    // $schedule->command('download:file')->hourly();
    // $schedule->command('download:csv')->daily();
    $schedule->command('comment:lines')->daily('15:35');

    // $schedule->command('download:file')->daily();

    // // Schedule the ImportFile command to run after DownloadFile
    // $schedule->command('import:file')->hourly()->after(function () {
    //     // Delete the downloaded file after importing
    //     unlink(storage_path('app/DownloadCsv/file.csv'));
    // });

    // // Schedule the DeleteFileAfter7Days command to run daily
    // $schedule->command('delete:file-after-7-days')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
