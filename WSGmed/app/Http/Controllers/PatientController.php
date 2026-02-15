<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RequireTotpVerification;
use App\Models\Patient;
use App\Models\StaffPatient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(RequireTotpVerification::class)->only('index');
    }

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
        return view('patients.create');
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
            'date_of_birth' => 'required|date'
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
        $records = $patient->records()->get();
        $allMedications = \App\Models\Medication::all();
        return view('patients.show', compact('patient', 'records', 'allMedications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $statuses = [
            Patient::STATUS_NEW,
            Patient::STATUS_UNDER_TREATMENT,
            Patient::STATUS_DISCHARGED,
            Patient::STATUS_DIED
        ];
        return view('patients.edit', compact('patient','statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients,email,' . $patient->id,
            'date_of_birth' => 'required|date',
            'status' => 'required|in:' . implode(',', [
                Patient::STATUS_NEW,
                Patient::STATUS_UNDER_TREATMENT,
                Patient::STATUS_DISCHARGED,
                Patient::STATUS_DIED
            ]),
        ]);

        $patient->update($validated);
        return redirect()->route('patients.index')->with('success', 'Pacjent został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        StaffPatient::where('patient_id', $patient->id)->delete();
        if (method_exists($patient, 'records')) {
            $patient->records()->delete();
        }
        if (method_exists($patient, 'medications')) {
            $patient->medications()->detach();
        }
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Pacjent został usunięty.');
    }
}
