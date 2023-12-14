<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Plan::factory(15)->create();
        $plans=Plan::insert([

            [
               'name'=>'Top Banner',
               'price'=>'100',
               'description'=>'Home banner execute',
               'administrator_only'=>'yes',
               'position'=>'Top',
               'user_id'=>2,
               'status'=>1,

            ],
            [
               'name'=>'Bottom Banner',
               'price'=>'100',
               'description'=>'Home bottom banner execute',
               'administrator_only'=>'yes',
               'position'=>'Bottom Banner',
               'user_id'=>3,
               'status'=>'1',

            ],
            [
               'name'=>'Header Banner',
               'price'=>'200',
               'description'=>'Home header banner execute',
               'administrator_only'=>'no',
               'position'=>'Header Banner',
               'user_id'=>4,
               'status'=>'0',

            ]

        ]);
    }
}
