<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();
        if(! Schema::hasColumn('news','deleted_at')){
            Schema::table('news', function(Blueprint $table){
                $table->softDeletes();
            });
        }
        if(News::count() == 0){
            $data = $this->getDataArray();
            News::insert($data);
        }

    }


    public function getDataArray()
    {
        $newses = [


            [
                'title' => 'Best Used Cars under $10000 for 2023 | Local Carz',

                'description' => '<p>There are many great used small cars available for under $10,000.
                Here are some options that are reliable, fuel-efficient, and offer good
                value for your money:

                </p><ol><li>Hyundai Elantra 2014</li><li>Kia Soul 2013</li><li>Nissan Leaf 2013, 2015</li></ol>

                <p><br>
                Stop! That’s an EV! Yes, many people are interested in EVs, so we
                thought Leaf is a very affordable electric vehicle with a typical range
                of 75 miles.<br>
                <br>
                That’s not enough? Looking for more? Here are a few more for you...</p>

                <ol><li>
                    <p>Honda Fit: The Honda Fit is a versatile and practical subcompact car
                 that offers excellent fuel economy, plenty of cargo space, and a
                spacious interior. You can find a 2012-2014 model year Honda Fit within
                your budget.</p>
                    </li><li>
                    <p>Toyota Yaris: The Toyota Yaris is a reliable and fuel-efficient
                subcompact car that is perfect for city driving. You can find a
                2012-2014 Toyota Yaris model in your budget.</p>
                    </li><li>
                    <p>Mazda3: The Mazda3 is a sporty compact car with responsive handling
                and a stylish design. You can find a 2010-2012 model year Mazda3 within
                your budget.</p>
                    </li><li>
                    <p>Ford Focus: The Ford Focus is a practical and efficient compact car
                with good handling and a comfortable ride. You can find a 2012-2014
                model year Ford Focus within your budget.</p>
                    </li><li>
                    <p>Hyundai Accent: The Hyundai Accent is a reliable and fuel-efficient
                subcompact car that offers good value for your money. You can find a
                2013-2015 model year Hyundai Accent within your budget.</p>
                    </li><li>
                    <p>Kia Rio: The Kia Rio is a reliable and affordable subcompact car
                that offers good fuel economy and a comfortable ride. You can find a
                2012-2014 model year Kia Rio within your budget.</p>
                    </li><li>
                    <p>Nissan Versa: The Nissan Versa is a spacious and practical
                subcompact car that offers good fuel economy and a comfortable ride. You
                 can find a 2012-2014 model year Nissan Versa within your budget.</p>
                    </li></ol>

                <p>When buying a used car, it’s important to have it inspected by a
                mechanic to ensure that it’s in good condition and won’t require
                expensive repairs in the near future.</p>',

                'image' => '2014-elantra-images.png'
            ],
            [
                'title' => 'Tesla reduces Model S and Model X prices',

                'description' => '<p>Tesla issued another round of price cuts last Sunday evening, reducing
                the price of both the Model S and Model X in the US. However, only the
                Model X saw a price reduction in Canada. The interesting part of the
                price reductions is that the Plaid variants of the Model S and Model X
                are now priced at the same amount, bucking the historical trend of the
                two flagship vehicles having, at times, a significant price gap.
                </p><p>There have been no price changes to the Model 3 or Model Y in either country.</p>







                <p>Image by Blomst from Pixabay</p>',

                'image' => 'tesla-1738969_640.jpg'
            ],

        ];
        return $newses;
    }
}
