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

/**
 * @OA\Tag(
 *     name="Medical Visits",
 *     description="Medical appointment scheduling system. This section covers browsing available specialists, checking appointment availability, and scheduling new visits."
 * )
 */

/**
 * Medical Visit Management Controller
 * 
 * This controller handles the complete workflow of medical appointment scheduling.
 * Think of it as the digital receptionist of a medical facility - it manages
 * specialist availability, appointment booking, and patient visit history.
 */
class MedicalVisitController extends Controller
{
    /**
     * Database simulation for available medical specialists.
     * In production, this would be retrieved from a specialists database table.
     */
    private array $availableSpecialists = [
        [
            'id' => 1,
            'type' => 'doctor',
            'name' => 'Dr. Anna Johnson',
            'specialization' => 'Family Medicine',
            'email' => 'anna.johnson@hospital.com',
            'phone' => '+1-555-0101'
        ],
        [
            'id' => 2,
            'type' => 'doctor',
            'name' => 'Dr. Michael Smith',
            'specialization' => 'Cardiology',
            'email' => 'michael.smith@hospital.com',
            'phone' => '+1-555-0102'
        ],
        [
            'id' => 3,
            'type' => 'nurse',
            'name' => 'Nurse Sarah Williams',
            'specialization' => 'Home Care',
            'email' => 'sarah.williams@hospital.com',
            'phone' => '+1-555-0201'
        ],
        [
            'id' => 4,
            'type' => 'nurse',
            'name' => 'Nurse Jennifer Brown',
            'specialization' => 'Vaccination Services',
            'email' => 'jennifer.brown@hospital.com',
            'phone' => '+1-555-0202'
        ],
        [
            'id' => 5,
            'type' => 'physiotherapist',
            'name' => 'PT Robert Davis',
            'specialization' => 'Sports Rehabilitation',
            'email' => 'robert.davis@hospital.com',
            'phone' => '+1-555-0301'
        ],
        [
            'id' => 6,
            'type' => 'physiotherapist',
            'name' => 'PT Lisa Wilson',
            'specialization' => 'Neurological Rehabilitation',
            'email' => 'lisa.wilson@hospital.com',
            'phone' => '+1-555-0302'
        ]
    ];

    /**
     * Database simulation for scheduled visits.
     * In production, this would be a visits database table with proper relationships.
     */
    private array $visits = [];

    /**
     * JWT Token Authentication Method
     * 
     * This method acts as a security checkpoint for all medical data access.
     * It verifies that the incoming request contains a valid JWT token and
     * extracts the authenticated user's ID for authorization purposes.
     */
    private function authenticateRequest(Request $request): array
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return [
                'success' => false,
                'error' => 'Unauthorized',
                'code' => 10001
            ];
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            
            return [
                'success' => true,
                'user_id' => $decoded->sub,
                'token_issuer' => $decoded->iss ?? null
            ];

        } catch (ExpiredException $e) {
            return [
                'success' => false,
                'error' => 'Token expired',
                'code' => 10003
            ];
        } catch (SignatureInvalidException $e) {
            return [
                'success' => false,
                'error' => 'Invalid token',
                'code' => 10001
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unauthorized',
                'code' => 10001
            ];
        }
    }

    /**
     * @OA\Get(
     *     path="/api/medical-visits/specialists",
     *     summary="Retrieve Available Medical Specialists",
     *     description="Returns a categorized list of available healthcare providers including doctors, nurses, and physiotherapists. This endpoint is the starting point for appointment booking.",
     *     operationId="getSpecialists",
     *     tags={"Medical Visits"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved specialists list",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true,
     *                 
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Specialists list retrieved successfully",
     *                 description="Human-readable success message"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 description="Specialists grouped by type",
     *                 @OA\Property(
     *                     property="doctor",
     *                     type="array",
     *                     description="Available doctors",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="type", type="string", example="doctor"),
     *                         @OA\Property(property="name", type="string", example="Dr. Anna Johnson"),
     *                         @OA\Property(property="specialization", type="string", example="Family Medicine"),
     *                         @OA\Property(property="email", type="string", example="anna.johnson@hospital.com"),
     *                         @OA\Property(property="phone", type="string", example="+1-555-0101")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="nurse",
     *                     type="array",
     *                     description="Available nurses",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=3),
     *                         @OA\Property(property="type", type="string", example="nurse"),
     *                         @OA\Property(property="name", type="string", example="Nurse Sarah Williams"),
     *                         @OA\Property(property="specialization", type="string", example="Home Care"),
     *                         @OA\Property(property="email", type="string", example="sarah.williams@hospital.com"),
     *                         @OA\Property(property="phone", type="string", example="+1-555-0201")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="physiotherapist",
     *                     type="array",
     *                     description="Available physiotherapists",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=5),
     *                         @OA\Property(property="type", type="string", example="physiotherapist"),
     *                         @OA\Property(property="name", type="string", example="PT Robert Davis"),
     *                         @OA\Property(property="specialization", type="string", example="Sports Rehabilitation"),
     *                         @OA\Property(property="email", type="string", example="robert.davis@hospital.com"),
     *                         @OA\Property(property="phone", type="string", example="+1-555-0301")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Authentication required",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unable to retrieve specialists"),
     *             @OA\Property(property="code", type="integer", example=10100)
     *         )
     *     )
     * )
     */
    public function getSpecialists(Request $request): JsonResponse
    {

        $authResult = $this->authenticateRequest($request);
        if (!$authResult['success']) {
            return response()->json([
                'error' => $authResult['error'],
                'code' => $authResult['code']
            ], 401);
        }

        try {

            $groupedSpecialists = [
                'doctor' => array_filter($this->availableSpecialists, fn($s) => $s['type'] === 'doctor'),
                'nurse' => array_filter($this->availableSpecialists, fn($s) => $s['type'] === 'nurse'),
                'physiotherapist' => array_filter($this->availableSpecialists, fn($s) => $s['type'] === 'physiotherapist')
            ];


            foreach ($groupedSpecialists as $type => $specialists) {
                $groupedSpecialists[$type] = array_values($specialists);
            }

            return response()->json([
                'success' => true,
                'message' => 'Specialists list retrieved successfully',
                'data' => $groupedSpecialists
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to retrieve specialists',
                'code' => 10100
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/medical-visits/available-slots",
     *     summary="Check Available Appointment Time Slots",
     *     description="Returns available time slots for a specific specialist on a given date. This is used in the second step of appointment booking.",
     *     operationId="getAvailableSlots",
     *     tags={"Medical Visits"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="specialist_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Available time slots retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Available slots retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="specialist",
     *                     type="object",
     *                     description="Details of the selected specialist",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Dr. Anna Johnson"),
     *                     @OA\Property(property="specialization", type="string", example="Family Medicine")
     *                 ),
     *                 @OA\Property(property="date", type="string", format="date", example="2025-06-15"),
     *                 @OA\Property(
     *                     property="available_slots",
     *                     type="array",
     *                     description="List of available appointment times",
     *                     @OA\Items(type="string", example="09:00")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "specialist_id": {"The specialist id field is required."},
     *                     "date": {"The date must be a date after or equal to today."}
     *                 }
     *             ),
     *             @OA\Property(property="code", type="integer", example=10022)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialist not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Specialist not found"),
     *             @OA\Property(property="code", type="integer", example=10004)
     *         )
     *     )
     * )
     */
    public function getAvailableSlots(Request $request): JsonResponse
    {

        $authResult = $this->authenticateRequest($request);
        if (!$authResult['success']) {
            return response()->json([
                'error' => $authResult['error'],
                'code' => $authResult['code']
            ], 401);
        }

        try {
  
            $validator = Validator::make($request->all(), [
                'specialist_id' => 'required|integer',
                'date' => 'required|date|after_or_equal:today'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors(),
                    'code' => 10022
                ], 422);
            }

            $specialistId = $request->query('specialist_id');
            $date = $request->query('date');


            $specialist = collect($this->availableSpecialists)
                ->firstWhere('id', (int)$specialistId);

            if (!$specialist) {
                return response()->json([
                    'error' => 'Specialist not found',
                    'code' => 10004
                ], 404);
            }

            $allTimeSlots = [
                '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
                '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
                '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'
            ];


            $bookedSlots = collect($this->visits)
                ->where('specialist_id', (int)$specialistId)
                ->where('date', $date)
                ->pluck('time')
                ->toArray();


            $availableSlots = array_values(array_diff($allTimeSlots, $bookedSlots));

            return response()->json([
                'success' => true,
                'message' => 'Available slots retrieved successfully',
                'data' => [
                    'specialist' => [
                        'id' => $specialist['id'],
                        'name' => $specialist['name'],
                        'specialization' => $specialist['specialization']
                    ],
                    'date' => $date,
                    'available_slots' => $availableSlots
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to retrieve available slots',
                'code' => 10100
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/medical-visits/schedule",
     *     summary="Schedule New Medical Appointment",
     *     description="Creates a new medical appointment booking. This is the main endpoint for completing the appointment scheduling process.",
     *     operationId="scheduleVisit",
     *     tags={"Medical Visits"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"specialist_type", "specialist_id", "date", "time", "reason", "patient_name", "patient_phone", "patient_email"},
     *             @OA\Property(property="specialist_type", type="string",example="doctor"),
     *             @OA\Property(property="specialist_id", type="integer", example=1,),
     *             @OA\Property(property="date", type="string", format="date", example="2025-06-15"),
     *             @OA\Property(property="time", type="string", example="10:30"),
     *             @OA\Property(property="reason", type="string", example="General checkup and consultation about recent symptoms"),
     *             @OA\Property(property="patient_name", type="string", example="John Doe"),
     *             @OA\Property(property="patient_phone", type="string", example="+1-555-0199"),
     *             @OA\Property(property="patient_email", type="string", format="email", example="john.doe@email.com"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment scheduled successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Medical visit scheduled successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="visit_id", type="string", example="visit_1622548800_1234"),
     *                 @OA\Property(property="specialist_name", type="string", example="Dr. Anna Johnson"),
     *                 @OA\Property(property="specialization", type="string", example="Family Medicine"),
     *                 @OA\Property(property="date", type="string", format="date", example="2025-06-15"),
     *                 @OA\Property(property="time", type="string", example="10:30"),
     *                 @OA\Property(property="reason", type="string", example="General checkup and consultation about recent symptoms"),
     *                 @OA\Property(property="status", type="string", example="scheduled"),
     *                 @OA\Property(property="confirmation_number", type="string", example="CONF-2025-001")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Cannot schedule appointments in the past"),
     *             @OA\Property(property="code", type="integer", example=10000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthorized"),
     *             @OA\Property(property="code", type="integer", example=10001)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Specialist not found or type mismatch"),
     *             @OA\Property(property="code", type="integer", example=10004)
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Conflict - Time slot already booked",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="The selected time slot is already booked"),
     *             @OA\Property(property="code", type="integer", example=10009)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "reason": {"The reason must be at least 10 characters."},
     *                     "patient_email": {"The patient email must be a valid email address."}
     *                 }
     *             ),
     *             @OA\Property(property="code", type="integer", example=10022)
     *         )
     *     )
     * )
     */
    public function scheduleVisit(Request $request): JsonResponse
    {
        $authResult = $this->authenticateRequest($request);
        if (!$authResult['success']) {
            return response()->json([
                'error' => $authResult['error'],
                'code' => $authResult['code']
            ], 401);
        }

        $authenticatedUserId = $authResult['user_id'];

        try {
            $validator = Validator::make($request->all(), [
                'specialist_type' => 'required|in:doctor,nurse,physiotherapist',
                'specialist_id' => 'required|integer',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required|regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/',
                'reason' => 'required|string|min:10|max:500',
                'patient_name' => 'required|string|max:100',
                'patient_phone' => 'required|string|regex:/^[+]?[0-9\s\-\(\)]+$/',
                'patient_email' => 'required|email'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors(),
                    'code' => 10022
                ], 422);
            }

            $validatedData = $validator->validated();

            $specialist = collect($this->availableSpecialists)
                ->where('id', (int)$validatedData['specialist_id'])
                ->where('type', $validatedData['specialist_type'])
                ->first();

            if (!$specialist) {
                return response()->json([
                    'error' => 'Specialist not found or type mismatch',
                    'code' => 10004
                ], 404);
            }

            $isSlotTaken = collect($this->visits)
                ->where('specialist_id', (int)$validatedData['specialist_id'])
                ->where('date', $validatedData['date'])
                ->where('time', $validatedData['time'])
                ->isNotEmpty();

            if ($isSlotTaken) {
                return response()->json([
                    'error' => 'The selected time slot is already booked',
                    'code' => 10009
                ], 409);
            }
            $appointmentDateTime = Carbon::parse($validatedData['date'] . ' ' . $validatedData['time']);
            if ($appointmentDateTime->isPast()) {
                return response()->json([
                    'error' => 'Cannot schedule appointments in the past',
                    'code' => 10000
                ], 400);
            }

            $visitId = 'visit_' . time() . '_' . rand(1000, 9999);
            $confirmationNumber = 'CONF-' . date('Y') . '-' . str_pad(count($this->visits) + 1, 3, '0', STR_PAD_LEFT);

            $newVisit = [
                'id' => $visitId,
                'specialist_id' => (int)$validatedData['specialist_id'],
                'specialist_name' => $specialist['name'],
                'specialist_type' => $validatedData['specialist_type'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'reason' => trim($validatedData['reason']),
                'patient_id' => $authenticatedUserId,
                'patient_name' => $validatedData['patient_name'],
                'patient_phone' => $validatedData['patient_phone'],
                'patient_email' => $validatedData['patient_email'],
                'status' => 'scheduled',
                'confirmation_number' => $confirmationNumber,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ];

            $this->visits[] = $newVisit;

            return response()->json([
                'success' => true,
                'message' => 'Medical visit scheduled successfully',
                'data' => [
                    'visit_id' => $newVisit['id'],
                    'specialist_name' => $specialist['name'],
                    'specialization' => $specialist['specialization'],
                    'date' => $validatedData['date'],
                    'time' => $validatedData['time'],
                    'reason' => $validatedData['reason'],
                    'status' => $newVisit['status'],
                    'confirmation_number' => $confirmationNumber
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to schedule medical visit',
                'code' => 10100
            ], 500);
        }
    }
}