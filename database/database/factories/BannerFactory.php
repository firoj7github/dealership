<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'name'=>$this->faker->text('20'),
           'image'=>$this->faker->imageUrl(640, 480),
           'start_date'=>$this->faker->date($format = 'm-d-Y', now()),
           'end_date'=>$this->faker->date($format = 'm-d-Y', now()),
           'banner_price'=>$this->faker->numberBetween(100, 200),
           'status'=>$this->faker->randomElement(['1', '0']),
           'payment'=>$this->faker->randomElement(['1', '0']),
           'renew'=>$this->faker->randomElement(['yes', 'no']),
           'position'=>$this->faker->randomElement(['Top', 'Middle','Bottom']),
           'user_id'=>$this->faker->randomElement(['1', '2','3'],['4']),

        ];
    }
}
