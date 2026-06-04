<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido; // Importamos el modelo real

class PedidoController extends Controller
{
    public function index()
    {
        // Trae todos los pedidos de la base de datos con los datos de la persona
        $pedidos = Pedido::with('persona')->orderBy('created_at', 'desc')->get();
        
        // Agregamos ".pedidos" para indicarle que entre a la nueva carpeta
        return view('backend.admin.pedidos.pedidos', compact('pedidos'));
    }
}