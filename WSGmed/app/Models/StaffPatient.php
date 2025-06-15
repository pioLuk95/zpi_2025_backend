<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPatient extends Model
{
    /** @use HasFactory<\Database\Factories\StaffPatientFactory> */
    use HasFactory;
    protected $fillable = [
        'staff_id',
        'patient_id'
    ];
}
