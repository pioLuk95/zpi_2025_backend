<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room' => $this->faker->numberBetween(1,40),
            'floor' => $this->faker->numberBetween(1, 4),
            'limit' => $this->faker->numberBetween(1, 10),
        ];
    }
}
