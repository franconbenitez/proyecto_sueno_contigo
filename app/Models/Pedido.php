<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'numero_pedido',
        'persona_id',
        'total',
        'descuento',
        'estado'
    ];

    // Relación: Un pedido pertenece a una persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    // Relación: Un pedido tiene muchos detalles
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }
}