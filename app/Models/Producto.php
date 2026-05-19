<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'url_imagen',
        'activo'
    ]; [cite: 70, 72, 73, 74, 75, 76, 77]

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean'
    ]; [cite: 78, 79, 80, 81]
}
