<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PatientMedication extends Pivot
{
    /** @use HasFactory<\Database\Factories\PatientMedicationFactory> */
    use HasFactory;
    
    protected $table = 'patient_medications';
    
    protected $fillable = [
        'patient_id',
        'medication_id',
        'dosage',
        'frequency',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d'
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
