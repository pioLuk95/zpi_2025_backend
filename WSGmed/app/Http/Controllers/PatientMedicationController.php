<?php

namespace App\Http\Controllers;

use App\Models\PatientMedication;
use Illuminate\Http\Request;

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
            'dosage' => 'required|numeric|min:0',
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
}
