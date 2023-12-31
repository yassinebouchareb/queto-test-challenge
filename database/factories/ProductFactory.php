<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->text(200),
            'quantity' => $this->faker->numberBetween(5, 10),
            'expiration_date' => Carbon::parse($this->faker->dateTimeBetween('+10 days', '+1 month'))->format('Y-m-d')
        ];
    }
}
