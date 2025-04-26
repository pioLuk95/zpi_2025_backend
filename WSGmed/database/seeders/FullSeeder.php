<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Medication;
use App\Models\MedicalRecord;
use App\Models\EmergencyCalls;
use App\Models\Location;

class FullSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::factory()->count(20)->create();
        $patients = Patient::factory()->count(50)->create();
        $staff = Staff::factory()->count(10)->create();
        $medications = Medication::factory()->count(15)->create();
        foreach ($patients as $patient) {
            
            $recordsCount = rand(1, 5);
            for ($i = 0; $i < $recordsCount; $i++) {
                MedicalRecord::factory()->create([
                    'patient_id' => $patient->id,
                ]);
            }

            $callsCount = rand(0, 2);
            for ($i = 0; $i < $callsCount; $i++) {
                EmergencyCalls::factory()->create([
                    'patient_id' => $patient->id,
                ]);
            }
        }
    }
}
