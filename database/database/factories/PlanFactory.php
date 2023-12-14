<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
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
            'description'=>$this->faker->text('200'),
            'price'=>$this->faker->numberBetween(100, 200),
            'status'=>$this->faker->randomElement(['1', '0']),
            'administrator_only'=>$this->faker->randomElement(['yes', 'no']),
            'position'=>$this->faker->randomElement(['Top', 'Middle','Bottom']),
            'user_id'=>$this->faker->randomElement(['1', '2','3'],['4']),
        ];
    }
}
