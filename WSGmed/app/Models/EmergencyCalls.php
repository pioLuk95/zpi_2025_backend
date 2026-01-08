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
        'insert_date',
        'status',
    ];

    protected $casts = [
        'insert_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
