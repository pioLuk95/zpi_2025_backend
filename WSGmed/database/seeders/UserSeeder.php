<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patient; // Dodaj import dla modelu Patient

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Upewnij się, że istnieje co najmniej jeden pacjent, do którego można przypisać użytkownika
        $patient = Patient::first() ?? Patient::factory()->create();

        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'patient_id' => $patient->id, // Przypisz ID istniejącego pacjenta
        ]);
    }
}
