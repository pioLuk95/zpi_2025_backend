<?php

namespace App\Http\Controllers\Api;

use App\Models\Recomendation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @group Recommendations
 * 
 * Operations related to recommendations
 * 
 * @OA\Tag(
 *     name="Recommendations",
 *     description="Operations related to recommendations"
 * )
 */
class RecomendationController extends Controller
{
    /**
     * Get all recommendations
     * 
     * Returns a list of all recommendations available in the system.
     * 
     * @OA\Get(
     *     path="/api/recommendations",
     *     operationId="getRecommendations",
     *     summary="Get all recommendations",
     *     tags={"Recommendations"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Check-up Visit"),
     *                 @OA\Property(property="description", type="string", example="Recommended check-up visit in 3 months"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-13T14:30:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T14:30:00Z")
     *             )
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $recommendations = Recomendation::all();
        return response()->json($recommendations, 200);
    }

    /**
     * Create a new recommendation
     * 
     * Stores a new recommendation in the database.
     * 
     * @OA\Post(
     *     path="/api/recommendations",
     *     operationId="storeRecommendation",
     *     summary="Create a new recommendation",
     *     tags={"Recommendations"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Recommendation data",
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Check-up Visit", description="Recommendation title"),
     *             @OA\Property(property="description", type="string", example="Recommended check-up visit in 3 months", description="Recommendation description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Recommendation created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Check-up Visit"),
     *             @OA\Property(property="description", type="string", example="Recommended check-up visit in 3 months"),
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
     *                     "title": {
     *                         "The title field is required."
     *                     }
     *                 }
     *             )
     *         )
     *     )
     * )
     * 
     * @param Request $request Request object
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $recommendation = Recomendation::create($validatedData);

        return response()->json($recommendation, 201);
    }

    /**
     * Get recommendation details
     * 
     * Returns detailed information about a specific recommendation.
     * 
     * @OA\Get(
     *     path="/api/recommendations/{id}",
     *     operationId="getRecommendationById",
     *     summary="Get recommendation details",
     *     tags={"Recommendations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the recommendation",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Check-up Visit"),
     *             @OA\Property(property="description", type="string", example="Recommended check-up visit in 3 months"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-13T14:30:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T14:30:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recommendation not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Recommendation not found")
     *         )
     *     )
     * )
     * 
     * @param Recomendation $recomendation Recommendation object
     * @return JsonResponse
     */
    public function show(Recomendation $recomendation): JsonResponse
    {
        return response()->json($recomendation, 200);
    }

    /**
     * Update a recommendation
     * 
     * Updates an existing recommendation with new data.
     * 
     * @OA\Put(
     *     path="/api/recommendations/{id}",
     *     operationId="updateRecommendation",
     *     summary="Update a recommendation",
     *     tags={"Recommendations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the recommendation",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated recommendation data",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Modified Title"),
     *             @OA\Property(property="description", type="string", example="Modified recommendation description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recommendation updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Modified Title"),
     *             @OA\Property(property="description", type="string", example="Modified recommendation description"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-13T14:30:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T15:45:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recommendation not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Recommendation not found")
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
     *             )
     *         )
     *     )
     * )
     * 
     * @param Request $request Request object
     * @param Recomendation $recomendation Recommendation object
     * @return JsonResponse
     */
    public function update(Request $request, Recomendation $recomendation): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        $recomendation->update($validatedData);

        return response()->json($recomendation, 200);
    }

    /**
     * Delete a recommendation
     * 
     * Removes a specific recommendation from the system.
     * 
     * @OA\Delete(
     *     path="/api/recommendations/{id}",
     *     operationId="deleteRecommendation",
     *     summary="Delete a recommendation",
     *     tags={"Recommendations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the recommendation",
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Recommendation deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recommendation not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Recommendation not found")
     *         )
     *     )
     * )
     * 
     * @param Recomendation $recomendation Recommendation object
     * @return JsonResponse
     */
    public function destroy(Recomendation $recomendation): JsonResponse
    {
        $recomendation->delete();

        return response()->json(null, 204);
    }

    /**
     * Form for creating a new recommendation
     * 
     * This method is not part of the REST API.
     * 
     * @OA\Skip
     */
    public function create()
    {
        // This method is not part of the REST API
    }

    /**
     * Form for editing a recommendation
     * 
     * This method is not part of the REST API.
     * 
     * @OA\Skip
     */
    public function edit(Recomendation $recomendation)
    {
        // This method is not part of the REST API
    }
}