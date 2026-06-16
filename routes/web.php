<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PrincipalController, CatalogoController, QuienesSomosController, 
    ComercializacionController, TerminosController, ContactoController, 
    InformacionController, CarritoController, AuthController, 
    AdminController, ProductoController, UsuarioController, 
    ConsultaController, PedidoController, PerfilController
};

/*
|--------------------------------------------------------------------------
| Web Routes - Proyecto Sueño Contigo
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS ---
Route::get('/', [PrincipalController::class, 'index']);
Route::get('/catalogo/{categoria}', [CatalogoController::class, 'mostrarCategoria']);
Route::get('/producto/{id}', [CatalogoController::class, 'detalle']);
Route::get('/quienes-somos', [QuienesSomosController::class, 'index']);
Route::get('/comercializacion', [ComercializacionController::class, 'index']);
Route::get('/terminos', [TerminosController::class, 'index']);
Route::get('/informacion', [InformacionController::class, 'index']);
Route::get('/contacto', [ContactoController::class, 'index']);
Route::post('/contacto', [ContactoController::class, 'procesar']);

// --- AUTENTICACIÓN (Públicas) ---
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login'); // Nombre 'login' es importante para el middleware
Route::get('/registro', [AuthController::class, 'formularioRegistro']);
Route::post('/registro', [AuthController::class, 'registrar']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- RUTAS DE CARRITO (Públicas) ---
Route::get('/carrito', [CarritoController::class, 'index']);
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar']);
Route::get('/carrito/eliminar/{key}', [CarritoController::class, 'eliminar']);
Route::get('/carrito/sumar/{key}', [CarritoController::class, 'sumar']);
Route::get('/carrito/restar/{key}', [CarritoController::class, 'restar']);

// --- RUTAS PROTEGIDAS (Solo usuarios logueados) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [PerfilController::class, 'index'])->name('profile');
    Route::post('/profile', [PerfilController::class, 'update'])->name('profile.update');
    Route::get('/mis-pedidos', [PerfilController::class, 'pedidos'])->name('mis.pedidos');
    Route::get('/mis-consultas', [PerfilController::class, 'consultas'])->name('mis.consultas');
    Route::post('/carrito/comprar', [CarritoController::class, 'comprar']);
    Route::get('/compra-exitosa', [CarritoController::class, 'gracias'])->name('compra.exito');
});

// --- RUTAS DE ADMINISTRACIÓN (Solo admins) ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard']);
    
    Route::resource('productos', ProductoController::class);
    Route::put('/productos/{id}/restore', [ProductoController::class, 'restore'])->name('productos.restore');
    
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    
    Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
    Route::post('/admin/consultas/{id}/toggle', [ConsultaController::class, 'toggleLeido'])->name('consultas.toggle');
    Route::post('/admin/consultas/{id}/responder', [ConsultaController::class, 'responder'])->name('consultas.responder');
    
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::put('/pedidos/{id}/estado', [PedidoController::class, 'actualizarEstado']);
});