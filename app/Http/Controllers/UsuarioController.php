<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Persona::with('perfil')->get();

        return view(
            'backend.usuarios.index',
            compact('usuarios')
        );
    }

    public function create()
    {
        return view('backend.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|email|unique:personas,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'perfil_id' => 1, // Administrador
            'activo' => 1
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Administrador creado correctamente.');
    }
}