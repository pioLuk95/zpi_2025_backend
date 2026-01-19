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
        'insert_date',
        'temperature',
        'pulse',
        'weight',
        'mood',
        'pain_level',
        'oxygen_saturation',
        'systolic_pressure',
        'diastolic_pressure',
    ];
    public function getMoodLabelAttribute()
    {
        return [
            'very_bad'   => 'Bardzo zły',
            'bad'        => 'Zły',
            'good'       => 'Dobry',
            'very_good'  => 'Bardzo dobry',
        ][$this->mood] ?? 'Nieznany';
    }


    public $casts = [
        'insert_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
