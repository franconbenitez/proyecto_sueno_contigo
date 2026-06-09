<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Persona;
use App\Models\Consulta;
use App\Models\Pedido;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProductos = Producto::withTrashed()->count();

        $productosActivos = Producto::count();

        $productosEliminados = Producto::onlyTrashed()->count();

        $usuariosRegistrados = Persona::count();

        $consultasTotales = Consulta::count();

        $pedidosTotales = Pedido::count();

        $pedidosPendientes = Pedido::where(
            'estado',
            'Pendiente'
        )->count();

        $ventasTotales = Pedido::sum('total');

        return view(
            'backend.admin.dashboard',
            compact(
                'totalProductos',
                'productosActivos',
                'productosEliminados',
                'usuariosRegistrados',
                'consultasTotales',
                'pedidosTotales',
                'pedidosPendientes',
                'ventasTotales'
            )
        );
    }
}