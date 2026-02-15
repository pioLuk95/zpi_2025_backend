<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicationConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_medication_id',
        'confirmation_date',
    ];

    protected $casts = [
        'confirmation_date' => 'datetime',
    ];

    public function patientMedication()
    {
        return $this->belongsTo(PatientMedication::class);
    }
}
