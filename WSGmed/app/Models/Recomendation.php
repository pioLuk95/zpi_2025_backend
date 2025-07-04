<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendation extends Model
{
    /** @use HasFactory<\Database\Factories\RecomendationFactory> */
    use HasFactory;

    public function staffPatient()
    {
        return $this->belongsTo(StaffPatient::class);
    }
}
