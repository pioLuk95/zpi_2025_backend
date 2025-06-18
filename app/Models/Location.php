<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;
    protected $fillable = ['room', 'floor', 'limit'];

    protected function name(): Attribute
    {
        return Attribute::get(
            fn () => 'Pokój ' . $this->room . ' - piętro ' . $this->floor
        );
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
