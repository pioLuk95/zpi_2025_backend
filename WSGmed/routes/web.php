<?php

use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Basic CRUD operations
Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('medications', App\Http\Controllers\MedicationController::class);
Route::resource('locations', App\Http\Controllers\LocationController::class);
Route::resource('emergency_calls', App\Http\Controllers\EmergencyCallsController::class);
Route::resource('staff', App\Http\Controllers\StaffController::class);

// Profile
Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// 2FA
Route::post('/profile/disable-2fa', [ProfileController::class, 'disable2FA'])->name('profile.disable-2fa');
Route::get('/2fa/setup', [TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
Route::post('/2fa/completeSetup', [TwoFactorController::class, 'completeSetup'])->name('2fa.completeSetup');

// Others
Route::get('/patients/{patient}/medical_records/create', [App\Http\Controllers\MedicalRecordController::class, 'create'])->name('medical-records.create');
Route::post('medical-records', [App\Http\Controllers\MedicalRecordController::class, 'store'])->name('medical-records.store');
Route::delete('medical_records/{medicalRecord}', [App\Http\Controllers\MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
Route::get('/patients/{patient}/show_emergency_calls', [App\Http\Controllers\EmergencyCallsController::class, 'showEmergencies'])->name('patient-emergencies.show');
Route::delete('staff_patients/{staff}/{patient}', [App\Http\Controllers\StaffPatientController::class, 'unassign'])->name('staff_patients.unassign');
Route::get('patients/{patient}/assign', [App\Http\Controllers\StaffPatientController::class, 'renderAssign'])->name('staff_patients.renderAssign');
Route::post('patients/{patient}/assign', [App\Http\Controllers\StaffPatientController::class, 'assign'])->name('staff_patients.assign');
