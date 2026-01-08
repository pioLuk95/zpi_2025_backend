<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicationConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_medication_id',
        'planned_date',
        'confirmation_date',
    ];

    protected $casts = [
        'planned_date'       => 'date',
        'confirmation_date' => 'datetime',
    ];

    public function patientMedication()
    {
        return $this->belongsTo(PatientMedication::class);
    }
}
