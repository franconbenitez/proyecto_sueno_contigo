<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto; // <-- Agregado para poder modificar el stock
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return view('carrito', compact('carrito', 'total'));
    }

    // Agregar producto a la sesión
    public function agregar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        
        $idKey = $request->id . '_' . $request->talle;

        if (isset($carrito[$idKey])) {
            $carrito[$idKey]['cantidad']++;
        } else {
            $carrito[$idKey] = [
                'id' => $request->id,
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'img' => $request->img,
                'talle' => $request->talle,
                'cantidad' => 1
            ];
        }

        session()->put('carrito', $carrito);
        return redirect('/carrito')->with('success', 'Producto agregado al carrito');
    }

    // Aumentar cantidad
    public function sumar($key)
    {
        $carrito = session()->get('carrito');
        if (isset($carrito[$key])) {
            $carrito[$key]['cantidad']++;
            session()->put('carrito', $carrito);
        }
        return redirect('/carrito');
    }

    // Disminuir cantidad
    public function restar($key)
    {
        $carrito = session()->get('carrito');
        if (isset($carrito[$key])) {
            if ($carrito[$key]['cantidad'] > 1) {
                $carrito[$key]['cantidad']--;
            } else {
                unset($carrito[$key]);
            }
            session()->put('carrito', $carrito);
        }
        return redirect('/carrito');
    }

    // Eliminar un producto específico
    public function eliminar($key)
    {
        $carrito = session()->get('carrito');
        if (isset($carrito[$key])) {
            unset($carrito[$key]);
            session()->put('carrito', $carrito);
        }
        return redirect('/carrito');
    }

    // Vaciar todo el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect('/carrito');
    }

    // Procesar la compra y guardar en BD
    public function comprar()
    {
        $carrito = session()->get('carrito');

        if (!$carrito) {
            return redirect('/catalogo/productos')->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // 1. Crear el Pedido Principal
        $pedido = Pedido::create([
            'numero_pedido' => 'ORD-' . strtoupper(uniqid()),
            'persona_id' => Auth::id(),
            'total' => $total,
            'estado' => 'Pendiente'
        ]);

        // 2. Crear los Detalles del Pedido y RESTAR STOCK
        foreach ($carrito as $key => $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['id'],
                'talle' => $item['talle'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);

            // Descontar del stock real
            $productoDB = Producto::find($item['id']);
            if ($productoDB) {
                $productoDB->stock = $productoDB->stock - $item['cantidad'];
                $productoDB->save();
            }
        }

        // 3. Vaciar la sesión
        session()->forget('carrito');

        return redirect('/')->with('success', '¡Gracias por tu compra! Tu pedido ' . $pedido->numero_pedido . ' está siendo procesado.');
    }
}