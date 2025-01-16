<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Propriedade fillable para permitir atribuição em massa
    protected $fillable = [
        'car_model',
        'dealership',
        'delivery_date',
        'pickup_date',
        'service',
    ];

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
