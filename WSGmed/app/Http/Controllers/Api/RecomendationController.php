<?php

namespace App\Http\Controllers\Api;

use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Recomendation;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon; 
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
    use ApiResponseTrait;

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
     *                 @OA\Property(property="title", type="string", example="Check-up Visit"),
     *                 @OA\Property(property="description", type="string", example="Recommended check-up visit in 3 months"),
     *                 @OA\Property(property="created_at", type="string", example="2025-05-13-14-30-00", description="Creation date in YYYY-MM-DD-HH-mm-ss format"),
     *                 @OA\Property(property="specialist_type", type="string", example="doctor", enum={"doctor", "nurse", "physiotherapist"}, description="Type of the specialist who added the recommendation. Possible values: doctor, nurse, physiotherapist.")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10002) 
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An unexpected error occurred on the server."),
     *             @OA\Property(property="code", type="integer", example=19001)
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $recommendations = Recomendation::all();
        $transformedRecommendations = $recommendations->map(function (Recomendation $recommendation) {
            $specialistType = null;
            if ($recommendation->staffPatient && $recommendation->staffPatient->staff && $recommendation->staffPatient->staff->type) {
                
                $type = strtolower($recommendation->staffPatient->staff->type);
                if (in_array($type, ['doctor', 'nurse', 'physiotherapist'])) {
                    $specialistType = $type;
                }
            }
            return [
                'title' => $recommendation->title,
                'description' => $recommendation->description,
                'created_at' => Carbon::parse($recommendation->created_at)->format('Y-m-d-H-i-s'),
                'specialist_type' => $specialistType,
            ];
        });
        return $this->successResponse($transformedRecommendations, 'Recommendations retrieved successfully.');
    }
}
