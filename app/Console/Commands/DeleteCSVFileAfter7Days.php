<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteCSVFileAfter7Days extends Command
{
    protected $signature = 'delete:file-after-7-days';

    protected $description = 'Delete files older than 7 days';

    public function handle()
    {
        // Define the directory containing the files
        $directory = storage_path('app/DownloadCsv');

        // Get the current timestamp
        $currentTimestamp = time();

        // Iterate through files in the directory
        foreach (scandir($directory) as $file) {
            $filePath = $directory . '/' . $file;

            // Check if it's a file and older than 7 days
            if (is_file($filePath) && filemtime($filePath) < ($currentTimestamp - 7 * 24 * 60 * 60)) {
                unlink($filePath);
            }
        }

        $this->info('Files older than 7 days deleted.');

        // return Command::SUCCESS;
    }
}
