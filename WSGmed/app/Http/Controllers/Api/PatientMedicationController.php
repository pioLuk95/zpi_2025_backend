<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\PatientMedication;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

/**
 * @OA\Tag(
 *     name="Medications",
 *     description="API Endpoints for managing patient medications"
 * )
 */
class PatientMedicationController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Get(
     *     path="/api/medications",
     *     summary="Get patient's medications for a specific day",
     *     description="Returns a list of medications assigned to the logged-in patient for a given date.",
     *     operationId="getMedicationsByDate",
     *     tags={"Medications"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of medications",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="medication_id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Aspirin"),
     *                 @OA\Property(property="dosage", type="string", example="100mg"),     
     *                 @OA\Property(property="part_of_day", type="string", example="morning", enum={"morning", "midday", "evening", "night"}, description="Indicates the part of the day for medication intake. Possible values: morning, midday, evening, night."),
     *                 @OA\Property(property="is_taken", type="boolean", example=false)
     *             ),
     *             example={
     *                 {
     *                     "medication_id": 1,
     *                     "name": "Aspirin",
     *                     "dosage": "100mg",
     *                     "part_of_day": "morning",
     *                     "is_taken": false
     *                 },
     *                 {
     *                     "medication_id": 2,
     *                     "name": "Vitamin D",
     *                     "dosage": "1000 IU",
     *                     "part_of_day": "evening",
     *                     "is_taken": true
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10002),
     *             example={
     *                 "success": false,
     *                 "message": "Authentication token not provided.",
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
    public function getMedicationsByDate(Request $request)
    {
        $user = auth()->user();
        if (!$user || !isset($user->patient_id)) {
            
            return $this->errorResponse(ApiErrorCodes::AUTH_FORBIDDEN, 'User is not properly configured as a patient.', 403);
        }
        $patientId = $user->patient_id;

        try {
            $today = Carbon::today()->toDateString();

            
            $medications = PatientMedication::where('patient_id', $patientId)
                
                ->where('start_date', '<=', $today)
                ->where(function ($query) use ($today) {
                    $query->whereNull('end_date')
                          ->orWhere('end_date', '>=', $today);
                })
                ->get(['id as medication_id', 'name', 'dosage', 'part_of_day', 'is_taken']);

            return $this->successResponse($medications, 'Medications retrieved successfully.');
        } catch (QueryException $e) {
            Log::error('Service unavailable - DB connection issue in PatientMedicationController@getMedicationsByDate: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (\Exception $e) {
            Log::error('Generic exception in PatientMedicationController@getMedicationsByDate: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/medications/confirm",
     *     summary="Confirm medication intake",
     *     description="Updates the intake status of a medication for a given ID.",
     *     operationId="confirmMedication",
     *     tags={"Medications"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"medication_ids"},
     *             @OA\Property(property="medication_ids", type="array", @OA\Items(type="integer"), example={1, 2, 3}),
     *             example={
     *                 "medication_ids": {1, 2, 3}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication status updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Medication status updated"),
     *             example={
     *                 "success": true,
     *                 "message": "Medication status updated"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10002),
     *             example={
     *                 "success": false,
     *                 "message": "Authentication token not provided.",
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
    public function confirmMedication(Request $request)
    {
        $user = auth()->user();
        if (!$user || !isset($user->patient_id)) {
            return $this->errorResponse(ApiErrorCodes::AUTH_FORBIDDEN, 'User is not properly configured as a patient.', 403);
        }
        $patientId = $user->patient_id;

        try {
            $validated = $request->validate([
                'medication_ids'   => 'required|array|min:1',
                'medication_ids.*' => [
                    'required',
                    'integer',
                    'distinct',
                    Rule::exists('patient_medications', 'id')->where(function ($query) use ($patientId) {
                        return $query->where('patient_id', $patientId);
                    }),
                ],
            ], [
                'medication_ids.*.exists' => 'One or more medication IDs are invalid or do not belong to this patient.'
            ]);

            $medicationIdsToConfirm = $validated['medication_ids'];

            $updatedCount = PatientMedication::where('patient_id', $patientId)
                ->whereIn('id', $medicationIdsToConfirm)
                ->where('is_taken', false) 
                ->update(['is_taken' => true]);

            if ($updatedCount > 0) {
                return $this->successResponse([], $updatedCount . ' medication(s) confirmed successfully.');
            } else {
                return $this->successResponse([], 'No unconfirmed medications found for the provided IDs, or they were already confirmed.');
            }

        } catch (ValidationException $e) {
            return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $e->errors());
        } catch (QueryException $e) {
            Log::error('Service unavailable - DB connection issue in PatientMedicationController@confirmMedication: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (\Exception $e) {
            Log::error('Generic exception in PatientMedicationController@confirmMedication: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}
