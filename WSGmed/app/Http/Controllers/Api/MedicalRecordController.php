<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/medical-records",
     *     summary="Get all medical records",
     *     tags={"Medical Records"},
     *     @OA\Response(
     *         response=200,
     *         description="List of medical records",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/MedicalRecord"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(MedicalRecord::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/medical-records",
     *     summary="Create a new medical record",
     *     tags={"Medical Records"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MedicalRecord")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Medical record created",
     *         @OA\JsonContent(ref="#/components/schemas/MedicalRecord")
     *     )
     * )
     */
    public function store(Request $request)
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

        return response()->json($medicalRecord, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/medical-records/{id}",
     *     summary="Get a specific medical record",
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
     *         @OA\JsonContent(ref="#/components/schemas/MedicalRecord")
     *     )
     * )
     */
    public function show(MedicalRecord $medicalRecord)
    {
        return response()->json($medicalRecord, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/medical-records/{id}",
     *     summary="Update a specific medical record",
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
     *         @OA\JsonContent(ref="#/components/schemas/MedicalRecord")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated medical record",
     *         @OA\JsonContent(ref="#/components/schemas/MedicalRecord")
     *     )
     * )
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
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

        return response()->json($medicalRecord, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/medical-records/{id}",
     *     summary="Delete a specific medical record",
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
     *         description="Medical record deleted",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Medical record deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return response()->json(['message' => 'Medical record deleted successfully'], 200);
    }
}