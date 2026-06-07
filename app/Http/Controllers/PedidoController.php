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

    public function actualizarEstado(Request $request, $id)
    {
        // Traemos el pedido con sus detalles y productos asociados
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);
        
        $estadoAnterior = $pedido->estado;
        $estadoNuevo = $request->estado;

        // CASO 1: Se está cancelando un pedido que no estaba cancelado
        if ($estadoAnterior != 'Cancelado' && $estadoNuevo == 'Cancelado') {
            foreach ($pedido->detalles as $detalle) {
                if ($detalle->producto) { // Verificamos que el producto no haya sido eliminado de la BD
                    $detalle->producto->stock += $detalle->cantidad;
                    $detalle->producto->save();
                }
            }
        } 
        // CASO 2: Se está "des-cancelando" un pedido (vuelve a Pendiente, Enviado, etc.)
        elseif ($estadoAnterior == 'Cancelado' && $estadoNuevo != 'Cancelado') {
            foreach ($pedido->detalles as $detalle) {
                if ($detalle->producto) {
                    $detalle->producto->stock -= $detalle->cantidad;
                    $detalle->producto->save();
                }
            }
        }

        // Finalmente, actualizamos el estado
        $pedido->estado = $estadoNuevo;
        $pedido->save();

        return redirect()->back()->with('success', 'El estado del pedido se actualizó y el inventario fue ajustado correctamente.');
    }
}