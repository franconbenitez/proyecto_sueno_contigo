<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    // Muestra el formulario de contacto (GET)
    public function index()
    {
        return view('contacto');
    }

    // Procesa el formulario enviado (POST)
    public function procesar(Request $request)
    {

        // Capturamos todos los campos del formulario nuevo
        $nombre   = $request->input('nombre');
        $email    = $request->input('email');
        $pedido   = $request->input('pedido'); // El campo opcional
        $tipo     = $request->input('tipo_consulta');
        $mensaje  = $request->input('mensaje');

        // Retornamos la vista de éxito pasando los datos
        return view('exito', [
            'nombre' => $nombre,
            'email'  => $email,
            'pedido' => $pedido,
            'tipo'   => $tipo
        ]);
    }
}