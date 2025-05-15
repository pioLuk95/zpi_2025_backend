<?php

namespace App\Http\Controllers\Api;

use App\Models\StaffPatient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @group Staff Patient Management
 *
 * APIs for managing staff-patient relationships
 * 
 * @OA\Tag(
 *     name="Staff Patients",
 *     description="Operations on staff-patient relationships"
 * )
 */
class StaffPatientController extends Controller
{
    /**
     * List all staff-patient relationships
     * 
     * Returns a collection of all staff-patient relationship records.
     *
     * @OA\Get(
     *     path="/api/staff-patients",
     *     operationId="getStaffPatients",
     *     summary="Get a list of all staff-patient relationships",
     *     tags={"Staff Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="staff_id", type="integer", example=1),
     *                 @OA\Property(property="patient_id", type="integer", example=2),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $staffPatients = StaffPatient::all();
        
        return response()->json($staffPatients, 200);
    }

    /**
     * Create a new staff-patient relationship
     * 
     * Stores a new staff-patient relationship in the database.
     *
     * @OA\Post(
     *     path="/api/staff-patients",
     *     operationId="storeStaffPatient",
     *     summary="Create a new staff-patient relationship",
     *     tags={"Staff Patients"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Staff-patient data",
     *         @OA\JsonContent(
     *             required={"staff_id", "patient_id"},
     *             @OA\Property(property="staff_id", type="integer", example=1, description="ID of the staff member"),
     *             @OA\Property(property="patient_id", type="integer", example=2, description="ID of the patient")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Relationship created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="staff_id", type="integer", example=1),
     *             @OA\Property(property="patient_id", type="integer", example=2),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-13T14:30:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T14:30:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The given data was invalid."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "staff_id": {
     *                         "The staff id field is required."
     *                     },
     *                     "patient_id": {
     *                         "The patient id field is required."
     *                     }
     *                 }
     *             )
     *         )
     *     )
     * )
     * 
     * @param Request $request The request object
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|integer|exists:staff,id',
            'patient_id' => 'required|integer|exists:patients,id',
        ]);

        $staffPatient = StaffPatient::create($validatedData);

        return response()->json($staffPatient, 201);
    }

    /**
     * Get a specific staff-patient relationship
     * 
     * Returns details of a specific staff-patient relationship.
     *
     * @OA\Get(
     *     path="/api/staff-patients/{id}",
     *     operationId="getStaffPatientById",
     *     summary="Get a specific staff-patient relationship",
     *     tags={"Staff Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff-patient relationship",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=2),
     *             @OA\Property(property="staff_id", type="integer", example=3),
     *             @OA\Property(property="patient_id", type="integer", example=4),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff-patient relationship not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Staff-patient relationship not found")
     *         )
     *     )
     * )
     * 
     * @param StaffPatient $staffPatient The staff-patient relationship
     * @urlParam id integer required The ID of the staff-patient relationship. Example: 1
     * @return JsonResponse
     */
    public function show(StaffPatient $staffPatient): JsonResponse
    {
        return response()->json($staffPatient, 200);
    }

    /**
     * Update a staff-patient relationship
     * 
     * Updates an existing staff-patient relationship.
     *
     * @OA\Put(
     *     path="/api/staff-patients/{id}",
     *     operationId="updateStaffPatient",
     *     summary="Update a staff-patient relationship",
     *     tags={"Staff Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff-patient relationship",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated staff-patient data",
     *         @OA\JsonContent(
     *             @OA\Property(property="staff_id", type="integer", example=5, description="ID of the staff member"),
     *             @OA\Property(property="patient_id", type="integer", example=6, description="ID of the patient")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Relationship updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=3),
     *             @OA\Property(property="staff_id", type="integer", example=5),
     *             @OA\Property(property="patient_id", type="integer", example=6),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T15:45:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff-patient relationship not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Staff-patient relationship not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The given data was invalid."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "staff_id": {
     *                         "The staff id must be an integer."
     *                     }
     *                 }
     *             )
     *         )
     *     )
     * )
     * 
     * @param Request $request The request object
     * @param StaffPatient $staffPatient The staff-patient relationship
     * @urlParam id integer required The ID of the staff-patient relationship. Example: 1
     * @bodyParam staff_id integer The ID of the staff member. Example: 5
     * @bodyParam patient_id integer The ID of the patient. Example: 6
     * @return JsonResponse
     */
    public function update(Request $request, StaffPatient $staffPatient): JsonResponse
    {
        $validatedData = $request->validate([
            'staff_id' => 'sometimes|required|integer|exists:staff,id',
            'patient_id' => 'sometimes|required|integer|exists:patients,id',
        ]);

        $staffPatient->update($validatedData);

        return response()->json($staffPatient, 200);
    }

    /**
     * Delete a staff-patient relationship
     * 
     * Removes a staff-patient relationship from the database.
     *
     * @OA\Delete(
     *     path="/api/staff-patients/{id}",
     *     operationId="deleteStaffPatient",
     *     summary="Delete a staff-patient relationship",
     *     tags={"Staff Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff-patient relationship",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Relationship deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff-patient relationship not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Staff-patient relationship not found")
     *         )
     *     )
     * )
     * 
     * @param StaffPatient $staffPatient The staff-patient relationship
     * @urlParam id integer required The ID of the staff-patient relationship. Example: 1
     * @return JsonResponse
     */
    public function destroy(StaffPatient $staffPatient): JsonResponse
    {
        $staffPatient->delete();

        return response()->json(null, 204);
    }
}