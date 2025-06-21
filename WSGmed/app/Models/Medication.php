<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    /** @use HasFactory<\Database\Factories\MedicationFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'info'
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_medications', 'medication_id', 'patient_id')
                    ->withPivot('dosage', 'frequency', 'start_date', 'end_date')
                    ->withTimestamps();
    }
}
