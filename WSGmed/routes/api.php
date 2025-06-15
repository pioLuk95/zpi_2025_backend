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
use App\Http\Controllers\Api\MedicalVisitController;

Route::post('login', [AuthTokenController::class, 'login']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', [AuthTokenController::class, 'logout']);
    Route::post('refresh', [AuthTokenController::class, 'refresh']);
    Route::post('password/email', [AuthTokenController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [AuthTokenController::class, 'resetPassword']);
    
    Route::apiResource('emergency-calls', EmergencyCallsController::class)->only(['store']);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('medical-records', MedicalRecordController::class)->only(['store']);
    Route::apiResource('medications', MedicationController::class);
    Route::apiResource('patients', PatientController::class);

    Route::post('medical-visits/schedule', [MedicalVisitController::class, 'scheduleVisit']);
    
    
    Route::get('patient-medications', [PatientMedicationController::class, 'getMedicationsByDate']); 
    Route::post('patient-medications/confirm', [PatientMedicationController::class, 'confirmMedication']); 
    
    Route::apiResource('recomendations', RecomendationController::class)->only(['index', 'show']);
    Route::apiResource('staff', StaffController::class);
    Route::apiResource('staff-patients', StaffPatientController::class);
});