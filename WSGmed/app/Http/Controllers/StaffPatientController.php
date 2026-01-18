<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\StaffPatient;
use Illuminate\Http\Request;
use App\Models\Role;



class StaffPatientController extends Controller
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
    public function show(StaffPatient $staffPatient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffPatient $staffPatient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffPatient $staffPatient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffPatient $staffPatient)
    {
        //
    }

    public function unassign(Request $request, $staff, $patient)
    {
        StaffPatient::where('staff_id', $staff)
            ->where('patient_id', $patient)
            ->delete();

        return redirect()->route('patients.show', $patient);
    }

    public function renderAssign(Request $request, $patient)
    {
        // Pobierz wszystkie role
        $roles = Role::all();

        // Pobierz pracowników, którzy NIE są jeszcze przypisani do pacjenta
        $staff = Staff::with('role')->get()->filter(function ($s) use ($patient) {
            return !StaffPatient::where('staff_id', $s->id)
                ->where('patient_id', $patient)
                ->exists();
        });

        return view('staff_patients.assign', [
            'staff' => $staff,
            'roles' => $roles,
            'patient' => $patient,
        ]);
    }


    public function assign(Request $request, $patient)
    {
        $valideted = $request->validate([
            'staff_id' => 'required|exists:staff,id',
        ]);

        StaffPatient::create([
        'staff_id' => $valideted['staff_id'],
        'patient_id' => $patient]);

        return redirect()->route('patients.show', $patient);
    }
}
