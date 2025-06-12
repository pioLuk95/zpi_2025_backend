<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * @group Medical Records
 *
 * API endpoints for managing patient medical records
 */
class MedicalRecordController extends Controller
{
    /**
     * Create a new medical record
     * 
     * Creates a new medical record for the authenticated patient with the provided health parameters.
     * The patient_id is automatically retrieved from the authenticated user.
     * 
     * @bodyParam record_date date required Date of the record in YYYY-MM-DD format. Example: 2025-05-05
     * @bodyParam blood_pressure numeric required Blood pressure value. Example: 120.80
     * @bodyParam temperature numeric required Body temperature in Celsius. Example: 36.6
     * @bodyParam pulse numeric required Pulse rate (beats per minute). Example: 75
     * @bodyParam weight numeric required Weight in kilograms. Example: 70.5
     * @bodyParam mood integer required Mood rating (scale 1-10). Example: 7
     * @bodyParam pain_level integer required Pain level (scale 1-10). Example: 3
     * @bodyParam oxygen_saturation numeric required Blood oxygen saturation (%). Example: 98.5
     * 
     * @response status=201 scenario="Success" {
     *     "data": {
     *         "blood_pressure": 120.8,
     *         "temperature": 36.6,
     *         "pulse": 75,
     *         "weight": 70.5,
     *         "mood": 7,
     *         "pain_level": 3,
     *         "oxygen_saturation": 98.5
     *     }
     * }
     * 
     * @response status=422 scenario="Validation error" {
     *     "error_code": 10022,
     *     "message": "Validation error"
     * }
     * 
     * @OA\Post(
     *     path="/api/medical-records",
     *     summary="Create a new medical record",
     *     tags={"Medical Records"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"record_date", "blood_pressure", "temperature", "pulse", "weight", "mood", "pain_level", "oxygen_saturation"},
     *             @OA\Property(property="record_date", type="string", format="date", example="2025-05-05",enum={"YYYY-MM-DD"}, description="Medical record date"),
     *             @OA\Property(property="blood_pressure", type="number", format="float", example=120.80),
     *             @OA\Property(property="temperature", type="number", format="float", example=36.6),
     *             @OA\Property(property="pulse", type="number", format="float", example=75),
     *             @OA\Property(property="weight", type="number", format="float", example=70.5),
     *             @OA\Property(property="mood", type="integer", example=7),
     *             @OA\Property(property="pain_level", type="integer", example=3),
     *             @OA\Property(property="oxygen_saturation", type="number", format="float", example=98.5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Medical record created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="blood_pressure", type="number", format="float", example=120.80),
     *                 @OA\Property(property="temperature", type="number", format="float", example=36.6),
     *                 @OA\Property(property="pulse", type="number", format="float", example=75),
     *                 @OA\Property(property="weight", type="number", format="float", example=70.5),
     *                 @OA\Property(property="mood", type="integer", example=7),
     *                 @OA\Property(property="pain_level", type="integer", example=3),
     *                 @OA\Property(property="oxygen_saturation", type="number", format="float", example=98.5)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error_code", type="integer", example=10022),
     *             @OA\Property(property="message", type="string", example="Validation error")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'record_date' => 'required|date',
                'blood_pressure' => 'required|numeric',
                'temperature' => 'required|numeric',
                'pulse' => 'required|numeric',
                'weight' => 'required|numeric',
                'mood' => 'required|integer|between:1,10',
                'pain_level' => 'required|integer|between:1,10',
                'oxygen_saturation' => 'required|numeric',
            ]);

  
            $validated['patient_id'] = auth()->user()->patient_id;

            $medicalRecord = MedicalRecord::create($validated);

            $responseData = $medicalRecord->only(['blood_pressure', 'temperature', 'pulse', 'weight', 'mood', 'pain_level', 'oxygen_saturation']);

            return response()->json(['data' => $responseData], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error_code' => 10022,
                'message' => 'Validation error',
            ], 422);
        }
    }
}