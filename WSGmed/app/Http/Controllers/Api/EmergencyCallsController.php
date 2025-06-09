<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmergencyCalls;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EmergencyCalls",
 *     description="API Endpoints for managing emergency calls for patients"
 * )
 */
class EmergencyCallsController extends Controller
{
    /**
     * Create a new emergency call.
     *
     * @group EmergencyCalls
     * @bodyParam date string required The date of the emergency call. Example: 2025-05-05
     * @bodyParam status integer required The status of the emergency call. Example: 1
     * @response 201 {
     *     "message": "Emergency call created successfully",
     *     "call_id": 1
     * }
     * @response 401 {
     *     "error_code": 10001,
     *     "message": "Unauthorized access"
     * }
     * @response 422 {
     *     "error_code": 10022,
     *     "message": "Validation error"
     * }
     *
     * @OA\Post(
     *     path="/api/emergency-calls",
     *     tags={"EmergencyCalls"},
     *     summary="Create a new emergency call",
     *     description="Creates a new emergency call for the authenticated user. The `patient_id` is automatically assigned based on the logged-in user.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"date", "status"},
     *             @OA\Property(property="date", type="string", format="date", example="2025-05-05"),
     *             @OA\Property(property="status", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Emergency call created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Emergency call created successfully"),
     *             @OA\Property(property="call_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10001),
     *             @OA\Property(property="message", type="string", example="Unauthorized access")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10022),
     *             @OA\Property(property="message", type="string", example="Validation error")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $user = auth()->user(); // Pobierz zalogowanego użytkownika

        $validated = $request->validate([
            'date' => 'required|date',
            'status' => 'required|integer|min:0|max:2',
        ]);

        $emergencyCall = EmergencyCalls::create([
            'patient_id' => $user->id, // Użyj ID zalogowanego użytkownika
            'date' => $validated['date'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Emergency call created successfully',
            'call_id' => $emergencyCall->id,
        ], 201);
    }
}