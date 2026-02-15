<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    /** @use HasFactory<\Database\Factories\RecomendationFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'staff_id',
        'date',
        'tittle',
        'text',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
