<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        // Validamos que el talle esté seleccionado
        $request->validate([
            'talle' => 'required'
        ]);

        $carrito = session()->get('carrito', []);
        
        // Creamos una clave única (ID + Talle) para permitir el mismo producto en talles distintos
        $key = $request->id . "_" . $request->talle;

        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad']++;
        } else {
            $carrito[$key] = [
                "id" => $request->id,
                "nombre" => $request->nombre,
                "precio" => $request->precio,
                "img" => $request->img,
                "talle" => $request->talle,
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', '¡Producto añadido! 💖');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect('/catalogo/productos');
    }

    public function eliminar($key)
    {
        $carrito = session()->get('carrito', []);
        if(isset($carrito[$key])) {
            unset($carrito[$key]);
            session()->put('carrito', $carrito);
        }
        return redirect()->back();
    }
}