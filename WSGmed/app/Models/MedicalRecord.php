<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /** @use HasFactory<\Database\Factories\MedicalRecordFactory> */
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'record_date',
        'blood_pressure',
        'temperature',
        'pulse',
        'weight',
        'mood',
        'pain_level',
        'oxygen_saturation',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
