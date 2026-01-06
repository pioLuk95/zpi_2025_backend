<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::paginate(10);
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('staff.create', compact('roles'));
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
            'role_id' => 'required|exists:roles,id'
        ]);

        $validated['password'] = bcrypt("saa2fasg3as"); //TODO
        Staff::create($validated);
        return redirect()->route('staff.index')->with('success', 'Worker został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        $patients = $staff->patients;
        return view('staff.show', compact('staff', 'patients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $roles = Role::all();
        return view('staff.create', compact('roles', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients',
            'date_of_birth' => 'required|date',
            'role_id' => 'required|exists:roles,id'
        ]);

        $staff->update($validated);
        return redirect()->route('staff.index')->with('success', 'Worker został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index');
    }
}
