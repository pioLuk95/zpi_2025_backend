<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('medications.index', [
            'medications' => Medication::all(),
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
        return view('medications.create');
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
            'info' => 'string',
        ]);
        Medication::create($validated);

        return redirect()->route('medications.index')->with('success', 'Lek został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medication $medication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medication $medication)
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        return view('medications.edit', compact('medication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medication $medication)
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'string',
        ]);
        $medication->update($validated);

        return redirect()->route('medications.index')->with('success', 'Lek został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medication $medication)
    {
        if (auth()->user()->role === 'user') {
            abort(403);
        }
        $medication->delete();
        return redirect()->route('medications.index')->with('success', 'Lek został usunięty.');
    }
}
