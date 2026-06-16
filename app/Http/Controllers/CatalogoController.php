<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CatalogoController extends Controller
{
    // Muestra el catálogo filtrando por productos activos
    public function mostrarCategoria($categoria)
    {
        $query = Producto::where('activo', true);

        if ($categoria !== 'productos') {
            $query->whereHas('categoria', function ($q) use ($categoria) {
                $q->whereRaw('LOWER(nombre) = ?', [strtolower($categoria)]);
            });
            $titulo = ucfirst($categoria);
        } else {
            $titulo = "Todos los Productos";
        }

        $productos = $query->get();
        return view('catalogo', compact('productos', 'titulo'));
    }

    // Muestra el detalle solo si el producto está activo
    public function detalle($id)
    {
        $producto = Producto::where('activo', true)->findOrFail($id);
        return view('producto_detalle', compact('producto'));
    }
}