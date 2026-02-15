<?php

namespace App\Http\Controllers;

use App\Models\PatientMedication;
use App\Models\PatientMedicationConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientMedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($patientId)
    {
        $patient = \App\Models\Patient::findOrFail($patientId);
        $medications = \App\Models\Medication::all();
        $assignedMedications = $patient->patientMedications->pluck('medication_id')->toArray();
        
        return view('patients_medications.create', compact('patient', 'medications', 'assignedMedications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $patientId)
    {
        $validated = $request->validate([
            'medication_id' => 'required|exists:medications,id',
            'dosage' => 'required|string|min:0',
            'frequency' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        \App\Models\PatientMedication::create([
            'patient_id' => $patientId,
            'medication_id' => $validated['medication_id'],
            'dosage' => $validated['dosage'],
            'frequency' => $validated['frequency'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
        ]);
        
        return redirect()->route('patients.show', $patientId)->with('success', 'Lek został przypisany do pacjenta.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientMedication $patientMedication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientMedication $patientMedication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientMedication $patientMedication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($patientId, $patientMedicationId)
    {
        $patientMedication = \App\Models\PatientMedication::findOrFail($patientMedicationId);
        $patientMedication->delete();
        return redirect()->back()->with('success', 'Lek został usunięty.');
    }

    public function landing()
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $patients = \App\Models\Patient::paginate(10);
        $medications = \App\Models\Medication::all();
        return view('patients_medications.landing', compact('patients', 'medications'));
    }

    public function statistics()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $totalPatients = \App\Models\Patient::count();
        $totalMedications = \App\Models\Medication::count();
        $totalPatientMedications = \App\Models\PatientMedication::count();
        $activeMedications = \App\Models\PatientMedication::where('end_date', '>=', now())
            ->orWhereNull('end_date')
            ->count();

        // Najczęściej przepisywane leki
        $mostPrescribedMedications = \App\Models\PatientMedication::select('medication_id', DB::raw('count(*) as count'))
            ->groupBy('medication_id')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $medication = \App\Models\Medication::find($item->medication_id);
                return [
                    'name' => $medication ? $medication->name : 'Nieznany',
                    'count' => $item->count
                ];
            });

        // Statystyki według pacjentów
        $patientsWithMostMedications = \App\Models\Patient::withCount('patientMedications')
            ->orderBy('patient_medications_count', 'desc')
            ->limit(10)
            ->get();

        // Statystyki wiekowe pacjentów
        $ageGroups = [
            '0-19' => 0,
            '20-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60-69' => 0,
            '70+' => 0
        ];

        $patients = \App\Models\Patient::whereNotNull('date_of_birth')->get();
        foreach ($patients as $patient) {
            try {
                // date_of_birth jest już obiektem Carbon dzięki cast w modelu
                $birthDate = $patient->date_of_birth instanceof Carbon 
                    ? $patient->date_of_birth 
                    : Carbon::parse($patient->date_of_birth);
                
                $age = $birthDate->diffInYears(Carbon::now());
                
                if ($age < 20) {
                    $ageGroups['0-19']++;
                } elseif ($age < 30) {
                    $ageGroups['20-29']++;
                } elseif ($age < 40) {
                    $ageGroups['30-39']++;
                } elseif ($age < 50) {
                    $ageGroups['40-49']++;
                } elseif ($age < 60) {
                    $ageGroups['50-59']++;
                } elseif ($age < 70) {
                    $ageGroups['60-69']++;
                } else {
                    $ageGroups['70+']++;
                }
            } catch (\Exception $e) {
                // Pomijamy pacjentów z nieprawidłową datą urodzenia
                continue;
            }
        }

        return view('patients_medications.statistics', compact(
            'totalPatients',
            'totalMedications',
            'totalPatientMedications',
            'activeMedications',
            'mostPrescribedMedications',
            'patientsWithMostMedications',
            'ageGroups'
        ));
    }

    public function confirm($patientMedicationId)
    {
        try {
            $patientMedication = PatientMedication::findOrFail($patientMedicationId);
            
            $confirmation = PatientMedicationConfirmation::create([
                'patient_medication_id' => $patientMedication->id,
                'confirmation_date' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Potwierdzenie zostało dodane',
                'confirmation' => $confirmation
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Wystąpił błąd: ' . $e->getMessage()
            ], 500);
        }
    }
}
