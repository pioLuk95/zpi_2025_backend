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
    public function create()
    {
        return redirect()->route('patients_medications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $patientId)
    {
        $validated = $request->validate([
            'medication_id' => 'required|exists:medications,id',
            'dosage' => 'required|integer|min:0',
        ]);

        \App\Models\PatientMedication::create([
            'patient_id' => $patientId,
            'medication_id' => $validated['medication_id'],
            'dosage' => $validated['dosage'],
            'start_date' => now(),
            'end_date' => null,
        ]);
        return redirect()->route('patients_medications.landing')->with('success', 'Medication assigned to patient.');
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
        $medications = \App\Models\Medication::paginate(10);
        return view('patients_medications.landing', compact('patients', 'medications'));
    }
}
