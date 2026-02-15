<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DischargeLetter extends Model
{
    protected $fillable = [
        'patient_id',
        'discharge_date',
        'discharge_notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
