<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Models\Appointment;

class MedicalVisitController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Post(
     *     path="/api/medical-visits/schedule",
    *     summary="Schedule New Medical Appointment",
    *     description="Creates a new medical appointment request for the authenticated patient.",
     *     operationId="scheduleVisit",
     *     tags={"Medical Visits"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
    *             required={"staff_role_id", "visit_date", "visit_hour", "comment"},
    *             @OA\Property(property="staff_role_id", type="integer", example=3, description="Requested staff role id (references roles.id)."),
    *             @OA\Property(property="visit_date", type="string", format="date", example="2026-01-15", description="Visit date (YYYY-MM-DD)."),
    *             @OA\Property(property="visit_hour", type="string", example="14:30", description="Visit hour (HH:mm)."),
    *             @OA\Property(property="comment", type="string", example="Consultation about blood pressure", description="Patient comment/reason for the visit.")
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
            if (!$user || !isset($user->id)) {
                return $this->errorResponse(ApiErrorCodes::AUTH_INVALID_OR_EXPIRED_TOKEN);
            }

            $validator = Validator::make($request->all(), [
                'staff_role' => 'required|string|exists:roles,name',
                'visit_date' => 'required|date_format:Y-m-d|after_or_equal:today',
                'visit_hour' => 'required|date_format:H:i',
                'comment' => 'required|string|min:3',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $validator->errors());
            }

            $data = $validator->validated();

            $role = Role::where('name', $data['staff_role'])->first();

            if (!$role) {
            return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, [
                'staff_role' => ['Invalid role name']
            ]);
        }

            $visitHour = $data['visit_hour'];
            if (preg_match('/^\d{2}:\d{2}$/', $visitHour) === 1) {
                $visitHour .= ':00';
            }

            Appointment::query()->create([
                'patient_id' => $user->id,
                'staff_id' => null,
                'staff_role_id' => $role->id,
                'insert_date' => Carbon::now(),
                'visit_date' => $data['visit_date'],
                'visit_hour' => $visitHour,
                'comment' => $data['comment'],
                'type' => 'home',
                'status' => 'new',
            ]);

            return $this->successResponse([], 'Medical visit scheduled successfully', 201);
        } catch (QueryException $e) {
            Log::error('Service unavailable - DB connection issue in MedicalVisitController@scheduleVisit: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (\Exception $e) {
            Log::error('Generic exception in MedicalVisitController@scheduleVisit: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}
