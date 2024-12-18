<?php

// app/Models/Car.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'year', 'price', 'fuel', 'kms', 'color', 'power', 'engine_capacity', 'gearbox'];

    // Relacionamento com as imagens
    public function images()
    {
        return $this->hasMany(Image::class); // Relacionamento com o modelo Image
    }
}
