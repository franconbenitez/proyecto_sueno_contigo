<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\QuienesSomosController;
use App\Http\Controllers\ComercializacionController;
use App\Http\Controllers\TerminosController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\CarritoController;

/*
|--------------------------------------------------------------------------
| Web Routes - Proyecto Sueño Contigo
|--------------------------------------------------------------------------
*/

// Página principal
Route::get('/', [PrincipalController::class, 'index']);

// --- SECCIÓN CATÁLOGO ---
// Maneja las categorías (pijamas, lenceria, batas, pantuflas, productos)
Route::get('/catalogo/{categoria}', [CatalogoController::class, 'mostrarCategoria']);

// Ruta para la página individual de cada producto (Compra/Detalle)
Route::get('/producto/{id}', [CatalogoController::class, 'detalle']);


// --- PÁGINAS INFORMATIVAS ---
// Quiénes somos
Route::get('/quienes-somos', [QuienesSomosController::class, 'index']);

// Comercialización
Route::get('/comercializacion', [ComercializacionController::class, 'index']);

// Términos y usos
Route::get('/terminos', [TerminosController::class, 'index']);

// Información general (Guía de talles y cuidados)
Route::get('/informacion', [InformacionController::class, 'index']);


// --- CONTACTO ---
// GET muestra el formulario, POST lo procesa
Route::get('/contacto', [ContactoController::class, 'index']);
Route::post('/contacto', [ContactoController::class, 'procesar']);


// --- AUTENTICACIÓN ---
// Login
Route::get('/login', [LoginController::class, 'index']);

// Registro
Route::get('/registro', [RegistroController::class, 'index']);

// Login (temporal)
Route::post('/login', function () {
    return back()->with('mensajeAuth', 'El inicio de sesión estará disponible en la próxima etapa del proyecto.');
});

// Registro (temporal)
Route::post('/registro', function () {
    return back()->with('mensajeAuth', 'La creación de cuentas estará disponible en la próxima etapa del proyecto.');
});

// CARRITO
Route::get('/carrito', [CarritoController::class, 'index']);
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar']);

