<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; 

class PrincipalController extends Controller
{
    public function index()
    {
        // 1. LOS MÁS VENDIDOS (Esto ya lo tenías, queda igual)
        $masVendidos = Producto::where('activo', true)
            ->withSum('detalles', 'cantidad')
            ->orderBy('detalles_sum_cantidad', 'desc')
            ->take(3)
            ->get();

        // 2. NUEVA COLECCIÓN (Los últimos 3 añadidos)
        $nuevaColeccion = Producto::where('activo', true)
            ->latest() // Esto los ordena por fecha de creación, del más nuevo al más viejo
            ->take(3)  // Agarramos solo 3
            ->get();

        // Le pasamos las dos variables a la vista
        return view('principal', compact('masVendidos', 'nuevaColeccion'));
    }
}