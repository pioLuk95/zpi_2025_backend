<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FullSeeder;
use Database\Seeders\UserSeeder; // Upewnij się, że UserSeeder jest zaimportowany

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FullSeeder::class,
            UserSeeder::class,
            PatientSeeder::class
        ]);
    }
}
