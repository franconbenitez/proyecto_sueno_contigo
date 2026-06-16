<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Consulta; // ¡No te olvides de esta línea!

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil.index');
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email'
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;

        $usuario->save();

        return redirect()
            ->route('profile')
            ->with('success', 'Perfil actualizado correctamente');
    }

    public function pedidos()
    {
        $pedidos = Pedido::with('detalles.producto')
            ->where('persona_id', Auth::id())
            ->latest()
            ->get();

        return view('perfil.pedidos', compact('pedidos'));
    }

    // NUEVA FUNCIÓN PARA LAS CONSULTAS DEL CLIENTE
    public function consultas()
    {
        // Busca las consultas usando el email del usuario logueado
        $consultas = Consulta::where('email', Auth::user()->email)
            ->latest()
            ->get();

        return view('perfil.consultas', compact('consultas'));
    }
}