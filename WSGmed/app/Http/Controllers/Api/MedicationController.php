<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @group Medication Management
 *
 * APIs for managing medications
 */
class MedicationController extends Controller
{
    /**
     * List all medications
     * 
     * Retrieves a list of all medications in the system.
     * 
     * @return JsonResponse
     * 
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Paracetamol",
     *        "info": "Pain reliever that can reduce fever and relieve mild to moderate pain",
     *        "created_at": "2025-05-05T12:00:00Z",
     *        "updated_at": "2025-05-05T12:00:00Z"
     *      },
     *      {
     *        "id": 2,
     *        "name": "Ibuprofen",
     *        "info": "Nonsteroidal anti-inflammatory drug used for treating pain, fever, and inflammation",
     *        "created_at": "2025-05-05T12:00:00Z",
     *        "updated_at": "2025-05-05T12:00:00Z"
     *      }
     *    ]
     * }
     * 
     * @OA\Get(
     *     path="/api/medications",
     *     summary="Get all medications",
     *     tags={"Medications"},
     *     @OA\Response(
     *         response=200,
     *         description="List of medications",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Paracetamol"),
     *                     @OA\Property(property="info", type="string", example="Pain reliever that can reduce fever and relieve mild to moderate pain"),
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
        return response()->json(['data' => Medication::all()], 200);
    }

    /**
     * Create a medication
     * 
     * Creates a new medication with the provided information.
     * 
     * @bodyParam name string required The name of the medication. Example: Ibuprofen
     * @bodyParam info string required Detailed information about the medication. Example: Nonsteroidal anti-inflammatory drug used for treating pain, fever, and inflammation
     * 
     * @response 201 {
     *    "data": {
     *      "id": 1,
     *      "name": "Ibuprofen",
     *      "info": "Nonsteroidal anti-inflammatory drug used for treating pain, fever, and inflammation",
     *      "created_at": "2025-05-05T12:00:00Z",
     *      "updated_at": "2025-05-05T12:00:00Z"
     *    }
     * }
     * 
     * @response 422 {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *      "name": ["The name field is required."],
     *      "info": ["The info field is required."]
     *    }
     * }
     * 
     * @OA\Post(
     *     path="/api/medications",
     *     summary="Create a new medication",
     *     tags={"Medications"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "info"},
     *             @OA\Property(property="name", type="string", maxLength=255, example="Ibuprofen"),
     *             @OA\Property(property="info", type="string", maxLength=1000, example="Nonsteroidal anti-inflammatory drug used for treating pain, fever, and inflammation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Medication created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Ibuprofen"),
     *                 @OA\Property(property="info", type="string", example="Nonsteroidal anti-inflammatory drug used for treating pain, fever, and inflammation"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name field is required.")),
     *                 @OA\Property(property="info", type="array", @OA\Items(type="string", example="The info field is required."))
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:1000',
        ]);

        $medication = Medication::create($validated);

        return response()->json(['data' => $medication], 201);
    }

    /**
     * Get a medication
     * 
     * Retrieves information about a specific medication.
     * 
     * @urlParam id integer required The ID of the medication. Example: 1
     * 
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Aspirin",
     *      "info": "Used to treat pain, fever, or inflammation",
     *      "created_at": "2025-05-05T12:00:00Z",
     *      "updated_at": "2025-05-05T12:00:00Z"
     *    }
     * }
     * 
     * @response 404 {
     *    "message": "No query results for model [App\\Models\\Medication] 999"
     * }
     * 
     * @OA\Get(
     *     path="/api/medications/{id}",
     *     summary="Get a specific medication",
     *     tags={"Medications"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Medication ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Aspirin"),
     *                 @OA\Property(property="info", type="string", example="Used to treat pain, fever, or inflammation"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Medication not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Medication] 999")
     *         )
     *     )
     * )
     */
    public function show(Medication $medication): JsonResponse
    {
        return response()->json(['data' => $medication], 200);
    }

    /**
     * Update a medication
     * 
     * Updates an existing medication with new information.
     * 
     * @urlParam id integer required The ID of the medication. Example: 1
     * @bodyParam name string The name of the medication. Example: Amoxicillin
     * @bodyParam info string Detailed information about the medication. Example: Antibiotic used to treat bacterial infections
     * 
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Amoxicillin",
     *      "info": "Antibiotic used to treat bacterial infections",
     *      "created_at": "2025-05-05T12:00:00Z",
     *      "updated_at": "2025-05-05T12:00:00Z"
     *    }
     * }
     * 
     * @response 404 {
     *    "message": "No query results for model [App\\Models\\Medication] 999"
     * }
     * 
     * @response 422 {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *      "name": ["The name may not be greater than 255 characters."],
     *      "info": ["The info may not be greater than 1000 characters."]
     *    }
     * }
     * 
     * @OA\Put(
     *     path="/api/medications/{id}",
     *     summary="Update a medication",
     *     tags={"Medications"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Medication ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", maxLength=255, example="Amoxicillin"),
     *             @OA\Property(property="info", type="string", maxLength=1000, example="Antibiotic used to treat bacterial infections")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication updated",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Amoxicillin"),
     *                 @OA\Property(property="info", type="string", example="Antibiotic used to treat bacterial infections"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Medication not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Medication] 999")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name may not be greater than 255 characters.")),
     *                 @OA\Property(property="info", type="array", @OA\Items(type="string", example="The info may not be greater than 1000 characters."))
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, Medication $medication): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'info' => 'sometimes|string|max:1000',
        ]);

        $medication->update($validated);

        return response()->json(['data' => $medication], 200);
    }

    /**
     * Delete a medication
     * 
     * Permanently removes a medication from the system.
     * 
     * @urlParam id integer required The ID of the medication. Example: 1
     * 
     * @response 204 ""
     * 
     * @response 404 {
     *    "message": "No query results for model [App\\Models\\Medication] 999"
     * }
     * 
     * @OA\Delete(
     *     path="/api/medications/{id}",
     *     summary="Delete a medication",
     *     tags={"Medications"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Medication ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Medication deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Medication not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Medication] 999")
     *         )
     *     )
     * )
     */
    public function destroy(Medication $medication): JsonResponse
    {
        $medication->delete();

        return response()->json(null, 204);
    }
}