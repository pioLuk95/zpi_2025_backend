<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        's_name',
        'email',
        'date_of_birth',
        'location_id',
        'password',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

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
}
