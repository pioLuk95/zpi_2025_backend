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
        User::create([
            'name' => 'Test Patient',
            'email' => 'patient@example.com',
            'password' => Hash::make('password123'),
            'patient_id' => null,
            'role' => 'patient',
        ]);

        User::create([
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'patient_id' => null,
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'patient_id' => null,
            'role' => 'admin',
        ]);
    }
}
