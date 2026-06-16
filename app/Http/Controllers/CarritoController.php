<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $subtotal = 0;
        
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $descuento = 0;
        $esPrimeraCompra = false;

        // VERIFICAMOS SI APLICA EL 10% OFF
        if (Auth::check()) {
            $cantidadPedidos = Pedido::where('persona_id', Auth::id())->count();
            if ($cantidadPedidos == 0 && $subtotal > 0) {
                $esPrimeraCompra = true;
                $descuento = $subtotal * 0.10; // 10% de descuento
            }
        }

        $total = $subtotal - $descuento;

        return view('carrito', compact('carrito', 'subtotal', 'descuento', 'total', 'esPrimeraCompra'));
    }

    // Agregar producto a la sesión
    public function agregar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $producto = Producto::find($request->id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        $idKey = $request->id;

        if (isset($carrito[$idKey])) {
            if ($carrito[$idKey]['cantidad'] >= $producto->stock) {
                return redirect('/carrito')->with('error', 'No hay más stock disponible.');
            }
            $carrito[$idKey]['cantidad']++;
        } else {
            $carrito[$idKey] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'img' => $producto->url_imagen,
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
            $producto = Producto::find($carrito[$key]['id']);
            if ($producto && $carrito[$key]['cantidad'] >= $producto->stock) {
                return redirect('/carrito')->with('error', 'No hay más stock disponible.');
            }
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

        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        // CALCULAMOS EL DESCUENTO REAL AL COMPRAR
        $descuento = 0;
        $cantidadPedidos = Pedido::where('persona_id', Auth::id())->count();
        if ($cantidadPedidos == 0) {
            $descuento = $subtotal * 0.10;
        }

        $totalFinal = $subtotal - $descuento;

        foreach ($carrito as $item) {
            $producto = Producto::find($item['id']);
            if (!$producto) {
                return redirect('/carrito')->with('error', 'Uno de los productos ya no existe.');
            }
            if ($producto->stock < $item['cantidad']) {
                return redirect('/carrito')->with('error', 'No hay stock suficiente para "' . $producto->nombre . '".');
            }
        }
        
        // 1. Crear el Pedido Principal con el descuento
        $pedido = Pedido::create([
            'numero_pedido' => 'ORD-' . strtoupper(uniqid()),
            'persona_id' => Auth::id(),
            'total' => $totalFinal,
            'descuento' => $descuento, // Guardamos el descuento en la BD
            'estado' => 'Pendiente'
        ]);

        // 2. Crear los Detalles del Pedido y RESTAR STOCK
        foreach ($carrito as $key => $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['id'],
                'talle' => '-',
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);

            $productoDB = Producto::find($item['id']);
            if ($productoDB) {
                $productoDB->stock = $productoDB->stock - $item['cantidad'];
                if ($productoDB->stock <= 0) {
                    $productoDB->activo = false;
                }
                $productoDB->save();
            }
        }

        // 3. Vaciar la sesión
        session()->forget('carrito');

        return redirect()->route('compra.exito')->with('numero_pedido', $pedido->numero_pedido);
    }

    // NUEVA FUNCIÓN: Muestra la pantalla de agradecimiento
    public function gracias()
    {
        if (!session()->has('numero_pedido')) {
            return redirect('/catalogo/productos');
        }
        return view('compra_exito');
    }
}