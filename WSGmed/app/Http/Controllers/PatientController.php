<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Location;

use function Symfony\Component\String\b;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $locations = Location::all();
        return view('patients.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients',
            'date_of_birth' => 'required|date',
            'location_id' => 'required|exists:locations,id',
        ]);

        $validated['password'] = bcrypt("saa2fasg3as"); // TODO
        Patient::create($validated);
        return redirect()->route('patients.index')->with('success', 'Pacjent został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $staff = $patient->staff;
        $records = $patient->records()->get();
        $medications = $patient->medications;
        $patientMedications = $patient->patientMedications;
        $allMedications = \App\Models\Medication::all();
        return view('patients.show', compact('patient', 'records', 'staff', 'medications', 'patientMedications', 'allMedications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {   
        $locations = Location::all();
        return view('patients.edit', compact('patient', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients',
            'date_of_birth' => 'required|date',
            'location_id' => 'required|exists:locations,id',
        ]);

        $patient->update($validated);
        return redirect()->route('patients.index')->with('success', 'Pacjent został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Pacjent został usunięty.');
    }
}
