<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientMedication;
use Illuminate\Support\Facades\Auth;
use App\Services\ErrorFormatter;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Tag(
 *     name="Medications",
 *     description="API Endpoints for managing patient medications"
 * )
 */
class PatientMedicationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/medications",
     *     summary="Get patient's medications for a specific day",
     *     description="Returns a list of medications assigned to the logged-in patient for a given date.",
     *     operationId="getMedicationsByDate",
     *     tags={"Medications"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date of the medications",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="YYYY-MM-DD")
     *     ),
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
     *                 @OA\Property(property="part_of_day", type="string", example="morning"),
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
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10001),
     *             @OA\Property(property="message", type="string", example="Unauthorized access"),
     *             example={
     *                 "error_code": 10001,
     *                 "message": "Unauthorized access"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10022),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 ),
     *                 example={
     *                     "date": {"The date must be a valid date.", "The date does not match the format Y-m-d."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function getMedicationsByDate(Request $request)
    {
        try {
           
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error_code' => 10001,
                    'message' => 'Unauthorized access'
                ], 401);
            }

         
            $validated = $request->validate([
                'date' => 'nullable|date|date_format:Y-m-d'
            ]);

            $date = $validated['date'] ?? Carbon::today()->toDateString();

            $medications = PatientMedication::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->get(['id as medication_id', 'name', 'dosage', 'part_of_day', 'is_taken']);

            return response()->json($medications);

        } catch (ValidationException $e) {
            return response()->json([
                'error_code' => 10022,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error_code' => 10500,
                'message' => 'Internal server error'
            ], 500);
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
     *             required={"medication_id"},
     *             @OA\Property(property="medication_id", type="integer", example=1),
     *             @OA\Property(property="is_taken", type="boolean", example=true),
     *             example={
     *                 "medication_id": 1,
     *                 "is_taken": true
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
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10001),
     *             @OA\Property(property="message", type="string", example="Unauthorized access"),
     *             example={
     *                 "error_code": 10001,
     *                 "message": "Unauthorized access"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Medication not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=1004),
     *             @OA\Property(property="message", type="string", example="Medication not found"),
     *             example={
     *                 "error_code": 1004,
     *                 "message": "Medication not found"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10022),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 ),
     *                 example={
     *                     "medication_id": {"The medication id field is required.", "The medication id must be an integer."},
     *                     "is_taken": {"The is taken field must be true or false."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function confirmMedication(Request $request)
    {
        try {
          
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error_code' => 10001,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $validated = $request->validate([
                'medication_id' => 'required|integer',
                'is_taken' => 'required|boolean'
            ]);

        
            $medication = PatientMedication::where('id', $validated['medication_id'])
                ->where('user_id', $user->id)
                ->first();

            if (!$medication) {
                return response()->json([
                    'error_code' => 10404,
                    'message' => 'Medication not found'
                ], 404);
            }

 
            $medication->is_taken = $validated['is_taken'];
            $medication->save();

            return response()->json([
                'success' => true,
                'message' => 'Medication status updated'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'error_code' => 10022,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error_code' => 10500,
                'message' => 'Internal server error'
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/medications/statistics",
     *     summary="Medication intake statistics",
     *     description="Returns the total number of medications and how many have been taken for a given date.",
     *     operationId="getMedicationStats",
     *     tags={"Medications"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date in format YYYY-MM-DD",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="2025-06-15")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication statistics",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="total", type="integer", example=5),
     *             @OA\Property(property="taken", type="integer", example=3),
     *             @OA\Property(property="percentage", type="number", format="float", example=60.0),
     *             example={
     *                 "total": 5,
     *                 "taken": 3,
     *                 "percentage": 60.0
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10001),
     *             @OA\Property(property="message", type="string", example="Unauthorized access"),
     *             example={
     *                 "error_code": 10001,
     *                 "message": "Unauthorized access"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error_code", type="integer", example=10022),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 ),
     *                 example={
     *                     "date": {"The date must be a valid date.", "The date does not match the format Y-m-d."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function getMedicationStats(Request $request)
    {
        try {
          
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error_code' => 10001,
                    'message' => 'Unauthorized access'
                ], 401);
            }

           
            $validated = $request->validate([
                'date' => 'nullable|date|date_format:Y-m-d'
            ]);

            $date = $validated['date'] ?? Carbon::today()->toDateString();

           
            $total = PatientMedication::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->count();

            $taken = PatientMedication::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->where('is_taken', true)
                ->count();

           
            $percentage = $total > 0 ? round(($taken / $total) * 100, 1) : 0;

            return response()->json([
                'total' => $total,
                'taken' => $taken,
                'percentage' => $percentage
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'error_code' => 10022,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error_code' => 10500,
                'message' => 'Internal server error'
            ], 500);
        }
    }
}