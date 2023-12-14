<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessCsv extends Command
{

    protected $signature = 'download:csv';

    protected $description = 'Download CSV file from remote server and import into database';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Define the IP address of the remote server
        $ip_address = '64.209.142.168';
        
        // Define the remote path to the CSV file
        $remote_path = 'homenetauto.csv';

        // Define the authentication credentials
        $username = 'localcar_homenet';
        $password = '6n65AraH';

        // Define the local path where you want to save the downloaded CSV file on your PC
        $local_path = env('HOMEPATH') . '\Downloads\file.csv';

        // Escape and construct the full URL with IP address, credentials, and remote path
        $escaped_local_path = escapeshellarg($local_path);
        $csv_url = "http://{$username}:{$password}@{$ip_address}{$remote_path}";

        // Download the CSV file from the remote server
        exec("curl -o {$escaped_local_path} '{$csv_url}'", $output, $returnCode);
        

        // curl -o 'C:\path\to\local\file.csv' -u username:password 'http://101.102.103.104/path/to/remote/file.csv';

        if ($returnCode === 0) {
            $this->info("CSV file downloaded successfully to your local PC's Downloads folder.");

            // Process and import the CSV data into the database (implement your logic here)
            // Example: You can use Laravel's CSV import package to simplify the import.

            // For demonstration purposes, let's assume you have a 'csv_data' table
            // and you want to import the CSV into it.
            $csvData = array_map('str_getcsv', file($local_path));
            // foreach ($csvData as $row) {
            //     DB::table('tmp_inventories')->insert([
            //         'column1' => $row[0], // Adjust column names accordingly
            //         'column2' => $row[1],
            //         // Add more columns as needed
            //     ]);
            // }
            $this->info("CSV data imported into the database.");
        } else {
            $this->error("Error downloading the CSV file.");
        }


        return Command::SUCCESS;
    }
}
