<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Seeders\NewsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(SlideSeeder::class);
        $this->call(MembershipSeeder::class);

    }
}
