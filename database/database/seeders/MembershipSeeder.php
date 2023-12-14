<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners=Membership::insert([
                    [
                        'membership_type'=>'Silver',

                        'membership_price'=>'100',

                        'status'=>1,



                    ],
                    [
                        'membership_type'=>'Gold',

                        'membership_price'=>'200',

                        'status'=>1,



                    ],
                    [
                        'membership_type'=>'Platinum',

                        'membership_price'=>'400',

                        'status'=>1,



                    ],


                    ]);
    }
}
