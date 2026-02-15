<?php

namespace App\Http\Controllers;

use App\Models\DischargeLetter;
use Illuminate\Http\Request;
use App\Models\Patient;

class DischargeLetterController extends Controller
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
        return view('discharge_letters.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'discharge_date' => 'required|date',
            'discharge_notes' => 'nullable|string',
        ]);

        DischargeLetter::create([
            'patient_id' => $request->patient_id,
            'discharge_date' => $request->discharge_date,
            'discharge_notes' => $request->discharge_notes,
        ]);

        return redirect()->route('patients.show', $request->patient_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(DischargeLetter $dischargeLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DischargeLetter $dischargeLetter)
    {
        return view('discharge_letters.edit', compact('dischargeLetter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DischargeLetter $dischargeLetter)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'discharge_date' => 'required|date',
            'discharge_notes' => 'nullable|string',
        ]);

        $dischargeLetter->update([
            'patient_id' => $request->patient_id,
            'discharge_date' => $request->discharge_date,
            'discharge_notes' => $request->discharge_notes,
        ]);

        return redirect()->route('patients.show', $request->patient_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DischargeLetter $dischargeLetter)
    {
        //
    }
}
