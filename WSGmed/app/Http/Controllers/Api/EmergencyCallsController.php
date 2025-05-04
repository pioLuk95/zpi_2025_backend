<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmergencyCalls;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EmergencyCalls",
 *     description="API Endpoints for managing emergency calls"
 * )
 */
class EmergencyCallsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/emergency-calls",
     *     tags={"EmergencyCalls"},
     *     summary="Get a list of all emergency calls",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/EmergencyCalls"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(EmergencyCalls::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/emergency-calls",
     *     tags={"EmergencyCalls"},
     *     summary="Create a new emergency call",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"patient_id", "date", "status"},
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2025-05-05"),
     *             @OA\Property(property="status", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Emergency call created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/EmergencyCalls")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'status' => 'required|integer|min:0|max:2',
        ]);

        $emergencyCall = EmergencyCalls::create($validated);

        return response()->json($emergencyCall, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/emergency-calls/{id}",
     *     tags={"EmergencyCalls"},
     *     summary="Get a specific emergency call by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the emergency call",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/EmergencyCalls")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Emergency call not found"
     *     )
     * )
     */
    public function show(EmergencyCalls $emergencyCalls)
    {
        return $emergencyCalls;
    }

    /**
     * @OA\Put(
     *     path="/api/emergency-calls/{id}",
     *     tags={"EmergencyCalls"},
     *     summary="Update an existing emergency call",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the emergency call",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2025-05-05"),
     *             @OA\Property(property="status", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Emergency call updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/EmergencyCalls")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Emergency call not found"
     *     )
     * )
     */
    public function update(Request $request, EmergencyCalls $emergencyCalls)
    {
        $validated = $request->validate([
            'patient_id' => 'sometimes|required|exists:patients,id',
            'date' => 'sometimes|required|date',
            'status' => 'sometimes|required|integer|min:0|max:2',
        ]);

        $emergencyCalls->update($validated);

        return response()->json($emergencyCalls, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/emergency-calls/{id}",
     *     tags={"EmergencyCalls"},
     *     summary="Delete an emergency call",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the emergency call",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Emergency call deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Emergency call not found"
     *     )
     * )
     */
    public function destroy(EmergencyCalls $emergencyCalls)
    {
        $emergencyCalls->delete();

        return response()->json(null, 204);
    }
}