<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
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
            'date_of_birth' => $this->faker->date('Y-m-d', '1990-01-01'),
            'role' => $this->faker->randomElement(['internist', 'specialist', 'rehabilitator','nurse','doctor']),
        ];
    }
}
