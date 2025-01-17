<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Definir os campos que podem ser preenchidos
    protected $fillable = [
        'car_model', 'dealership', 'delivery_date', 'pickup_date', 'service', 'user_id', 'user_name', 'user_email'
    ];

    // Relacionamento com o usuário (usuário que agendou o serviço)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
}
