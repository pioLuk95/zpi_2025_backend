<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @group Medical Records
 *
 * API endpoints for managing patient medical records
 */
class MedicalRecordController extends Controller
{
    /**
     * Get all medical records
     * 
     * Returns a list of all medical records available in the system.
     * 
     * @return JsonResponse
     * 
     * @response status=200 scenario="Success" {
     *     "data": [
     *         {
     *             "id": 1,
     *             "patient_id": 1,
     *             "record_date": "2025-05-05",
     *             "blood_pressure": 120.8,
     *             "temperature": 36.6,
     *             "pulse": 75,
     *             "weight": 70.5,
     *             "mood": 7,
     *             "pain_level": 3,
     *             "oxygen_saturation": 98.5,
     *             "created_at": "2025-05-05T12:00:00Z",
     *             "updated_at": "2025-05-05T12:00:00Z"
     *         }
     *     ]
     * }
     * 
     * @OA\Get(
     *     path="/api/medical-records",
     *     summary="Get all medical records",
     *     tags={"Medical Records"},
     *     @OA\Response(
     *         response=200,
     *         description="List of medical records",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="patient_id", type="integer", example=1),
     *                     @OA\Property(property="record_date", type="string", format="date", example="2025-05-05"),
     *                     @OA\Property(property="blood_pressure", type="number", format="float", example=120.80),
     *                     @OA\Property(property="temperature", type="number", format="float", example=36.6),
     *                     @OA\Property(property="pulse", type="number", format="float", example=75),
     *                     @OA\Property(property="weight", type="number", format="float", example=70.5),
     *                     @OA\Property(property="mood", type="integer", example=7),
     *                     @OA\Property(property="pain_level", type="integer", example=3),
     *                     @OA\Property(property="oxygen_saturation", type="number", format="float", example=98.5),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => MedicalRecord::all()], 200);
    }

    /**
     * Create a new medical record
     * 
     * Creates a new medical record for a patient with the provided health parameters.
     * 
     * @bodyParam patient_id integer required ID of the patient. Example: 1
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
     *         "id": 1,
     *         "patient_id": 1,
     *         "record_date": "2025-05-05",
     *         "blood_pressure": 120.8,
     *         "temperature": 36.6,
     *         "pulse": 75,
     *         "weight": 70.5,
     *         "mood": 7,
     *         "pain_level": 3,
     *         "oxygen_saturation": 98.5,
     *         "created_at": "2025-05-05T12:00:00Z",
     *         "updated_at": "2025-05-05T12:00:00Z"
     *     }
     * }
     * 
     * @response status=422 scenario="Validation error" {
     *     "message": "The given data was invalid.",
     *     "errors": {
     *         "patient_id": [
     *             "The patient_id field is required."
     *         ]
     *     }
     * }
     * 
     * @OA\Post(
     *     path="/api/medical-records",
     *     summary="Create a new medical record",
     *     tags={"Medical Records"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"patient_id", "record_date", "blood_pressure", "temperature", "pulse", "weight", "mood", "pain_level", "oxygen_saturation"},
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="record_date", type="string", format="date", example="2025-05-05"),
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
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="patient_id", type="integer", example=1),
     *                 @OA\Property(property="record_date", type="string", format="date", example="2025-05-05"),
     *                 @OA\Property(property="blood_pressure", type="number", format="float", example=120.80),
     *                 @OA\Property(property="temperature", type="number", format="float", example=36.6),
     *                 @OA\Property(property="pulse", type="number", format="float", example=75),
     *                 @OA\Property(property="weight", type="number", format="float", example=70.5),
     *                 @OA\Property(property="mood", type="integer", example=7),
     *                 @OA\Property(property="pain_level", type="integer", example=3),
     *                 @OA\Property(property="oxygen_saturation", type="number", format="float", example=98.5),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="patient_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="The patient_id field is required.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'record_date' => 'required|date',
            'blood_pressure' => 'required|numeric',
            'temperature' => 'required|numeric',
            'pulse' => 'required|numeric',
            'weight' => 'required|numeric',
            'mood' => 'required|integer|between:1,10',
            'pain_level' => 'required|integer|between:1,10',
            'oxygen_saturation' => 'required|numeric',
        ]);

        $medicalRecord = MedicalRecord::create($validated);

        return response()->json(['data' => $medicalRecord], 201);
    }

    /**
     * Get medical record details
     * 
     * Returns detailed information about a specific medical record.
     * 
     * @urlParam id integer required ID of the medical record. Example: 1
     * 
     * @response status=200 scenario="Success" {
     *     "data": {
     *         "id": 1,
     *         "patient_id": 1,
     *         "record_date": "2025-05-05",
     *         "blood_pressure": 120.8,
     *         "temperature": 36.6,
     *         "pulse": 75,
     *         "weight": 70.5,
     *         "mood": 7,
     *         "pain_level": 3,
     *         "oxygen_saturation": 98.5,
     *         "created_at": "2025-05-05T12:00:00Z",
     *         "updated_at": "2025-05-05T12:00:00Z"
     *     }
     * }
     * 
     * @response status=404 scenario="Record not found" {
     *     "message": "No query results for model [App\\Models\\MedicalRecord] 1"
     * }
     * 
     * @OA\Get(
     *     path="/api/medical-records/{id}",
     *     summary="Get medical record details",
     *     tags={"Medical Records"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the medical record",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medical record details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="patient_id", type="integer", example=1),
     *                 @OA\Property(property="record_date", type="string", format="date", example="2025-05-05"),
     *                 @OA\Property(property="blood_pressure", type="number", format="float", example=120.80),
     *                 @OA\Property(property="temperature", type="number", format="float", example=36.6),
     *                 @OA\Property(property="pulse", type="number", format="float", example=75),
     *                 @OA\Property(property="weight", type="number", format="float", example=70.5),
     *                 @OA\Property(property="mood", type="integer", example=7),
     *                 @OA\Property(property="pain_level", type="integer", example=3),
     *                 @OA\Property(property="oxygen_saturation", type="number", format="float", example=98.5),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\MedicalRecord] 1")
     *         )
     *     )
     * )
     */
    public function show(MedicalRecord $medicalRecord): JsonResponse
    {
        return response()->json(['data' => $medicalRecord], 200);
    }

    /**
     * Update medical record
     * 
     * Updates an existing medical record with the provided data.
     * 
     * @urlParam id integer required ID of the medical record. Example: 1
     * @bodyParam record_date date Date of the record in YYYY-MM-DD format. Example: 2025-05-10
     * @bodyParam blood_pressure numeric Blood pressure value. Example: 118.75
     * @bodyParam temperature numeric Body temperature in Celsius. Example: 36.8
     * @bodyParam pulse numeric Pulse rate (beats per minute). Example: 72
     * @bodyParam weight numeric Weight in kilograms. Example: 71.2
     * @bodyParam mood integer Mood rating (scale 1-10). Example: 8
     * @bodyParam pain_level integer Pain level (scale 1-10). Example: 2
     * @bodyParam oxygen_saturation numeric Blood oxygen saturation (%). Example: 99.1
     * 
     * @response status=200 scenario="Success" {
     *     "data": {
     *         "id": 1,
     *         "patient_id": 1,
     *         "record_date": "2025-05-10",
     *         "blood_pressure": 118.75,
     *         "temperature": 36.8,
     *         "pulse": 72,
     *         "weight": 71.2,
     *         "mood": 8,
     *         "pain_level": 2,
     *         "oxygen_saturation": 99.1,
     *         "created_at": "2025-05-05T12:00:00Z",
     *         "updated_at": "2025-05-13T10:15:22Z"
     *     }
     * }
     * 
     * @response status=404 scenario="Record not found" {
     *     "message": "No query results for model [App\\Models\\MedicalRecord] 1"
     * }
     * 
     * @response status=422 scenario="Validation error" {
     *     "message": "The given data was invalid.",
     *     "errors": {
     *         "mood": [
     *             "The mood must be between 1 and 10."
     *         ]
     *     }
     * }
     * 
     * @OA\Put(
     *     path="/api/medical-records/{id}",
     *     summary="Update medical record",
     *     tags={"Medical Records"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the medical record",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="record_date", type="string", format="date", example="2025-05-10"),
     *             @OA\Property(property="blood_pressure", type="number", format="float", example=118.75),
     *             @OA\Property(property="temperature", type="number", format="float", example=36.8),
     *             @OA\Property(property="pulse", type="number", format="float", example=72),
     *             @OA\Property(property="weight", type="number", format="float", example=71.2),
     *             @OA\Property(property="mood", type="integer", example=8),
     *             @OA\Property(property="pain_level", type="integer", example=2),
     *             @OA\Property(property="oxygen_saturation", type="number", format="float", example=99.1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medical record updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="patient_id", type="integer", example=1),
     *                 @OA\Property(property="record_date", type="string", format="date", example="2025-05-10"),
     *                 @OA\Property(property="blood_pressure", type="number", format="float", example=118.75),
     *                 @OA\Property(property="temperature", type="number", format="float", example=36.8),
     *                 @OA\Property(property="pulse", type="number", format="float", example=72),
     *                 @OA\Property(property="weight", type="number", format="float", example=71.2),
     *                 @OA\Property(property="mood", type="integer", example=8),
     *                 @OA\Property(property="pain_level", type="integer", example=2),
     *                 @OA\Property(property="oxygen_saturation", type="number", format="float", example=99.1),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T10:15:22Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\MedicalRecord] 1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="mood",
     *                     type="array",
     *                     @OA\Items(type="string", example="The mood must be between 1 and 10.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, MedicalRecord $medicalRecord): JsonResponse
    {
        $validated = $request->validate([
            'record_date' => 'sometimes|date',
            'blood_pressure' => 'sometimes|numeric',
            'temperature' => 'sometimes|numeric',
            'pulse' => 'sometimes|numeric',
            'weight' => 'sometimes|numeric',
            'mood' => 'sometimes|integer|between:1,10',
            'pain_level' => 'sometimes|integer|between:1,10',
            'oxygen_saturation' => 'sometimes|numeric',
        ]);

        $medicalRecord->update($validated);

        return response()->json(['data' => $medicalRecord], 200);
    }

    /**
     * Delete medical record
     * 
     * Removes a specific medical record from the system.
     * 
     * @urlParam id integer required ID of the medical record. Example: 1
     * 
     * @response status=200 scenario="Success" {
     *     "message": "Medical record deleted successfully"
     * }
     * 
     * @response status=404 scenario="Record not found" {
     *     "message": "No query results for model [App\\Models\\MedicalRecord] 1"
     * }
     * 
     * @OA\Delete(
     *     path="/api/medical-records/{id}",
     *     summary="Delete medical record",
     *     tags={"Medical Records"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the medical record",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medical record deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Medical record deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\MedicalRecord] 1")
     *         )
     *     )
     * )
     */
    public function destroy(MedicalRecord $medicalRecord): JsonResponse
    {
        $medicalRecord->delete();

        return response()->json(['message' => 'Medical record deleted successfully'], 200);
    }
}