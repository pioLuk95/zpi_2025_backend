<?php

use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});

Auth::routes();
// revert
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('medications', App\Http\Controllers\MedicationController::class);
Route::resource('locations', App\Http\Controllers\LocationController::class);
Route::resource('emergency_calls', App\Http\Controllers\EmergencyCallsController::class);

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/2fa/setup', [TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

Route::get('/patients/{patient}/medical_records/create', [App\Http\Controllers\MedicalRecordController::class, 'create'])->name('medical-records.create');
Route::post('medical-records', [App\Http\Controllers\MedicalRecordController::class, 'store'])->name('medical-records.store');
Route::delete('medical_records/{medicalRecord}', [App\Http\Controllers\MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
Route::get('/patients/{patient}/show_emergency_calls', [App\Http\Controllers\EmergencyCallsController::class, 'showEmergencies'])->name('patient-emergencies.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/update', [RoleController::class, 'update'])->name('roles.update');
});
