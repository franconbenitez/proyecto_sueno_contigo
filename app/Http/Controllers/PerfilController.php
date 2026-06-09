<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

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
        $pedidos = Pedido::where('persona_id', Auth::id())
            ->latest()
            ->get();

        return view('perfil.pedidos', compact('pedidos'));
    }
}