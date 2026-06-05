<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    
    protected $fillable = [
        'nombre',
        'email',
        'pedido',
        'tipo_consulta',
        'mensaje'
    ];
}