<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientMedication;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * @group Patient Medication Management
 *
 * APIs for managing patient medications
 */
class PatientMedicationController extends Controller
{
    /**
     * List all patient medications
     * 
     * Returns a collection of all patient medications in the system.
     *
     * @queryParam page integer Page number for pagination. Example: 1
     * @queryParam per_page integer Number of items per page. Example: 15
     * 
     * @response 200 {
     *  "data": [
     *      {
     *          "id": 1,
     *          "patient_id": 1,
     *          "medication_id": 2,
     *          "dosage": "1 tablet",
     *          "frequency": "Twice a day",
     *          "start_date": "2025-05-01",
     *          "end_date": "2025-05-30",
     *          "created_at": "2025-05-05T12:00:00Z",
     *          "updated_at": "2025-05-05T12:00:00Z"
     *      }
     *  ],
     *  "links": {
     *      "first": "http://example.com/api/patient-medications?page=1",
     *      "last": "http://example.com/api/patient-medications?page=1",
     *      "prev": null,
     *      "next": null
     *  },
     *  "meta": {
     *      "current_page": 1,
     *      "from": 1,
     *      "last_page": 1,
     *      "path": "http://example.com/api/patient-medications",
     *      "per_page": 15,
     *      "to": 1,
     *      "total": 1
     *  }
     * }
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $patientMedications = PatientMedication::paginate();
        return response()->json($patientMedications, 200);
    }

    /**
     * Create a new patient medication
     * 
     * Store a newly created patient medication in the database.
     *
     * @bodyParam patient_id integer required The ID of the patient. Example: 1
     * @bodyParam medication_id integer required The ID of the medication. Example: 2
     * @bodyParam dosage string required The dosage information. Example: 1 tablet
     * @bodyParam frequency string required How often the medication should be taken. Example: Twice a day
     * @bodyParam start_date date The date when medication should start. Example: 2025-05-01
     * @bodyParam end_date date The date when medication should end. Example: 2025-05-30
     * @bodyParam notes string Additional notes about the medication. Example: Take with food
     * 
     * @response 201 {
     *  "data": {
     *      "id": 1,
     *      "patient_id": 1,
     *      "medication_id": 2,
     *      "dosage": "1 tablet",
     *      "frequency": "Twice a day",
     *      "start_date": "2025-05-01",
     *      "end_date": "2025-05-30",
     *      "notes": "Take with food",
     *      "created_at": "2025-05-05T12:00:00Z",
     *      "updated_at": "2025-05-05T12:00:00Z"
     *  }
     * }
     * 
     * @response 422 {
     *  "message": "The given data was invalid.",
     *  "errors": {
     *      "patient_id": [
     *          "The patient id field is required."
     *      ]
     *  }
     * }
     * 
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|integer|exists:patients,id',
            'medication_id' => 'required|integer|exists:medications,id',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'notes' => 'sometimes|string|max:1000',
        ]);

        $patientMedication = PatientMedication::create($validatedData);

        return response()->json(['data' => $patientMedication], 201);
    }

    /**
     * Retrieve a specific patient medication
     * 
     * Display detailed information for a specific patient medication.
     *
     * @urlParam id required The ID of the patient medication. Example: 1
     * 
     * @response 200 {
     *  "data": {
     *      "id": 1,
     *      "patient_id": 1,
     *      "medication_id": 2,
     *      "dosage": "1 tablet",
     *      "frequency": "Twice a day",
     *      "start_date": "2025-05-01",
     *      "end_date": "2025-05-30",
     *      "notes": "Take with food",
     *      "created_at": "2025-05-05T12:00:00Z",
     *      "updated_at": "2025-05-05T12:00:00Z",
     *      "patient": {
     *          "id": 1,
     *          "name": "John Doe"
     *      },
     *      "medication": {
     *          "id": 2,
     *          "name": "Aspirin",
     *          "description": "Pain reliever"
     *      }
     *  }
     * }
     * 
     * @response 404 {
     *  "message": "Patient medication not found"
     * }
     * 
     * @param PatientMedication $patientMedication
     * @return JsonResponse
     */
    public function show(PatientMedication $patientMedication): JsonResponse
    {
        $patientMedication->load(['patient:id,name', 'medication:id,name,description']);
        return response()->json(['data' => $patientMedication], 200);
    }

    /**
     * Update a patient medication
     * 
     * Update the specified patient medication in the database.
     *
     * @urlParam id required The ID of the patient medication. Example: 1
     * 
     * @bodyParam patient_id integer The ID of the patient. Example: 1
     * @bodyParam medication_id integer The ID of the medication. Example: 2
     * @bodyParam dosage string The dosage information. Example: 2 tablets
     * @bodyParam frequency string How often the medication should be taken. Example: Three times a day
     * @bodyParam start_date date The date when medication should start. Example: 2025-05-01
     * @bodyParam end_date date The date when medication should end. Example: 2025-05-30
     * @bodyParam notes string Additional notes about the medication. Example: Take after meals
     * 
     * @response 200 {
     *  "data": {
     *      "id": 1,
     *      "patient_id": 1,
     *      "medication_id": 2,
     *      "dosage": "2 tablets",
     *      "frequency": "Three times a day",
     *      "start_date": "2025-05-01",
     *      "end_date": "2025-05-30",
     *      "notes": "Take after meals",
     *      "created_at": "2025-05-05T12:00:00Z",
     *      "updated_at": "2025-05-10T14:30:00Z"
     *  }
     * }
     * 
     * @response 404 {
     *  "message": "Patient medication not found"
     * }
     * 
     * @response 422 {
     *  "message": "The given data was invalid.",
     *  "errors": {
     *      "end_date": [
     *          "The end date must be a date after or equal to start date."
     *      ]
     *  }
     * }
     * 
     * @param Request $request
     * @param PatientMedication $patientMedication
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, PatientMedication $patientMedication): JsonResponse
    {
        $validatedData = $request->validate([
            'patient_id' => 'sometimes|integer|exists:patients,id',
            'medication_id' => 'sometimes|integer|exists:medications,id',
            'dosage' => 'sometimes|string|max:255',
            'frequency' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'notes' => 'sometimes|string|max:1000',
        ]);

        $patientMedication->update($validatedData);

        return response()->json(['data' => $patientMedication], 200);
    }

    /**
     * Delete a patient medication
     * 
     * Remove the specified patient medication from the database.
     *
     * @urlParam id required The ID of the patient medication. Example: 1
     * 
     * @response 204 {}
     * 
     * @response 404 {
     *  "message": "Patient medication not found"
     * }
     * 
     * @param PatientMedication $patientMedication
     * @return JsonResponse
     */
    public function destroy(PatientMedication $patientMedication): JsonResponse
    {
        $patientMedication->delete();
        return response()->json(null, 204);
    }

    /**
     * Get patient medications by patient
     * 
     * Retrieve all medications for a specific patient.
     *
     * @urlParam patient_id required The ID of the patient. Example: 1
     * 
     * @response 200 {
     *  "data": [
     *      {
     *          "id": 1,
     *          "patient_id": 1,
     *          "medication_id": 2,
     *          "dosage": "1 tablet",
     *          "frequency": "Twice a day",
     *          "start_date": "2025-05-01",
     *          "end_date": "2025-05-30",
     *          "notes": "Take with food",
     *          "created_at": "2025-05-05T12:00:00Z",
     *          "updated_at": "2025-05-05T12:00:00Z",
     *          "medication": {
     *              "id": 2,
     *              "name": "Aspirin",
     *              "description": "Pain reliever"
     *          }
     *      }
     *  ]
     * }
     * 
     * @param int $patientId
     * @return JsonResponse
     */
    public function getByPatient(int $patientId): JsonResponse
    {
        $medications = PatientMedication::where('patient_id', $patientId)
            ->with('medication:id,name,description')
            ->get();
            
        return response()->json(['data' => $medications], 200);
    }

    /**
     * Get active medications
     * 
     * Retrieve all active medications (within start and end dates).
     *
     * @queryParam patient_id integer Filter by patient ID. Example: 1
     * 
     * @response 200 {
     *  "data": [
     *      {
     *          "id": 1,
     *          "patient_id": 1,
     *          "medication_id": 2,
     *          "dosage": "1 tablet",
     *          "frequency": "Twice a day",
     *          "start_date": "2025-05-01",
     *          "end_date": "2025-05-30",
     *          "notes": "Take with food",
     *          "created_at": "2025-05-05T12:00:00Z",
     *          "updated_at": "2025-05-05T12:00:00Z"
     *      }
     *  ]
     * }
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getActiveMedications(Request $request): JsonResponse
    {
        $query = PatientMedication::query()
            ->where(function($q) {
                $today = now()->format('Y-m-d');
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', $today);
            })
            ->where(function($q) {
                $today = now()->format('Y-m-d');
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            });
            
        if ($request->has('patient_id')) {
            $query->where('patient_id', $request->input('patient_id'));
        }
        
        $activeMedications = $query->get();
        
        return response()->json(['data' => $activeMedications], 200);
    }
}