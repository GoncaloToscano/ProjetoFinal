<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TestDrive extends Model
{
    use HasFactory;
    use Notifiable;

    // Relação com o modelo Car
    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class);
    }

    // Definindo o relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        
    // Adicionando 'user_id' ao $fillable para permitir a atribuição em massa
    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'observations',
        'terms_accepted',
        'confirmed',
        'car_id',
        'user_id'  // Adicionando a coluna user_id ao preenchimento em massa
    ];
}
