<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmergencyCallsController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PatientMedicationController;
use App\Http\Controllers\Api\RecomendationController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\StaffPatientController;
use App\Http\Controllers\Api\AuthTokenController;


Route::post('register', [AuthTokenController::class, 'register']);
Route::post('login', [AuthTokenController::class, 'login']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', [AuthTokenController::class, 'logout']);
    Route::post('refresh', [AuthTokenController::class, 'refresh']);
    Route::post('confirm-password', [AuthTokenController::class, 'confirmPassword']);
    Route::post('password/email', [AuthTokenController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [AuthTokenController::class, 'resetPassword']);
    Route::post('email/verify', [AuthTokenController::class, 'verifyEmail']);
    
    Route::apiResource('emergency-calls', EmergencyCallsController::class);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('medical-records', MedicalRecordController::class);
    Route::apiResource('medications', MedicationController::class);
    Route::apiResource('patients', PatientController::class);

    Route::get('medical-visits/specialists', [MedicalVisitController::class, 'getSpecialists']);
    Route::get('medical-visits/available-slots', [MedicalVisitController::class, 'getAvailableSlots']);
    Route::post('medical-visits/schedule', [MedicalVisitController::class, 'scheduleVisit']);
    Route::get('medical-visits/my-visits', [MedicalVisitController::class, 'getMyVisits']);
    
  
    Route::get('patient-medications/patient/{patient_id}', [PatientMedicationController::class, 'getByPatient']);
    Route::post('patient-medications/confirm', [PatientMedicationController::class, 'confirm']);
    Route::get('patient-medications/active', [PatientMedicationController::class, 'getActiveMedications']);
    
    
    Route::apiResource('patient-medications', PatientMedicationController::class)->only(['index']);
    
    Route::apiResource('recomendations', RecomendationController::class);
    Route::apiResource('staff', StaffController::class);
    Route::apiResource('staff-patients', StaffPatientController::class);
});