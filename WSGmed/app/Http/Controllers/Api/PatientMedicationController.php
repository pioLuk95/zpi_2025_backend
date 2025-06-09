<?php



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientMedication;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="PatientMedications",
 *     description="API Endpoints for managing patient medications"
 * )
 */
class PatientMedicationController extends Controller
{
    /**
     * Show medications to confirm
     * 
     * @OA\Get(
     *     path="/api/patient-medications",
     *     tags={"PatientMedications"},
     *     summary="Show medications to confirm",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $today = now()->format('Y-m-d');
        $medications = PatientMedication::where('patient_id', auth()->id())
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $today);
            })
            ->where('confirmed', false)
            ->get();

        return response()->json(['data' => $medications], 200);
    }

    /**
     * Confirm medication intake
     * 
     * @OA\Post(
     *     path="/api/patient-medications/confirm",
     *     tags={"PatientMedications"},
     *     summary="Confirm medication intake",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"medication_ids"},
     *             @OA\Property(property="medication_ids", type="array", @OA\Items(type="integer"), example={1, 2, 3})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medication intake confirmed successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Medication intake confirmed successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid medication provided",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Invalid medication IDs provided.")
     *         )
     *     )
     * )
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function confirm(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'medication_ids' => 'required|array',
            'medication_ids.*' => 'integer|exists:patient_medications,id',
        ]);

        PatientMedication::whereIn('id', $validatedData['medication_ids'])
            ->where('patient_id', auth()->id())
            ->update(['confirmed' => true]);

        return response()->json(['message' => 'Medication intake confirmed successfully.'], 200);
    }
}