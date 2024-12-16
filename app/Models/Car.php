<?php

// app/Models/Car.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'year', 'price'];

    // Relacionamento com as imagens
        // Car.php (Modelo Car)
        public function images()
        {
            return $this->hasMany(Image::class); // Relacionamento com o modelo Image
        }

}
