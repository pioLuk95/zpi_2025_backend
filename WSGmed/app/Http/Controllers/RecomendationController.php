<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Recomendation;
use App\Models\StaffPatient;
use Illuminate\Http\Request;


class RecomendationController extends Controller
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
        return view("recommendations.create", [
            'patient' => $patient
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Recomendation::create([
            'patient_id' => $request->input('patient_id'),
            'staff_id' => auth()->user()->id,
            'date' => $request->input('date'),
            'tittle' => $request->input('tittle'),
            'text' => $request->input('text'),
        ]);

        return redirect()->route('patients.show', $request->input('patient_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Recomendation $recomendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recomendation $recomendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recomendation $recomendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recomendation $recommendation)
    {
        $patientId = $recommendation->patient->id;
        $recommendation->delete();
        return redirect()->route('patients.show', $patientId);
    }
}
