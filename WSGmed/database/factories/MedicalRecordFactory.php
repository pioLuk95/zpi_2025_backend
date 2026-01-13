<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
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
            'insert_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'temperature' => $this->faker->randomFloat(1, 35.5, 39.5),
            'pulse' => $this->faker->numberBetween(60, 120),
            'weight' => $this->faker->randomFloat(1, 45, 120),
            'mood' => $this->faker->randomElement(['very_bad', 'bad', 'good', 'very_good']),
            'pain_level' => $this->faker->numberBetween(0, 10),
            'oxygen_saturation' => $this->faker->numberBetween(90, 100),
            'systolic_pressure' => $this->faker->numberBetween(90, 140),
            'diastolic_pressure' => $this->faker->numberBetween(60, 90),
        ];
    }
}
