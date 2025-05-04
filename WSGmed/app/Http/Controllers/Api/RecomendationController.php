<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recomendation;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/recomendations",
     *     summary="Get all recomendations",
     *     tags={"Recomendations"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all recomendations",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Recomendation"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Recomendation::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/recomendations",
     *     summary="Create a new recomendation",
     *     tags={"Recomendations"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="description", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Recomendation created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Recomendation")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $recomendation = Recomendation::create($validatedData);

        return response()->json($recomendation, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/recomendations/{id}",
     *     summary="Get a specific recomendation",
     *     tags={"Recomendations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the recomendation",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recomendation details",
     *         @OA\JsonContent(ref="#/components/schemas/Recomendation")
     *     )
     * )
     */
    public function show(Recomendation $recomendation)
    {
        return response()->json($recomendation, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/recomendations/{id}",
     *     summary="Update a specific recomendation",
     *     tags={"Recomendations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the recomendation",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="description", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recomendation updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Recomendation")
     *     )
     * )
     */
    public function update(Request $request, Recomendation $recomendation)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $recomendation->update($validatedData);

        return response()->json($recomendation, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/recomendations/{id}",
     *     summary="Delete a specific recomendation",
     *     tags={"Recomendations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the recomendation",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recomendation deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Recomendation deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy(Recomendation $recomendation)
    {
        $recomendation->delete();

        return response()->json(['message' => 'Recomendation deleted successfully'], 200);
    }
}