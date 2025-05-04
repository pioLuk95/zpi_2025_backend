<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/medications",
     *     summary="Get all medications",
     *     tags={"Medications"},
     *     @OA\Response(
     *         response=200,
     *         description="List of medications",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Medication"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Medication::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/medications",
     *     summary="Create a new medication",
     *     tags={"Medications"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "info"},
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="info", type="string", maxLength=1000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Medication created",
     *         @OA\JsonContent(ref="#/components/schemas/Medication")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:1000',
        ]);

        $medication = Medication::create($validated);

        return response()->json($medication, 201);
    }

    /**
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
     *         @OA\JsonContent(ref="#/components/schemas/Medication")
     *     )
     * )
     */
    public function show(Medication $medication)
    {
        return response()->json($medication, 200);
    }

    /**
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
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="info", type="string", maxLength=1000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication updated",
     *         @OA\JsonContent(ref="#/components/schemas/Medication")
     *     )
     * )
     */
    public function update(Request $request, Medication $medication)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'info' => 'sometimes|string|max:1000',
        ]);

        $medication->update($validated);

        return response()->json($medication, 200);
    }

    /**
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
     *     )
     * )
     */
    public function destroy(Medication $medication)
    {
        $medication->delete();

        return response()->json(null, 204);
    }
}