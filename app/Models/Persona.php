<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'perfil_id',
        'activo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }
}