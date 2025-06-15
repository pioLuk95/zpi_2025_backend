<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class MedicalVisitController extends Controller
{
    private array $availableSpecialists = []; // pozostało bez zmian
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
     *             required={"specialist_type", "specialist_id", "date", "time", "reason"},
     *             @OA\Property(property="specialist_type", type="string", example="doctor"),
     *             @OA\Property(property="specialist_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2025-06-15"),
     *             @OA\Property(property="time", type="string", example="14:30"),
     *             @OA\Property(property="reason", type="string", example="Consultation about blood pressure")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment scheduled successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Medical visit scheduled successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="visit_id", type="string", example="visit_1622548800_1234"),
     *                 @OA\Property(property="specialist_name", type="string", example="Dr. Anna Johnson"),
     *                 @OA\Property(property="specialization", type="string", example="Family Medicine"),
     *                 @OA\Property(property="date", type="string", example="2025-06-15"),
     *                 @OA\Property(property="time", type="string", example="10:30"),
     *                 @OA\Property(property="reason", type="string", example="General checkup")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object"),
     *             @OA\Property(property="code", type="integer", example=10022)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialist not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Specialist not found"),
     *             @OA\Property(property="code", type="integer", example=10004)
     *         )
     *     )
     * )
     */
    public function scheduleVisit(Request $request): JsonResponse
    {
        // Logika $this->authenticateRequest($request) jest już obsłużona
        // przez middleware 'auth.jwt' zdefiniowane w routes/api.php.
        // Można uzyskać dostęp do użytkownika przez Auth::user() lub $request->user().
        $validator = Validator::make($request->all(), [
            'specialist_type' => 'required|in:doctor,nurse,physiotherapist',
            'specialist_id' => 'required|integer',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'reason' => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
                'code' => 10022
            ], 422);
        }

        $data = $validator->validated();
        $specialist = collect($this->availableSpecialists)
            ->first(fn($s) => $s['id'] === $data['specialist_id'] && $s['type'] === $data['specialist_type']);

        if (!$specialist) {
            return response()->json([
                'error' => 'Specialist not found',
                'code' => 10004
            ], 404);
        }

        $visitId = 'visit_' . time() . '_' . rand(1000, 9999);
        $this->visits[] = array_merge($data, ['visit_id' => $visitId]);

        return response()->json([
            'success' => true,
            'message' => 'Medical visit scheduled successfully',
            'data' => [
                'visit_id' => $visitId,
                'specialist_name' => $specialist['name'],
                'specialization' => $specialist['specialization'],
                'date' => $data['date'],
                'time' => $data['time'],
                'reason' => $data['reason']
            ]
        ], 201);
    }
}
