<?php

namespace App\Http\Controllers\Api;

use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

/**
 * @group Medical Records
 *
 * API endpoints for managing patient medical records
 * * @OA\Tag(
 * name="Medical Records",
 * description="API Endpoints for managing patient medical records"
 * )
 */
class MedicalRecordController extends Controller
{
    use ApiResponseTrait;

    /**
     * Create a new medical record
     * * Creates a new medical record for the authenticated patient with the provided health parameters. 
     * The patient_id is automatically retrieved from the authenticated user. 
     * * @bodyParam blood_pressure integer required Blood pressure value. Example: 120
     * @bodyParam temperature numeric required Body temperature in Celsius (e.g., 36.6). Example: 36.6
     * @bodyParam pulse integer required Pulse rate (beats per minute). Example: 75
     * @bodyParam weight numeric required Weight in kilograms (e.g., 70.55). Example: 70.55
     * @bodyParam mood string required Mood rating. Possible values: "Very bad", "Bad", "Good", "Very good". Example: "Good"
     * @bodyParam pain_level integer required Pain level (scale 1-10, where 1 is no pain and 10 is worst pain). Example: 3
     * @bodyParam oxygen_saturation integer required Blood oxygen saturation (%, 0-100). Example: 98
     * @bodyParam date_time string required Date and time of the record in YYYY-MM-DD-HH-mm-ss format. This field is IGNORED - the server will automatically use the current timestamp. Example: 2025-07-15-10-30-00
     * * @response status=201 scenario="Success" {
     * "success": true,
     * "message": "Medical record created successfully",
     * }
     * * @response status=422 scenario="Validation error" {
     * "success": false,
     * "message": "The given data was invalid.",
     * "code": 11000
     * }
     * @response status=401 {
     * "success": false,
     * "error": "Authentication token not provided.",
     * "code": 10002
     * }
     * @response status=429 {
     * "success": false,
     * "error": "You have made too many requests in a short period. Please try again later.",
     * "code": 15001
     * }
     * @response status=500 {
     * "success": false,
     * "error": "An unexpected error occurred on the server.",
     * "code": 19001
     * }
     * @response status=503 {
     * "success": false,
     * "error": "The service is temporarily unavailable. Please try again later.",
     * "code": 19002
     * }
     * * @OA\Post(
     * path="/api/medical-records",
     * summary="Create a new medical record",
     * description="Creates a new medical record for the authenticated patient.",
     * tags={"Medical Records"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"date_time", "blood_pressure", "temperature", "pulse", "weight", "mood", "pain_level", "oxygen_saturation"},
     * @OA\Property(
     * property="date_time",
     * type="string",
     * format="date-time",
     * example="2025-07-15-10-30-00",
     * description="Date and time of the record in YYYY-MM-DD-HH-mm-ss format. This field is IGNORED - the server will automatically use the current timestamp."
     * ),
     * @OA\Property(property="blood_pressure", type="integer", example=120),     
     * @OA\Property(property="temperature", type="number", format="float", example=36.6, description="Body temperature in Celsius, e.g., up to one decimal place."),
     * @OA\Property(property="pulse", type="integer", example=75),
     * @OA\Property(property="weight", type="number", format="float", example=70.55, description="Weight in kilograms, e.g., up to two decimal places."),
     * @OA\Property(property="mood", type="string", example="Good", enum={"Very bad", "Bad", "Good", "Very good"}, description="Patient's mood rating."),
     * @OA\Property(property="pain_level", type="integer", example=3, enum={1,2,3,4,5,6,7,8,9,10}, description="Pain level on a scale of 1 (no pain) to 10 (worst pain)."),
     * @OA\Property(property="oxygen_saturation", type="integer", example=98, description="Blood oxygen saturation (%, 0-100)")
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Medical record created successfully",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="success", type="boolean", example=true),
     * @OA\Property(property="message", type="string", example="Medical record created successfully"),
     * example={"success": true, "message": "Medical record created successfully"}
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Validation error",
     * @OA\JsonContent(
     * @OA\Property(property="success", type="boolean", example=false),
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="code", type="integer", example=11000),
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
     * "message": "Authentication token not provided.",
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
     * "message": "You have made too many requests in a short period. Please try again later.",
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
    public function store(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();
            if (!$user || !isset($user->patient_id)) {
                return $this->errorResponse(
                    ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN,
                    'Invalid authentication token or user not configured as patient.',
                    401
                );
            }

            $validator = Validator::make($request->all(), [
                'blood_pressure' => 'required|integer',
                'temperature' => 'required|numeric',
                'pulse' => 'required|integer',
                'weight' => 'required|numeric',
                'mood' => 'required|string|in:Very bad,Bad,Good,Very good',
                'pain_level' => 'required|integer|between:1,10',
                'oxygen_saturation' => 'required|integer|between:0,100',
               
               
            ]);

            if ($validator->fails()) {
                return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $validator->errors());
            }
            
            $validatedData = $validator->validated();
            $validatedData['patient_id'] = $user->patient_id;
            $validatedData['date_time'] = Carbon::now()->format('Y-m-d-H-i-s'); 

            MedicalRecord::create($validatedData);
            
            return $this->successResponse([], 'Medical record created successfully', 201);
        } catch (ValidationException $e) {
            return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $e->errors());
        } catch (QueryException $e) {
            Log::error('Database query exception in MedicalRecordController@store: ' . $e->getMessage());
            $sqlState = $e->errorInfo[0] ?? null;
            
            if (in_array($sqlState, ['08001', '08003', '08004', '08006', '08007', '08S01'])) {
                return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
            }
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        } catch (\Exception $e) {
            Log::error('Generic exception in MedicalRecordController@store: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}