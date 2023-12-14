<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CSVDownloadController extends Controller
{
    public function downloadCSVFromFTP(Request $request)
    {

        $ftpHost   = '64.209.142.168';
        $ftpUsername = 'localcar_homenet';
        $ftpPassword = '6n65AraH';

        // open an FTP connection
        $connId = ftp_connect($ftpHost) or die("Couldn't connect to $ftpHost");
        // // Storage::disk('ftp')->allFiles('path/on/ftp/server');
        // $contents = Storage::disk('ftp')->allFiles('localcar_homenet');
        // var_dump($contents);
        // try to login
// Try to login
        $loginResult = ftp_login($connId, $ftpUsername, $ftpPassword);

        if (!$loginResult) {
            die("Couldn't login with username $ftpUsername");
        }

        $contents = ftp_nlist($connId, ".");

        // local & server file path
        $localFilePath  = public_path('frontend/images/inventory/');
        $remoteFilePath = '/localcar_homenet';

        // Storage::disk('ftp')->get($remoteFilePath, $localFilePath);
        Storage::disk('ftp')->put($remoteFilePath, file_get_contents($localFilePath));
        // try to download a file from server
        // $localFilePath = 'C:\laragon\www\localcarzz\public\frontend/images/inventory/file.txt';
        //  ftp_get($connId, $localFilePath, $remoteFilePath, FTP_BINARY);

        // if(ftp_get($connId, $localFilePath, $remoteFilePath, FTP_BINARY)){
        //     echo "File transfer successful - $localFilePath";
        // }else{
        //     echo "There was an error while downloading $localFilePath";
        // }
        dd($connId);


        // $fileName = 'homenetauto.csv'; // Specify the CSV file name
        // $filePath = 'localcar_homenet/homenetauto.csv'; // Specify the file path on the FTP server

        // $fileContent  = Storage::disk('ftp')->download($filePath, $fileName); // Download the file

        // //         // Set the appropriate headers for the response
        // //         // $headers = [
        // //         //     'Content-Type' => 'text/csv',
        // //         //     'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        // //         // ];
        
        // //         // Return the file content as a response
        // return response($fileContent, 200);

        // // if(Storage::disk('public')->exists(public_path('frontend/images/inventory/')))
        // // {
        // //     $path = Storage::disk('public')->path(public_path('frontend/images/inventory/'));
        // //     $content = file_get_contents($path);
        // //     return response()->$content->withHeaders([
        // //         'Content-Type' => mime_content_type($path),
        // //     ]);
            
        // //     return redirect('/404');
        // // }

    }
}
