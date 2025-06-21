<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException; 
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Carbon\Carbon; 
use Tymon\JWTAuth\Facades\JWTAuth;

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
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
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
     *             @OA\Property(property="message", type="string", example="The requested resource was not found."),
     *             @OA\Property(property="code", type="integer", example=13001)
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Conflict - Visit slot unavailable",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="The selected specialist is unavailable at this time. Please choose a different time slot."),
     *             @OA\Property(property="code", type="integer", example=14001),
     *             example={"success": false, "message": "The selected specialist is unavailable at this time. Please choose a different time slot.", "code": 14001}
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
     *             example={"success": false, "message": "The service is temporarily unavailable. Please try again later.", "code": 19002}
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
     *             example={"success": false, "message": "An unexpected error occurred on the server.", "code": 19001}
     *         )
     *     )
     * )
     */
    public function scheduleVisit(Request $request): JsonResponse
    {
       
        try { 
            $user = auth()->user();
            if (!$user || !isset($user->patient_id)) {
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

            
            foreach ($this->visits as $existingVisit) {
                if (isset($existingVisit['specialist_type']) && $existingVisit['specialist_type'] === $data['specialist_type'] &&
                    isset($existingVisit['date_time']) && $existingVisit['date_time'] === $data['date_time']) {
                    return $this->errorResponse(ApiErrorCodes::VISIT_SLOT_UNAVAILABLE);
                }
            }
            

            $specialist = collect($this->availableSpecialists)->firstWhere('type', $data['specialist_type']);
            
            if (!$specialist && empty($this->availableSpecialists)) { 
                
            }

            $visitId = 'visit_' . time() . '_' . rand(1000, 9999);
            $this->visits[] = array_merge($data, ['visit_id' => $visitId, 'patient_id' => $user->patient_id]);

            return $this->successResponse([], 'Medical visit scheduled successfully', 201);
        } catch (QueryException $e) {
            Log::error('Service unavailable - DB connection issue in MedicalVisitController@scheduleVisit: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (ModelNotFoundException $e) {
            Log::warning('Resource not found in MedicalVisitController@scheduleVisit: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::RESOURCE_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Generic exception in MedicalVisitController@scheduleVisit: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}
