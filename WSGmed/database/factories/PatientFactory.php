<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'name' => $this->faker->firstName,
            's_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date('Y-m-d', '2005-01-01'),
            'date_of_registration' => now(),
            'location_id' => \App\Models\Location::inRandomOrder()->first()->id,
        ];
    }
}
