<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;

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
        // 1. LA VALIDACIÓN MÁGICA (Frena los espacios en blanco y nulos)
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'pedido' => 'nullable|string',
            'tipo_consulta' => 'required|string',
            'mensaje' => 'required|string|min:10' // ¡El required es clave!
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'tipo_consulta.required' => 'Debes seleccionar un tipo de consulta.',
            'mensaje.required' => 'No podés enviar un mensaje vacío.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.'
        ]);

        // Capturamos todos los campos del formulario nuevo
        $nombre   = $request->input('nombre');
        $email    = $request->input('email');
        $pedido   = $request->input('pedido'); // El campo opcional
        $tipo     = $request->input('tipo_consulta');
        $mensaje  = $request->input('mensaje');

        Consulta::create([
            'nombre' => $nombre,
            'email' => $email,
            'pedido' => $pedido,
            'tipo_consulta' => $tipo,
            'mensaje' => $mensaje,
        ]);

        // Retornamos la vista de éxito pasando los datos
        return view('exito', [
            'nombre' => $nombre,
            'email'  => $email,
            'pedido' => $pedido,
            'tipo'   => $tipo
        ]);
    }
}