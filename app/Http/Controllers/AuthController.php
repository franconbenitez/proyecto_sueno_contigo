<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistroRequest; // Importamos tu validador
use App\Models\Persona; // Tu modelo real de usuarios
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Muestra la vista de Registro
    public function formularioRegistro()
    {
        return view('registro');
    }

    // Muestra la vista de Login
    public function formularioLogin()
    {
        return view('login');
    }

    // Procesa el REGISTRO REAL
    public function registrar(RegistroRequest $request)
    {
        // Si llega acá, los datos ya pasaron la validación del RegistroRequest
        Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Contraseña encriptada
            'perfil_id' => 2, // Por defecto se registra como 'Cliente'
            'activo' => 1 // 1 = Activo
        ]);

        // Redirige al login con un mensaje de éxito
        return redirect('/login')->with('success', '¡Te registraste correctamente! Ya podés iniciar sesión.');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Busca la persona por email
        $persona = Persona::where('email', $request->email)->first();

        // Verifica contraseña y usuario existente
        if ($persona && Hash::check($request->password, $persona->password)) {

            // Inicia sesión
            Auth::login($persona);

            $request->session()->regenerate();

            if ($persona->perfil_id == 1) {
                return redirect('/admin');
            }

            return redirect('/')->with('success', '¡Bienvenido!');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}