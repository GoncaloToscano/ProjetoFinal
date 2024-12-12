<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Campos permitidos para atribuição em massa
    protected $fillable = [
        'name',
        'brand',
        'year',
        'price',
    ];
}
