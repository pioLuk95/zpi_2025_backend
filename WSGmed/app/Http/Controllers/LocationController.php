<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::paginate(10);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'room' => 'required|string|max:255',
            'floor' => 'required|integer',
            'limit' => 'required|integer',
        ]);
        Location::create($validated);

        return redirect()->route('locations.index')->with('success', 'Lokalizacja została dodana.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'room' => 'required|string|max:255',
            'floor' => 'required|integer',
            'limit' => 'required|integer',
        ]);
        $location->update($validated);

        return redirect()->route('locations.index')->with('success', 'Lokalizacja została zaktualizowana.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Lokalizacja została usunięta.');
    }
}
