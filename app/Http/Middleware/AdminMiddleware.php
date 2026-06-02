<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // No inició sesión
        if (!Auth::check()) {
            return redirect('/login');
        }

        // No es administrador
        if (Auth::user()->perfil_id != 1) {
            return redirect('/');
        }

        return $next($request);
    }
}