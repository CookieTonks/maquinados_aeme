<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;


class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>  $this->faker->sentence,
            'amount' =>  $this->faker->numberBetween($min = 1000, $max = 9000),
        ];
    }
}
