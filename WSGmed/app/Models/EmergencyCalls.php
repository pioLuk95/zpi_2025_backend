<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyCalls extends Model
{
    /** @use HasFactory<\Database\Factories\EmergencyCallsFactory> */
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'date',
        'status',
        'description'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
