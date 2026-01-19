<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use App\Models\EmergencyCalls;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
    * Creates a new emergency call for the authenticated patient.
    * The patient_id is taken from the JWT token (any provided patient_id in the payload is ignored).
    * Server sets insert_date to now and status to 1.
     *
     * @group EmergencyCalls
    * @OA\Post(
    *     path="/api/emergency-calls",
    *     operationId="createEmergencyCall",
    *     tags={"EmergencyCalls"},
    *     summary="Create a new emergency call",
    *     description="Creates a new emergency call for the authenticated patient. patient_id is derived from the JWT token; insert_date is set by the server; status is set to 1.",
    *     security={{"bearerAuth": {}}},
    *     @OA\RequestBody(
    *         required=false,
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="patient_id", type="integer", example=123, description="Optional. Ignored (patient_id is taken from JWT token).")
    *         )
    *     ),
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
        try {
            $user = auth()->user();
            if (!$user || !isset($user->id)) {
                return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN);
            }

            EmergencyCalls::create([
                'patient_id' => $user->id,
                'insert_date' => Carbon::now(),
                'status' => 1,
            ]);
           
            return $this->successResponse([], 'Emergency call created successfully', 201);
            
        } catch (QueryException $e) {
            Log::error('DB query exception in EmergencyCallsController@store: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (\Exception $e) {
            Log::error('Generic exception in EmergencyCallsController@store: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}