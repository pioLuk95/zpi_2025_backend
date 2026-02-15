<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Common\ApiErrorCodes;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\PatientMedication;
use App\Models\PatientMedicationConfirmation;

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
         *     summary="Get patient's medications for today",
         *     description="Returns a list of medications assigned to the logged-in patient for today based on start_date/end_date and marks them as taken if a confirmation exists for today.",
         *     operationId="getMedicationsByDate",
         *     tags={"Medications"},
         *     security={{"bearerAuth": {}}},
         *     @OA\Response(
         *         response=200,
         *         description="List of medications",
         *         @OA\JsonContent(
         *             type="object",
         *             @OA\Property(property="success", type="boolean", example=true),
         *             @OA\Property(property="message", type="string", example="Medications retrieved successfully."),
         *             @OA\Property(
         *                 property="data",
         *                 type="object",
         *                 @OA\Property(property="med_taken", type="integer", example=2),
         *                 @OA\Property(property="med_all", type="integer", example=3),
         *                 @OA\Property(
         *                     property="medications",
         *                     type="array",
         *                     @OA\Items(
         *                         type="object",
         *                         @OA\Property(property="name", type="string", example="Aspirin"),
         *                         @OA\Property(property="info", type="string", example="Pain reliever and fever reducer."),
         *                         @OA\Property(property="patient_medication_id", type="integer", example=10),
         *                         @OA\Property(property="dosage", type="string", example="1 tabletka"),
         *                         @OA\Property(property="is_taken", type="boolean", example=false)
         *                     )
         *                 )
         *             )
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
        if (!$user || !isset($user->id)) { 
            return $this->errorResponse(ApiErrorCodes::AUTH_FORBIDDEN, 'User is not properly configured as a patient.', 403);
        }
        $patientId = $user->id;
        try {
            $today = Carbon::today()->toDateString();

            $patientMedicationsQuery = PatientMedication::query()
                ->where('patient_id', '=', $patientId)
                ->whereDate('start_date', '<=', $today)
                ->where(function ($query) use ($today) {
                    $query->whereNull('end_date')
                        ->orWhereDate('end_date', '>=', $today);
                });

            $medAll = (clone $patientMedicationsQuery)->count();
            $medTaken = (int) PatientMedicationConfirmation::query()
                ->whereNotNull('confirmation_date')
                ->whereDate('confirmation_date', '=', $today)
                ->whereIn('patient_medication_id', (clone $patientMedicationsQuery)->select('id'))
                ->distinct()
                ->count('patient_medication_id');

            $patientMedications = (clone $patientMedicationsQuery)
                ->with([
                    'medication:id,name,info',
                ])
                ->get(['id', 'medication_id', 'dosage']);

            $medicationIds = $patientMedications->pluck('id')->all();
            $takenIds = empty($medicationIds)
                ? []
                : PatientMedicationConfirmation::query()
                    ->whereIn('patient_medication_id', $medicationIds)
                    ->whereNotNull('confirmation_date')
                    ->whereDate('confirmation_date', '=', $today)
                    ->pluck('patient_medication_id')
                    ->unique()
                    ->all();
            $takenIdSet = empty($takenIds) ? [] : array_fill_keys($takenIds, true);

            $medications = $patientMedications->map(function (PatientMedication $pm) use ($takenIdSet) {
                return [
                    'name' => $pm->medication?->name,
                    'info' => $pm->medication?->info,
                    'patient_medication_id' => (int) $pm->id,
                    'dosage' => (string) $pm->dosage,
                    'is_taken' => isset($takenIdSet[$pm->id]),
                ];
            });

            return $this->successResponse([
                'med_taken' => $medTaken,
                'med_all' => $medAll,
                'medications' => $medications,
            ], 'Medications retrieved successfully.');
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
             *     description="Creates (or removes) today's medication confirmations.",
     *     operationId="confirmMedication",
     *     tags={"Medications"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
        *             required={"medications"},
        *             @OA\Property(
        *                 property="medications",
        *                 type="array",
        *                 @OA\Items(
        *                     type="object",
          *                     required={"patient_medication_id","is_taken"},
        *                     @OA\Property(property="patient_medication_id", type="integer", example=10),
        *                     @OA\Property(property="is_taken", type="boolean", example=true)
        *                 )
        *             ),
        *             example={
        *                 "medications": {
          *                     {"patient_medication_id": 10, "is_taken": true},
          *                     {"patient_medication_id": 11, "is_taken": false}
        *                 }
        *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication status updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
          *             @OA\Property(property="message", type="string", example="Medication confirmations saved"),
          *             @OA\Property(
          *                 property="data",
          *                 type="object",
          *                 @OA\Property(property="confirmed", type="integer", example=2)
          *             ),
      *             example={
      *                 "success": true,
          *                 "message": "Medication confirmations saved",
          *                 "data": {"confirmed": 2}
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
        if (!$user || !isset($user->id)) { 
            return $this->errorResponse(ApiErrorCodes::AUTH_FORBIDDEN, 'User is not properly configured as a patient.', 403);
        }
        $patientId = $user->id;

        try {
            $validator = Validator::make($request->all(), [
                'medications' => 'required|array|min:1',
                'medications.*.patient_medication_id' => [
                    'required',
                    'integer',
                    'distinct',
                    Rule::exists('patient_medications', 'id')->where(function ($query) use ($patientId) {
                        return $query->where('patient_id', $patientId);
                    }),
                ],
                'medications.*.is_taken' => 'required|boolean',
            ], [
                'medications.*.patient_medication_id.exists' => 'One or more medication IDs are invalid or do not belong to this patient.',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse(ApiErrorCodes::VALIDATION_FAILED, $validator->errors());
            }

            $validated = $validator->validated();
            $now = Carbon::now();
            $confirmedCount = 0;

            foreach ($validated['medications'] as $item) {
                $id = (int) $item['patient_medication_id'];

                if ($item['is_taken']) {
                    $existsToday = PatientMedicationConfirmation::query()
                        ->where('patient_medication_id', $id)
                        ->whereDate('confirmation_date', Carbon::today())
                        ->exists();

                    if ($existsToday) {
                        continue;
                    }

                    PatientMedicationConfirmation::create([
                        'patient_medication_id' => $id,
                        'confirmation_date' => $now,
                    ]);

                    $confirmedCount++;
                } else {
                    PatientMedicationConfirmation::query()
                        ->where('patient_medication_id', $id)
                        ->whereDate('confirmation_date', Carbon::today())
                        ->delete();
                }
            }

            return $this->successResponse([
                'confirmed' => $confirmedCount,
            ], 'Medication confirmations saved');
        } catch (QueryException $e) {
            Log::error('Service unavailable - DB connection issue in PatientMedicationController@confirmMedication: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVICE_UNAVAILABLE);
        } catch (\Exception $e) {
            Log::error('Generic exception in PatientMedicationController@confirmMedication: ' . $e->getMessage());
            return $this->errorResponse(ApiErrorCodes::SERVER_ERROR);
        }
    }
}
