<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Persona;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProductos = Producto::count();

        $productosActivos = Producto::where('activo', true)->count();
        
        

        $productosEliminados = Producto::onlyTrashed()->count();
        
        $usuariosRegistrados = Persona::count();

        return view(
            'backend.admin.dashboard',
            compact(
                'totalProductos',
                'productosActivos',
                'productosEliminados',
                'usuariosRegistrados'
            )
        );
    }
}