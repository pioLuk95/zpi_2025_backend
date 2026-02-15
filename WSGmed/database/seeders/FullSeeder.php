<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Medication;
use App\Models\MedicalRecord;
use App\Models\EmergencyCalls;
use App\Models\StaffPatient;
use Illuminate\Support\Facades\Hash;

class FullSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medication::factory()->count(15)->create();
        $staff = Staff::factory()->count(10)->create();
        $patients = Patient::factory()->count(50)->create();

        $patients->push(
            Patient::factory()->create([
                'name' => 'Piotr',
                's_name' => 'Test',
                'password' => Hash::make('password123'),
                'email' => 'p.lukaszewski95@gmail.com',
                'status' => Patient::STATUS_NEW,
                'date_of_birth' => '1973-05-12'
            ]),
            Patient::factory()->create([
                'name' => 'Dominik',
                's_name' => 'Test',
                'password' => bcrypt('password123'),
                'email' => 'raisecreed@gmail.com',
                'status' => Patient::STATUS_NEW,
                'date_of_birth' => '1973-05-12'
            ])
        );

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

            $staffCount = rand(1, 3);
            for ($j = 0; $j <= $staffCount; $j++) {
                StaffPatient::create([
                    'patient_id' => $patient->id,
                    'staff_id' => $staff->random()->id,
                ]);
            }

            $recommendationsCount = rand(1, 4);
            for ($k = 0; $k < $recommendationsCount; $k++) {
                $patient->recommendations()->create([
                    'staff_id' => $staff->random()->id,
                    'date' => now()->subDays(rand(0, 30)),
                    'text' => 'This is a recommendation text for patient ' . $patient->id,
                    'tittle' => 'Recommendation ' . ($k + 1)
                ]);
            }

            $patientMedicationsCount = rand(1, 5);
            for ($m = 0; $m < $patientMedicationsCount; $m++) {
                $patient->patientMedications()->create([
                    'medication_id' => Medication::inRandomOrder()->first()->id,
                    'dosage' => rand(1, 500) . ' mg',
                    'frequency' => rand(1, 4) . ' times a day',
                    'start_date' => now()->subDays(rand(0, 60)),
                    'end_date' => now()->addDays(rand(1, 60))
                ]);
            }
        }
    }
}
