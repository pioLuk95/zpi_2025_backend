<?php

use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientMedicationController;
use App\Http\Controllers\SwaggerController;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Staff routes - Admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('staff', App\Http\Controllers\StaffController::class);
    Route::get('/patients_medications/statistics', [PatientMedicationController::class, 'statistics'])->name('patients_medications.statistics');
    Route::get('/roles', [App\Http\Controllers\UserRoleController::class, 'index'])->name('roles.index');
    Route::patch('/roles/{user}', [App\Http\Controllers\UserRoleController::class, 'update'])->name('roles.update');
});

Route::middleware('auth')->group(function () {

// Basic CRUD operations
Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('medications', App\Http\Controllers\MedicationController::class);
Route::resource('emergency_calls', App\Http\Controllers\EmergencyCallsController::class);

// Profile
Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// 2FA
Route::post('/profile/disable-2fa', [ProfileController::class, 'disable2FA'])->name('profile.disable-2fa');
Route::get('/2fa/setup', [TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
Route::post('/2fa/completeSetup', [TwoFactorController::class, 'completeSetup'])->name('2fa.completeSetup');
Route::get('/2fa/prompt', [TwoFactorController::class, 'showPrompt'])->name('2fa.prompt');
Route::post('/2fa/verifyOtp', [TwoFactorController::class, 'verifyOtp'])->name('2fa.verifyOtp');

// Patient Medications
Route::get('/patients/{patient}/medications/create', [App\Http\Controllers\PatientMedicationController::class, 'create'])->name('patient-medications.create');
Route::post('/patients/{patient}/medications', [App\Http\Controllers\PatientMedicationController::class, 'store'])->name('patient-medications.store');
Route::delete('/patients/{patient}/medications/{patientMedication}', [App\Http\Controllers\PatientMedicationController::class, 'destroy'])->name('patient-medications.destroy');
Route::post('/patient-medications/{patientMedication}/confirm', [App\Http\Controllers\PatientMedicationController::class, 'confirm'])->name('patient-medications.confirm');

// Others
Route::get('/patients/{patient}/medical_records/create', [App\Http\Controllers\MedicalRecordController::class, 'create'])->name('medical-records.create');
Route::post('medical-records', [App\Http\Controllers\MedicalRecordController::class, 'store'])->name('medical-records.store');
Route::delete('medical_records/{medicalRecord}', [App\Http\Controllers\MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
Route::get('/patients/{patient}/show_emergency_calls', [App\Http\Controllers\EmergencyCallsController::class, 'showEmergencies'])->name('patient-emergencies.show');
Route::delete('staff_patients/{staff}/{patient}', [App\Http\Controllers\StaffPatientController::class, 'unassign'])->name('staff_patients.unassign');
Route::get('patients/{patient}/assign', [App\Http\Controllers\StaffPatientController::class, 'renderAssign'])->name('staff_patients.renderAssign');
Route::post('patients/{patient}/assign', [App\Http\Controllers\StaffPatientController::class, 'assign'])->name('staff_patients.assign');

// Recommendations
Route::get('/patients/{patient}/recommendations/create', [App\Http\Controllers\RecomendationController::class, 'create'])->name('recommendations.create');
Route::post('/patients/{patient}/recommendations', [App\Http\Controllers\RecomendationController::class, 'store'])->name('recommendations.store');
Route::delete('/recommendations/{recommendation}', [App\Http\Controllers\RecomendationController::class, 'destroy'])->name('recommendations.destroy');

Route::get('/patients_medications', [PatientMedicationController::class, 'landing'])->name('patients_medications.landing');
Route::post('/patients_medications/{patient}', [App\Http\Controllers\PatientMedicationController::class, 'store'])->name('patients_medications.store');
Route::put('/patients_medications/{patient}/{patientMedication}', [App\Http\Controllers\PatientMedicationController::class, 'update'])->name('patients_medications.update');
Route::delete('/patients_medications/{patient}/{patientMedication}', [App\Http\Controllers\PatientMedicationController::class, 'destroy'])->name('patients_medications.destroy');

Route::get('/discharge/{patient}/create', [App\Http\Controllers\DischargeLetterController::class, 'create'])->name('discharge.create');
Route::post('/discharge', [App\Http\Controllers\DischargeLetterController::class, 'store'])->name('discharge.store');
Route::get('/discharge/{dischargeLetter}/edit', [App\Http\Controllers\DischargeLetterController::class, 'edit'])->name('discharge.edit');
Route::put('/discharge/{dischargeLetter}', [App\Http\Controllers\DischargeLetterController::class, 'update'])->name('discharge.update');
});
