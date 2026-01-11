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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        *                 type="array",
        *                 @OA\Items(
        *                     type="object",
        *                     @OA\Property(property="name", type="string", example="Aspirin"),
        *                     @OA\Property(property="info", type="string", example="Pain reliever and fever reducer."),
        *                     @OA\Property(property="patient_medication_id", type="integer", example=10),
        *                     @OA\Property(property="dosage", type="number", format="float", example=100),
        *                     @OA\Property(property="unit", type="string", example="MG", enum={"MG","ML","TABLET"}),
        *                     @OA\Property(property="is_taken", type="boolean", example=false),
        *                     @OA\Property(property="med_taken", type="integer", example=1),
        *                     @OA\Property(property="med_all", type="integer", example=3)
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

            $rows = DB::table('patient_medications as pm')
                ->join('medications as m', 'pm.medication_id', '=', 'm.id')
                ->leftJoin('patient_medication_confirmations as pmc', function ($join) use ($today) {
                    $join->on('pmc.patient_medication_id', '=', 'pm.id')
                        ->where('pmc.planned_date', '=', $today)
                        ->whereNotNull('pmc.confirmation_date');
                })
                ->where('pm.patient_id', '=', $patientId)
                ->where('pm.start_date', '<=', $today)
                ->where(function ($query) use ($today) {
                    $query->whereNull('pm.end_date')
                        ->orWhere('pm.end_date', '>=', $today);
                })
                ->select([
                    'm.name as name',
                    'm.info as info',
                    'pm.id as patient_medication_id',
                    'pm.dosage as dosage',
                    'pm.unit as unit',
                    DB::raw('CASE WHEN pmc.id IS NULL THEN 0 ELSE 1 END as is_taken'),
                ])
                ->orderBy('pm.id')
                ->get();

            $medAll = $rows->count();
            $medTaken = $rows->filter(fn ($row) => (int) $row->is_taken === 1)->count();

            $medications = $rows->map(function ($row) use ($medTaken, $medAll) {
                return [
                    'name' => $row->name,
                    'info' => $row->info,
                    'patient_medication_id' => (int) $row->patient_medication_id,
                    'dosage' => (float) $row->dosage,
                    'unit' => $row->unit,
                    'is_taken' => (bool) $row->is_taken,
                    'med_taken' => $medTaken,
                    'med_all' => $medAll,
                ];
            });

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
        *     description="Saves medication confirmations for the given day by inserting (or updating) a confirmation record with planned_date and confirmation_date.",
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
        *                     required={"patient_medication_id","current_date","is_taken"},
        *                     @OA\Property(property="patient_medication_id", type="integer", example=10),
        *                     @OA\Property(property="current_date", type="string", format="date", example="2026-01-09"),
        *                     @OA\Property(property="is_taken", type="boolean", example=true)
        *                 )
        *             ),
        *             example={
        *                 "medications": {
        *                     {"patient_medication_id": 10, "current_date": "2026-01-09", "is_taken": true},
        *                     {"patient_medication_id": 11, "current_date": "2026-01-09", "is_taken": false}
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
     *             example={
     *                 "success": true,
        *                 "message": "Medication confirmations saved"
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
                'medications.*.current_date' => 'required|date_format:Y-m-d',
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
                if (!$item['is_taken']) {
                    continue;
                }

                $patientMedicationId = (int) $item['patient_medication_id'];
                $plannedDate = $item['current_date'];

                $updated = DB::table('patient_medication_confirmations')
                    ->where('patient_medication_id', '=', $patientMedicationId)
                    ->where('planned_date', '=', $plannedDate)
                    ->whereNull('confirmation_date')
                    ->update([
                        'confirmation_date' => $now,
                        'updated_at' => $now,
                    ]);

                if ($updated > 0) {
                    $confirmedCount++;
                    continue;
                }

                $alreadyConfirmed = DB::table('patient_medication_confirmations')
                    ->where('patient_medication_id', '=', $patientMedicationId)
                    ->where('planned_date', '=', $plannedDate)
                    ->whereNotNull('confirmation_date')
                    ->exists();

                if ($alreadyConfirmed) {
                    continue;
                }

                DB::table('patient_medication_confirmations')->insert([
                    'patient_medication_id' => $patientMedicationId,
                    'planned_date' => $plannedDate,
                    'confirmation_date' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $confirmedCount++;
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
