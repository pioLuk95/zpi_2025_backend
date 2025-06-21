<?php

namespace Database\Factories;
use App\Models\Location; // Import modelu Location

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
            // Użyj istniejącej lokalizacji lub stwórz nową, jeśli żadna nie istnieje
            'location_id' => Location::inRandomOrder()->first()->id ?? Location::factory()->create()->id,
        ];
    }
}
