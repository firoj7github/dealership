<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slides=Slide::insert([
            [
                'title'=>'Become a localcarz seller today',
                'sub_title'=>'Best option for you',
                'url'=>'https://localcarz.com/backend/index.php?controller=banners',
                'description'=>'LocalCarz.com is an independent company that works side by side with consumers, sellers, and dealers for transparency and fairness in the marketplace.Local Carz Vehicle products are based only on information supplied to Local Carz',
                'image'=>'f2.png',
                'slide_start_date'=>'10/05/2023',
                'slide_end_date'=>'10/25/2023',
                'slide_payment'=>1,
                'slide_renew'=>'no',
                'user_id'=>4,
                'status'=>1
            ],
            [
                'title'=>'Become a Top Seller',
                'sub_title'=>'Best option for you',
                'url'=>'https://localcarz.com/backend/index.php?controller=banners',
                'description'=>'LocalCarz.com is an independent company that works side by side with consumers, sellers, and dealers for transparency and fairness in the marketplace.Local Carz Vehicle products are based only on information supplied to Local Carz',
                'image'=>'1701687631.jpg',
                'slide_start_date'=>'12/11/2023',
                'slide_end_date'=>'01/29/2024',
                'slide_payment'=>0,
                'slide_renew'=>'yes',
                'user_id'=>4,
                'status'=>0
            ],
            [
                'title'=>'Find Your Dream Car',
                'sub_title'=>'BECOME A LOCALCARZ.COM SELLERS TODAY!',
                'url'=>'https://localcarz.com/backend/index.php?controller=banners',
                'description'=>'You Can advertise your vehicle with your photo and vedios at localcarz.com untill it sells.',
                'image'=>'lady1.jpg',
                'slide_start_date'=>'12/11/2023',
                'slide_end_date'=>'01/29/2024',
                'slide_payment'=>0,
                'slide_renew'=>'yes',
                'user_id'=>4,
                'status'=>0
            ]
            ]);
    }
}
