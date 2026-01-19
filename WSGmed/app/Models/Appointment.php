<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'staff_id',
        'insert_date',
        'visit_date',
        'visit_hour',
        'type',
        'status',
        'comment',
        'staff_role_id',
    ];

    protected $casts = [
        'insert_date' => 'datetime',
        'visit_date'  => 'date',
        'visit_hour'  => 'datetime:H:i',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function staffRole()
    {
        return $this->belongsTo(Role::class, 'staff_role_id');
    }
}
