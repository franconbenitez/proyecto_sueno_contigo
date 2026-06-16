<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // No te olvides de importar el modelo

class PrincipalController extends Controller
{
    public function index()
    {
        // Trae los productos activos, suma las cantidades vendidas, ordena y corta los primeros 3
        $masVendidos = Producto::where('activo', true)
            ->withSum('detalles', 'cantidad')
            ->orderBy('detalles_sum_cantidad', 'desc')
            ->take(3)
            ->get();

        return view('principal', compact('masVendidos'));
    }
}