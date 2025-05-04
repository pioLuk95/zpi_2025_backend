<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientMedication;
use Illuminate\Http\Request;

class PatientMedicationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/patient-medications",
     *     summary="Get all patient medications",
     *     tags={"Patient Medications"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all patient medications",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PatientMedication"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(PatientMedication::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/patient-medications",
     *     summary="Create a new patient medication",
     *     tags={"Patient Medications"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"patient_id", "medication_id", "dosage", "frequency"},
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="medication_id", type="integer", example=2),
     *             @OA\Property(property="dosage", type="string", example="1 tablet"),
     *             @OA\Property(property="frequency", type="string", example="Twice a day")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Patient medication created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/PatientMedication")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|integer',
            'medication_id' => 'required|integer',
            'dosage' => 'required|string',
            'frequency' => 'required|string',
        ]);

        $patientMedication = PatientMedication::create($validatedData);

        return response()->json($patientMedication, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/patient-medications/{id}",
     *     summary="Get a specific patient medication",
     *     tags={"Patient Medications"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient medication",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient medication details",
     *         @OA\JsonContent(ref="#/components/schemas/PatientMedication")
     *     )
     * )
     */
    public function show(PatientMedication $patientMedication)
    {
        return response()->json($patientMedication, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/patient-medications/{id}",
     *     summary="Update a specific patient medication",
     *     tags={"Patient Medications"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient medication",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="medication_id", type="integer", example=2),
     *             @OA\Property(property="dosage", type="string", example="1 tablet"),
     *             @OA\Property(property="frequency", type="string", example="Twice a day")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient medication updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/PatientMedication")
     *     )
     * )
     */
    public function update(Request $request, PatientMedication $patientMedication)
    {
        $validatedData = $request->validate([
            'patient_id' => 'sometimes|integer',
            'medication_id' => 'sometimes|integer',
            'dosage' => 'sometimes|string',
            'frequency' => 'sometimes|string',
        ]);

        $patientMedication->update($validatedData);

        return response()->json($patientMedication, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/patient-medications/{id}",
     *     summary="Delete a specific patient medication",
     *     tags={"Patient Medications"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient medication",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Patient medication deleted successfully"
     *     )
     * )
     */
    public function destroy(PatientMedication $patientMedication)
    {
        $patientMedication->delete();

        return response()->json(null, 204);
    }
}