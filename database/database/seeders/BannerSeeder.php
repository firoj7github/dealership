<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Banner::factory(15)->create();
        $banners=Banner::insert([
            [
                'name'=>'Middle Banner',
                'image'=>'1696932580.png',
                'banner_price'=>100,
                'start_date'=>'null',
                'end_date'=>'null',
                'status'=>1,
                'payment'=>1,
                'renew'=>'no',
                'position'=>'Middle',
                'user_id'=>3


            ],
            [
                'name'=>'Top Banner',
                'image'=>'1698571179.png',
                'banner_price'=>100,
                'start_date'=>'null',
                'end_date'=>'null',
                'status'=>1,
                'payment'=>1,
                'renew'=>'yes',
                'position'=>'top',
                'user_id'=>4


            ],

            ]);
     }
}
