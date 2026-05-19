<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Authenticatable
{
    use HasFactory, Notifiable;

    // Indicamos que este modelo maneja la tabla 'personas'
    protected $table = 'personas';

    // Campos que se pueden cargar (los que pidió el profe)
    protected $fillable = [
        'nombre', 
        'apellido', 
        'email', 
        'password', 
        'perfil_id', 
        'activo'
    ];

    // Ocultamos la contraseña en las consultas
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // Esto asegura que la contraseña siempre se guarde encriptada
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}