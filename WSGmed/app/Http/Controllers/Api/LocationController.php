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
     * Display a list of all locations.
     *
     * @group Locations
     * @response 200 [
     *     {
     *         "id": 1,
     *         "room": "Room 101",
     *         "floor": 1,
     *         "limit": 50,
     *         "created_at": "2025-05-05T12:00:00Z",
     *         "updated_at": "2025-05-05T12:00:00Z"
     *     }
     * ]
     *
     * @OA\Get(
     *     path="/api/locations",
     *     tags={"Locations"},
     *     summary="Get a list of all locations",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="room", type="string", example="Room 101"),
     *                 @OA\Property(property="floor", type="integer", example=1),
     *                 @OA\Property(property="limit", type="integer", example=50),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Location::all(), 200);
    }

    /**
     * Create a new location.
     *
     * @group Locations
     * @bodyParam room string required The name of the room. Example: Room 101
     * @bodyParam floor integer required The floor number. Example: 1
     * @bodyParam limit integer required The capacity limit of the room. Example: 50
     * @response 201 {
     *     "id": 1,
     *     "room": "Room 101",
     *     "floor": 1,
     *     "limit": 50,
     *     "created_at": "2025-05-05T12:00:00Z",
     *     "updated_at": "2025-05-05T12:00:00Z"
     * }
     *
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
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="room", type="string", example="Room 101"),
     *             @OA\Property(property="floor", type="integer", example=1),
     *             @OA\Property(property="limit", type="integer", example=50),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *         )
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
     * Get a specific location by ID.
     *
     * @group Locations
     * @urlParam id integer required The ID of the location. Example: 1
     * @response 200 {
     *     "id": 1,
     *     "room": "Room 101",
     *     "floor": 1,
     *     "limit": 50,
     *     "created_at": "2025-05-05T12:00:00Z",
     *     "updated_at": "2025-05-05T12:00:00Z"
     * }
     * @response 404 {
     *     "message": "Location not found"
     * }
     *
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
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="room", type="string", example="Room 101"),
     *             @OA\Property(property="floor", type="integer", example=1),
     *             @OA\Property(property="limit", type="integer", example=50),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found"
     *     )
     * )
     */
    public function show(Location $location)
    {
        return response()->json($location, 200);
    }

    /**
     * Update a specific location by ID.
     *
     * @group Locations
     * @urlParam id integer required The ID of the location. Example: 1
     * @bodyParam room string The name of the room. Example: Room 102
     * @bodyParam floor integer The floor number. Example: 2
     * @bodyParam limit integer The capacity limit of the room. Example: 100
     * @response 200 {
     *     "id": 1,
     *     "room": "Room 102",
     *     "floor": 2,
     *     "limit": 100,
     *     "created_at": "2025-05-05T12:00:00Z",
     *     "updated_at": "2025-05-05T12:00:00Z"
     * }
     * @response 404 {
     *     "message": "Location not found"
     * }
     *
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
     *             @OA\Property(property="room", type="string", example="Room 102"),
     *             @OA\Property(property="floor", type="integer", example=2),
     *             @OA\Property(property="limit", type="integer", example=100)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="room", type="string", example="Room 102"),
     *             @OA\Property(property="floor", type="integer", example=2),
     *             @OA\Property(property="limit", type="integer", example=100),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found"
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
     * Delete a specific location by ID.
     *
     * @group Locations
     * @urlParam id integer required The ID of the location. Example: 1
     * @response 200 {
     *     "message": "Location deleted successfully"
     * }
     * @response 404 {
     *     "message": "Location not found"
     * }
     *
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found"
     *     )
     * )
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(['message' => 'Location deleted successfully'], 200);
    }
}