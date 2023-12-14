<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpseclib3\Net\SFTP;

class DownloadCSVFile extends Command
{
    protected $signature = 'download:file';

    protected $description = 'Download a file on the server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ip_address = '64.209.142.168';

        $username = 'localcar_homenet';
        $password = '6n65AraH';
        
        // Create an SFTP connection to the remote server
        $sftp = new SFTP($ip_address);
        if (!$sftp->login($username, $password)) {
            $this->error('Failed to login to SFTP.');
            return;
        }
    
        // return 'ok aichi to beshi bujos ken';
        // Define the IP address of the remote server

        $remote_path = '/homenetauto.csv';

        $csv_url = "https://{$username}:{$password}@{$ip_address}{$remote_path}";

        // Download the CSV file
        if ($sftp->get($remote_path, $csv_url)) {
        $this->info('CSV file downloaded successfully.');
        } else {
        $this->error('Failed to download CSV file.');
        }

        // Define the local path to save the downloaded file
        $localPath = storage_path('app/DownloadCsv/file.csv');

        // Download the file
        file_put_contents($localPath, file_get_contents($csv_url));

        $this->info('File downloaded successfully.');
        return Command::SUCCESS;
    }
}
