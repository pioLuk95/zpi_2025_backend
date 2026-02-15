<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;


class MedicalRecordController extends Controller
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
    public function create(Patient $patient)
    {
        return view('med_records.create', [
            'patient' => $patient
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'insert_date' => 'required|date',
            'systolic_pressure' => 'required|integer|min:0',
            'diastolic_pressure' => 'required|integer|min:0',
            'temperature' => 'required|numeric',
            'pulse' => 'required|numeric',
            'weight' => 'required|numeric',
            'mood' => 'required|in:very_bad,bad,good,very_good',
            'pain_level' => 'required|integer|between:1,10',
            'oxygen_saturation' => 'required|numeric',
        ]);

        MedicalRecord::create($validated);

        return redirect()
            ->route('patients.show', $validated['patient_id'])
            ->with('success', 'Wpis medyczny został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $patient = $medicalRecord->patient;
        $medicalRecord->delete();

        return redirect()
            ->route('patients.show', $patient)
            ->with('success', 'Wpis medyczny został pomyślnie usunięty.');
    }
}
