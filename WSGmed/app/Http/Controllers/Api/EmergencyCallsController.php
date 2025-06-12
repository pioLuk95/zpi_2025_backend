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
     *     operationId="createEmergencyCall",
     *     tags={"EmergencyCalls"},
     *     summary="Create a new emergency call",
     *     description="Creates a new emergency call for the authenticated user. The patient_id is automatically assigned based on the logged-in user.",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *              @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="date", type="string", format="date", example="2025-06-15", enum={"YYYY-MM-DD"},description="Emergency Call date"),
     *             )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Emergency call created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Success message",
     *                 example="Emergency call created successfully"
     *             ),
     *             @OA\Property(
     *                 property="call_id",
     *                 type="integer",
     *                 description="The ID of the newly created emergency call",
     *                 example=1
     *             ),
     *             example={
     *                 "message": "Emergency call created successfully",
     *                 "call_id": 1
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error_code",
     *                 type="integer",
     *                 example=10001
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthorized access"
     *             ),
     *             example={
     *                 "error_code": 10001,
     *                 "message": "Unauthorized access"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error_code",
     *                 type="integer",
     *                 example=10022
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation error"
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 description="Validation errors grouped by field",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 ),
     *                 example={
     *                     "date": {"The date field is required.", "The date must be a valid date."}
     *                 }
     *             ),
     *             example={
     *                 "error_code": 10022,
     *                 "message": "Validation error",
     *                 "errors": {
     *                     "date": {"The date field is required."}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Pobieranie zalogowanego użytkownika
        $user = auth()->user();

        // Walidacja danych wejściowych
        // Format daty musi być zgodny z ISO 8601 (YYYY-MM-DD)
        $validated = $request->validate([
            'date' => 'required|date|date_format:Y-m-d',
        ]);

        // Tworzenie nowego zgłoszenia alarmowego
        $emergencyCall = EmergencyCalls::create([
            'patient_id' => $user->id,
            'date' => $validated['date'],
        ]);

        // Zwracanie odpowiedzi z sukcesem
        return response()->json([
            'message' => 'Emergency call created successfully',
            'call_id' => $emergencyCall->id,
        ], 201);
    }
}