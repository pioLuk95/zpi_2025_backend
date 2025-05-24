<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCalls;
use App\Models\Patient;
use Illuminate\Http\Request;

class EmergencyCallsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('emergencyCalls.index', [
            'calls' => EmergencyCalls::all(),
        ]);
    }

    public function showEmergencies(Patient $patient)
    {   
        $emergencyCalls = EmergencyCalls::where('patient_id', $patient->id)->get();
        return view('emergencyCalls.index', [
            'calls' => $emergencyCalls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmergencyCalls $emergencyCalls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmergencyCalls $emergencyCalls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmergencyCalls $emergencyCalls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmergencyCalls $emergency_call)
    {
        $emergency_call->delete();
        return redirect()->route('emergency_calls.index')->with('success', 'Wpis został usunięty.');
    }
}
