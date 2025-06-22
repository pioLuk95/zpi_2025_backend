<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use App\Models\EmergencyCalls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/**
 * @OA\Tag(
 * name="EmergencyCalls",
 * description="API Endpoints for managing emergency calls for patients"
 * )
 */
class EmergencyCallsController extends Controller
{
    use ApiResponseTrait;

    /**
     * Create a new emergency call.
     *
     * Creates a new emergency call for the authenticated user. 
     * The patient_id is automatically assigned based on the logged-in user.
     * The creation timestamp is automatically set by the server.
     *
     * @group EmergencyCalls
     * * @OA\Post(
     * path="/api/emergency-calls",
     * operationId="createEmergencyCall",
     * tags={"EmergencyCalls"},
     * summary="Create a new emergency call",
     * description="Creates a new emergency call for the authenticated user. The patient_id is automatically assigned based on the logged-in user. This endpoint does not require a request body.",
     * security={{"bearerAuth": {}}},
     * @OA\Response(
     * response=201,
     * description="Emergency call created successfully",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(
     * property="success", type="boolean", example=true
     * ),
     * @OA\Property(property="message", type="string", example="Emergency call created successfully"),
     * example={
     * "success": true,
     * "message": "Emergency call created successfully"
     * }
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized - Authentication required",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=false),
     * @OA\Property(property="message", type="string", example="Unauthorized"),
     * @OA\Property(property="code", type="integer", example=10002),
     * example={
     * "success": false,
     * "message": "Unauthorized",
     * "code": 10002
     * }
     * )
     * ),
     * @OA\Response(
     * response=429,
     * description="Too Many Requests - Rate limit exceeded",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=false),
     * @OA\Property(property="code", type="integer", example=15001),
     * @OA\Property(property="message", type="string", example="You have made too many requests in a short period. Please try again later."),
     * example={
     * "success": false,
     * "message": " You have made too many requests in a short period. Please try again later.",
     * "code": 15001
     * }
     * )
     * ),
     * @OA\Response(
     * response=500,
     * description="Internal Server Error",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=false),
     * @OA\Property(property="message", type="string", example="An unexpected error occurred on the server."),
     * @OA\Property(property="code", type="integer", example=19001),
     * example={
     * "success": false,
     * "message": "An unexpected error occurred on the server.",
     * "code": 19001
     * }
     * )
     * ),
     * @OA\Response(
     * response=503,
     * description="Service Unavailable - Database connection issues",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=false),
     * @OA\Property(property="message", type="string", example="The service is temporarily unavailable. Please try again later."),
     * @OA\Property(property="code", type="integer", example=19002),
     * example={
     * "success": false,
     * "message": "The service is temporarily unavailable. Please try again later.",
     * "code": 19002
     * }
     * )
     * )
     * )
     */
    public function store(Request $request)
    {
        $user = auth()->user(); 
        $patientId = $user->id;

        try {
            EmergencyCalls::create([
                'patient_id' => $patientId,
                'date' => Carbon::now(),
                'status' => 0, 
            ]);
           
            return $this->successResponse([], 'Emergency call created successfully', 201);
            
        } catch (\Illuminate\Database\QueryException $e) {
            $sqlState = $e->errorInfo[0] ?? null;
            
            if (in_array($sqlState, ['08001', '08003', '08004', '08006', '08007', '08S01'])) {
                \Illuminate\Support\Facades\Log::error('Service unavailable - DB connection issue: ' . $e->getMessage());
                return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
            }
            
            \Illuminate\Support\Facades\Log::error('Server error - DB query exception: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Generic exception in EmergencyCallsController: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}