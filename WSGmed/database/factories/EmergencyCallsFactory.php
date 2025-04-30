<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmergencyCalls>
 */
class EmergencyCallsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => \App\Models\Patient::inRandomOrder()->first()->id,
            'date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'status' => $this->faker->numberBetween(0, 2),
        ];
    }
}
