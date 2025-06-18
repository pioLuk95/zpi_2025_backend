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
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        return view('patients.index', [
            'patients' => Patient::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $locations = Location::all();
        return view('patients.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
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
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $records = $patient->records()->get();
        return view('patients.show', compact('patient', 'records'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $locations = Location::all();
        return view('patients.edit', compact('patient', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
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
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Pacjent został usunięty.');
    }
}
