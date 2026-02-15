<?php

namespace App\Http\Controllers\Api;

use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Recomendation;

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
     * Returns a list of recommendations for the authenticated patient.
     *
     * @OA\Get(
     *     path="/api/recommendations",
     *     operationId="getRecommendations",
     *     summary="Get all recommendations",
     *     tags={"Recommendations"},
     *     security={{"bearerAuth": {}}},
     *     description="Returns recommendations for the authenticated patient.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Recommendations retrieved successfully."),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="role_name", type="string", example="doctor"),
     *                     @OA\Property(property="date", type="string", format="date", example="2025-05-12"),
     *                     @OA\Property(property="tittle", type="string", example="Recommendation 1"),
     *                     @OA\Property(property="text", type="string", example="Perform breathing exercises 3 times a day for 10 minutes.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10002),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthorized",
     *                 "code": 10002
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=503,
     *         description="Service Unavailable - Database connection issues",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="The service is temporarily unavailable. Please try again later."),
     *             @OA\Property(property="code", type="integer", example=19002),
     *             example={
     *                 "success": false,
     *                 "message": "The service is temporarily unavailable. Please try again later.",
     *                 "code": 19002
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An unexpected error occurred on the server."),
     *             @OA\Property(property="code", type="integer", example=19001),
     *             example={
     *                 "success": false,
     *                 "message": "An unexpected error occurred on the server.",
     *                 "code": 19001
     *             }
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $patient = auth()->user();

            $recommendations = Recomendation::query()
                ->where('patient_id', $patient->id)
                ->with(['staff.role:id,name'])
                ->get(['id', 'staff_id', 'date', 'tittle', 'text', 'patient_id'])
                ->map(static fn (Recomendation $recommendation): array => [
                    'role_name' => $recommendation->staff?->role?->name,
                    'date' => $recommendation->date?->format('Y-m-d'),
                    'tittle' => $recommendation->tittle,
                    'text' => $recommendation->text,
                ]);

            return $this->successResponse($recommendations, 'Recommendations retrieved successfully.');
        } catch (QueryException $e) {
            Log::error('Service unavailable - DB connection issue in RecomendationController@index: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (\Exception $e) {
            Log::error('Generic exception in RecomendationController@index: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}
