<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('medications', App\Http\Controllers\MedicationController::class);
Route::resource('locations', App\Http\Controllers\LocationController::class);
Route::resource('emergency_calls', App\Http\Controllers\EmergencyCallsController::class);

Route::get('/patients/{patient}/medical_records/create', [App\Http\Controllers\MedicalRecordController::class, 'create'])->name('medical-records.create');
Route::post('medical-records', [App\Http\Controllers\MedicalRecordController::class, 'store'])->name('medical-records.store');
Route::delete('medical_records/{medicalRecord}', [App\Http\Controllers\MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
Route::get('/patients/{patient}/show_emergency_calls', [App\Http\Controllers\EmergencyCallsController::class, 'showEmergencies'])->name('patient-emergencies.show');
