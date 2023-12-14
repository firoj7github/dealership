<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CommentOutLines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     protected $signature = 'comment:lines';

     protected $description = 'Comment out specific lines in a controller';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controllerPath = app_path('Http/Controllers/Admin/TestController.php');
        $content = file_get_contents($controllerPath);
// dd($content);
        $content = str_replace("use App\Http\Controllers\Controller;", '// Omor I love you', $content);
        file_put_contents($controllerPath, $content);
        $this->info('Lines commented out successfully.');
        // dd($content);
        return Command::SUCCESS;
    }
}
