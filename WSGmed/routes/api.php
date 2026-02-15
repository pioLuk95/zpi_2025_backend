<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmergencyCallsController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\PatientMedicationController;
use App\Http\Controllers\Api\RecomendationController;
use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Controllers\Api\MedicalVisitController;

Route::post('login', [AuthTokenController::class, 'login']);
Route::post('refresh', [AuthTokenController::class, 'refresh']);
Route::post('password/email', [AuthTokenController::class, 'sendResetLinkEmail']);

Route::middleware('auth:api')->group(function () {
Route::post('logout', [AuthTokenController::class, 'logout']);
Route::post('emergency-calls', [EmergencyCallsController::class, 'store'])->middleware('throttle:5,1');
Route::get('medications', [PatientMedicationController::class, 'getMedicationsByDate']); 
Route::post('medications/confirm', [PatientMedicationController::class, 'confirmMedication']);
Route::post('medical-visits/schedule', [MedicalVisitController::class, 'scheduleVisit']);

Route::apiResource('recommendations', RecomendationController::class)->only(['index']);
Route::post('medical-records', [MedicalRecordController::class, "save"])->middleware('throttle:5,1'); 
});