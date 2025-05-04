<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Locations",
 *     description="API Endpoints for managing locations"
 * )
 */
class LocationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/locations",
     *     tags={"Locations"},
     *     summary="Get a list of all locations",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Location"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Location::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/locations",
     *     tags={"Locations"},
     *     summary="Create a new location",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"room", "floor", "limit"},
     *             @OA\Property(property="room", type="string", example="Room 101"),
     *             @OA\Property(property="floor", type="integer", example=1),
     *             @OA\Property(property="limit", type="integer", example=50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Location created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Location")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room' => 'required|string|max:255',
            'floor' => 'required|integer',
            'limit' => 'required|integer',
        ]);

        $location = Location::create($validated);

        return response()->json($location, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/locations/{id}",
     *     tags={"Locations"},
     *     summary="Get a specific location by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the location",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Location")
     *     )
     * )
     */
    public function show(Location $location)
    {
        return response()->json($location, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/locations/{id}",
     *     tags={"Locations"},
     *     summary="Update a specific location by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the location",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"room", "floor", "limit"},
     *             @OA\Property(property="room", type="string", example="Room 102"),
     *             @OA\Property(property="floor", type="integer", example=2),
     *             @OA\Property(property="limit", type="integer", example=100)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Location")
     *     )
     * )
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'room' => 'required|string|max:255',
            'floor' => 'required|integer',
            'limit' => 'required|integer',
        ]);

        $location->update($validated);

        return response()->json($location, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/locations/{id}",
     *     tags={"Locations"},
     *     summary="Delete a specific location by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the location",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Location deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(['message' => 'Location deleted successfully'], 200);
    }
}