<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDrive extends Model
{
    use HasFactory;

    // Relação com o modelo Car
    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class);
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'observations',
        'terms_accepted',
        'confirmed',
        'car_id'  
    ];
}
