<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

Route::get('/', function () { 
    return view('principal'); 
    });

Route::get('/catalogo', function () { 
    return view('catalogo'); 
    });

Route::get('/quienes-somos', function () { 
    return view('quienes_somos'); 
    });

Route::get('/comercializacion', function () { 
    return view('comercializacion'); 
    });

Route::get('/terminos', function () { 
    return view('terminos'); 
    });

Route::get('/contacto', function () { 
    return view('contacto'); 
    });

Route::post('/contacto', [ContactoController::class, 'procesar']); // Para el formulario [cite: 1337]

Route::get('/login', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});
