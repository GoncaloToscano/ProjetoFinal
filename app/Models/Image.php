<?php

// app/Models/Image.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'car_id'];

    // Relacionamento com o modelo Car
    public function car()
    {
        return $this->belongsTo(Car::class); // Relacionamento com o modelo Car
    }
}
