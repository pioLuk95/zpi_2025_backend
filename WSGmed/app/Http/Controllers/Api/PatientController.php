<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

/**
 * @group Patient Management
 * 
 * APIs for managing patients in the system
 * 
 * @OA\Tag(
 *     name="Patients",
 *     description="Operations related to patient management"
 * )
 */
class PatientController extends Controller
{
    /**
     * List all patients
     * 
     * Returns a collection of all patients in the system.
     * 
     * @OA\Get(
     *     path="/api/patients",
     *     operationId="getPatientsList",
     *     tags={"Patients"},
     *     summary="Get all patients",
     *     description="Retrieves a list of all patients in the system",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Jan"),
     *                 @OA\Property(property="s_name", type="string", example="Kowalski"),
     *                 @OA\Property(property="email", type="string", format="email", example="jan.kowalski@example.com"),
     *                 @OA\Property(property="date_of_birth", type="string", format="date", example="1990-01-15"),
     *                 @OA\Property(property="location_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Patient::all(), 200);
    }

    /**
     * Create a new patient
     * 
     * Store a newly created patient in the database.
     * 
     * @OA\Post(
     *     path="/api/patients",
     *     operationId="storePatient",
     *     tags={"Patients"},
     *     summary="Create a new patient",
     *     description="Creates a new patient with the provided information",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Patient creation data",
     *         @OA\JsonContent(
     *             required={"name", "s_name", "email", "date_of_birth", "location_id", "password"},
     *             @OA\Property(property="name", type="string", example="Anna", description="Patient's first name"),
     *             @OA\Property(property="s_name", type="string", example="Nowak", description="Patient's surname"),
     *             @OA\Property(property="email", type="string", format="email", example="anna.nowak@example.com", description="Patient's email address"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1995-05-20", description="Patient's date of birth"),
     *             @OA\Property(property="location_id", type="integer", example=2, description="Location ID where the patient is registered"),
     *             @OA\Property(property="password", type="string", format="password", example="password123", description="Patient's account password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Patient created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Anna"),
     *             @OA\Property(property="s_name", type="string", example="Nowak"),
     *             @OA\Property(property="email", type="string", format="email", example="anna.nowak@example.com"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1995-05-20"),
     *             @OA\Property(property="location_id", type="integer", example=2),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email has already been taken"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     * 
     * @param Request $request The HTTP request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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
     * Get patient details
     * 
     * Returns the details of a specific patient.
     * 
     * @urlParam id integer required The ID of the patient. Example: 1
     * 
     * @OA\Get(
     *     path="/api/patients/{id}",
     *     operationId="getPatientById",
     *     tags={"Patients"},
     *     summary="Get a patient by ID",
     *     description="Returns detailed information for a specific patient",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient details retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Jan"),
     *             @OA\Property(property="s_name", type="string", example="Kowalski"),
     *             @OA\Property(property="email", type="string", format="email", example="jan.kowalski@example.com"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1990-01-15"),
     *             @OA\Property(property="location_id", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     * 
     * @param int $id The patient ID
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json($patient, 200);
    }

    /**
     * Update patient information
     * 
     * Updates the specified patient's information in the system.
     * 
     * @urlParam id integer required The ID of the patient. Example: 1
     * 
     * @OA\Put(
     *     path="/api/patients/{id}",
     *     operationId="updatePatient",
     *     tags={"Patients"},
     *     summary="Update a patient",
     *     description="Updates a patient's information in the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Patient update data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Tomasz", description="Patient's first name"),
     *             @OA\Property(property="s_name", type="string", example="Wiśniewski", description="Patient's surname"),
     *             @OA\Property(property="email", type="string", format="email", example="tomasz.wisniewski@example.com", description="Patient's email address"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1988-11-03", description="Patient's date of birth"),
     *             @OA\Property(property="location_id", type="integer", example=3, description="Location ID where the patient is registered"),
     *             @OA\Property(property="password", type="string", format="password", example="newPassword456", description="Patient's new password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Tomasz"),
     *             @OA\Property(property="s_name", type="string", example="Wiśniewski"),
     *             @OA\Property(property="email", type="string", format="email", example="tomasz.wisniewski@example.com"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1988-11-03"),
     *             @OA\Property(property="location_id", type="integer", example=3),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T15:30:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email has already been taken"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     * 
     * @param Request $request The HTTP request
     * @param int $id The patient ID
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            's_name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                Rule::unique('patients')->ignore($id)
            ],
            'date_of_birth' => 'sometimes|date',
            'location_id' => 'sometimes|exists:locations,id',
            'password' => 'sometimes|string|min:8',
        ]);

        $patient->update($validated);
        return response()->json($patient, 200);
    }

    /**
     * Delete a patient
     * 
     * Removes a patient from the system.
     * 
     * @urlParam id integer required The ID of the patient. Example: 1
     * 
     * @OA\Delete(
     *     path="/api/patients/{id}",
     *     operationId="deletePatient",
     *     tags={"Patients"},
     *     summary="Delete a patient",
     *     description="Deletes a patient from the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     * 
     * @param int $id The patient ID
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully'], 200);
    }
}