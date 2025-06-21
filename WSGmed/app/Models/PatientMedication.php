<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedication extends Model
{
    /** @use HasFactory<\Database\Factories\PatientMedicationFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medication_id',
        'dosage',
        'start_date',
        'end_date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }
}
