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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PedidoController;

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
Route::get('/login', [AuthController::class, 'formularioLogin']);

Route::get('/registro', [AuthController::class, 'formularioRegistro']);

Route::post('/registro', [AuthController::class, 'registrar']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);


// CARRITO
Route::get('/carrito', [CarritoController::class, 'index']);
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar']);
Route::get('/carrito/eliminar/{key}', [CarritoController::class, 'eliminar']);
Route::get('/carrito/sumar/{key}', [CarritoController::class, 'sumar']);
Route::get('/carrito/restar/{key}', [CarritoController::class, 'restar']);

// Solo usuarios logueados pueden finalizar la compra
Route::post('/carrito/comprar', [CarritoController::class, 'comprar'])->middleware('auth');

// admin
Route::get('/admin', [AdminController::class, 'dashboard'])
    ->middleware('admin');

//PRODUCTO
Route::resource('productos', ProductoController::class)
    ->middleware('admin');
Route::put(
    '/productos/{id}/restore',
    [ProductoController::class, 'restore']
)->name('productos.restore')
 ->middleware('admin');
 Route::get('/usuarios', [UsuarioController::class, 'index'])
    ->middleware('admin')
    ->name('usuarios.index');
Route::get('/usuarios/crear', [UsuarioController::class, 'create'])
    ->middleware('admin')
    ->name('usuarios.create');

Route::post('/usuarios', [UsuarioController::class, 'store'])
    ->middleware('admin')
    ->name('usuarios.store');
Route::get('/consultas', [ConsultaController::class, 'index'])
    ->middleware('admin')
    ->name('consultas.index');
    Route::get('/pedidos', [PedidoController::class, 'index'])
    ->middleware('admin')
    ->name('pedidos.index');
    Route::put('/pedidos/{id}/estado', [PedidoController::class, 'actualizarEstado'])->middleware('admin');