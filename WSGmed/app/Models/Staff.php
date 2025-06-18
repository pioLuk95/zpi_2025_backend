<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        's_name',
        'email',
        'date_of_birth',
        'role_id',
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, "staff_patients", "staff_id", "patient_id");
    }
}
