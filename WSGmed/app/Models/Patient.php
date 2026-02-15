<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;



class Patient extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;
    use Notifiable;

    const STATUS_NEW = 'Nowy';
    const STATUS_UNDER_TREATMENT = 'W trakcie leczenia';
    const STATUS_DISCHARGED = 'Wypisany';
    const STATUS_DIED = 'Zmarły';

    protected $fillable = [
        'name',
        's_name',
        'email',
        'date_of_birth',
        'password',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function records()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function emergencyCalls()
    {
        return $this->hasMany(EmergencyCalls::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, "staff_patients", "patient_id", "staff_id");
    }

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'patient_medications', 'patient_id', 'medication_id')
                    ->withPivot('dosage', 'frequency', 'start_date', 'end_date')
                    ->withTimestamps()
                    ->using(PatientMedication::class);
    }

    public function patientMedications()
    {
        return $this->hasMany(PatientMedication::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recomendation::class);
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function discharge()
    {
        return $this->hasOne(DischargeLetter::class);
    }
}
