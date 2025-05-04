<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

/**
 * 
 * @OA\Tag(
 *     name="Patients",
 *     description="Operations related to patients"
 * )
 */
class PatientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/patients",
     *     tags={"Patients"},
     *     summary="Get all patients",
     *     @OA\Response(
     *         response=200,
     *         description="List of all patients",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Patient"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Patient::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/patients",
     *     tags={"Patients"},
     *     summary="Create a new patient",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PatientCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Patient created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Patient")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'date_of_birth' => 'required|date',
            'location_id' => 'required|exists:locations,id',
            'password' => 'required|string|min:8',
        ]);

        $patient = Patient::create($validated);
        return response()->json($patient, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/patients/{id}",
     *     tags={"Patients"},
     *     summary="Get a patient by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient details",
     *         @OA\JsonContent(ref="#/components/schemas/Patient")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     )
     * )
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json($patient, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/patients/{id}",
     *     tags={"Patients"},
     *     summary="Update a patient",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PatientUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Patient")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            's_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:patients,email,' . $id,
            'date_of_birth' => 'sometimes|date',
            'location_id' => 'sometimes|exists:locations,id',
            'password' => 'sometimes|string|min:8',
        ]);

        $patient->update($validated);
        return response()->json($patient, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/patients/{id}",
     *     tags={"Patients"},
     *     summary="Delete a patient",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully'], 200);
    }
}