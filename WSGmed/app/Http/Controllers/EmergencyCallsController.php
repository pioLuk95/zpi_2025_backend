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
        $calls = EmergencyCalls::paginate(10);
        return view('emergencyCalls.index', compact('calls'));
    }

    public function showEmergencies(Patient $patient)
    {   
        $calls = EmergencyCalls::where('patient_id', $patient->id)->paginate(10);
        return view('emergencyCalls.index', ['calls' => $calls]);
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
    public function show(EmergencyCalls $emergency_call)
    {
        return view('emergencyCalls.show', compact('emergency_call'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmergencyCalls $emergency_call)
    {
        return view('emergencyCalls.edit', compact('emergency_call'));
    }

    /**
     * Update the specified resource in storage.s
     */
    public function update(Request $request, EmergencyCalls $emergency_call)
    {
        $emergency_call->description = $request->input('description');
        $emergency_call->save();
        return redirect()->route('emergency_calls.index')->with('success', 'Opis został zaktualizowany.');
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
