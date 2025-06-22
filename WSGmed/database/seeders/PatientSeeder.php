<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Patient::create([
            'name' => 'Piotr',
            's_name' => 'Test',
            'password' => Hash::make('password123'),
            'email' => 'p.lukaszewski95@gmail.com',
            'date_of_birth' => '1973-05-12',
            'location_id' => '1'
        ]);

        Patient::create([
            'name' => 'Dominik',
            's_name' => 'Test',
            'password' => bcrypt('password123'),
            'email' => 'raisecreed@gmail.com',
            'date_of_birth' => '1973-05-12',
            'location_id' => '1'
        ]);
    }
}
