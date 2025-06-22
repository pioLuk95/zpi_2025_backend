<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medication;
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
     * Show the form for assigning medications to a patient
     */
    public function create(Patient $patient)
    {
        $medications = Medication::all();
        $assignedMedications = $patient->medications->pluck('id')->toArray();
        
        return view('patient_medications.create', compact('patient', 'medications', 'assignedMedications'));
    }

    /**
     * Store a newly assigned medication
     */
    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'medication_id' => 'required|exists:medications,id',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        // Check if medication is already assigned
        $existing = PatientMedication::where('patient_id', $patient->id)
                                    ->where('medication_id', $validated['medication_id'])
                                    ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Ten lek jest już przypisany do tego pacjenta.');
        }

        $patient->medications()->attach($validated['medication_id'], [
            'dosage' => $validated['dosage'],
            'frequency' => $validated['frequency'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return redirect()->route('patients.show', $patient)->with('success', 'Lek został przypisany do pacjenta.');
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
     * Remove a medication assignment
     */
    public function destroy(Patient $patient, PatientMedication $patientMedication)
    {
        $patient->medications()->detach($patientMedication->medication_id);
        
        return redirect()->route('patients.show', $patient)->with('success', 'Lek został usunięty z listy pacjenta.');
    }
}
