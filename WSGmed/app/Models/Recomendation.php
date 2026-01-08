<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    /** @use HasFactory<\Database\Factories\RecomendationFactory> */
    use HasFactory;

    protected $fillable = [
        'staff_patient_id',
        'date',
        'type',
        'text',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];
    
    public function staffPatient()
    {
        return $this->belongsTo(StaffPatient::class);
    }
}
