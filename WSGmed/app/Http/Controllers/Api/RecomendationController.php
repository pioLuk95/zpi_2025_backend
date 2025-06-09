<?php

namespace App\Http\Controllers\Api;

use App\Models\Recomendation;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

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
     *             @OA\Property(property="error_code", type="integer", example=1004),
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
        if (!$recomendation) {
            return response()->json([
                'error_code' => 1004,
                'message' => 'Recommendation not found'
            ], 404);
        }

        return response()->json($recomendation, 200);
    }
}