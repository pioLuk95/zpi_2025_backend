<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class MedicalVisitController extends Controller
{
    use ApiResponseTrait;

    private array $availableSpecialists = []; 
    private array $visits = [];

    /**
     * @OA\Post(
     *     path="/api/medical-visits/schedule",
     *     summary="Schedule New Medical Appointment",
     *     description="Creates a new medical appointment booking.",
     *     operationId="scheduleVisit",
     *     tags={"Medical Visits"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"specialist_type", "date_time", "reason"},
     *             @OA\Property(property="specialist_type", type="string", example="doctor", enum={"doctor", "nurse", "physiotherapist"}, description="Type of the specialist for the visit. Possible values: doctor, nurse, physiotherapist."),
     *             @OA\Property(property="date_time", type="string", example="2025-06-15-14-30", description="Date and time of the visit in YYYY-MM-DD-HH-mm format."),
     *             @OA\Property(property="reason", type="string", example="Consultation about blood pressure")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment scheduled successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Medical visit scheduled successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Authentication token not provided."),
     *             @OA\Property(property="code", type="integer", example=10002)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="code", type="integer", example=11000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialist of the requested type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="The requested resource was not found."),
     *             @OA\Property(property="code", type="integer", example=13001)
     *         )
     *     )
     * )
     */
    public function scheduleVisit(Request $request): JsonResponse
    {
       
       
       
        $user = auth()->user();
        if (!$user) {
         
            return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN);
        }

        $validator = Validator::make($request->all(), [
            'specialist_type' => 'required|in:doctor,nurse,physiotherapist',
            'date_time' => 'required|date_format:Y-m-d-H-i|after_or_equal:today',
            'reason' => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $validator->errors());
        }

        $data = $validator->validated();
        
        
        $specialist = collect($this->availableSpecialists)->firstWhere('type', $data['specialist_type']);

        if (!$specialist) {
            return $this->errorResponse(ApiErrorCodes::RESOURCE_NOT_FOUND);
        }

        $visitId = 'visit_' . time() . '_' . rand(1000, 9999);
       
        $this->visits[] = array_merge($data, ['visit_id' => $visitId]);

        return $this->successResponse([], 'Medical visit scheduled successfully', 201);
    }
}
