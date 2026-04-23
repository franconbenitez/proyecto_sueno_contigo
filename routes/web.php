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

// Página principal
Route::get('/', [PrincipalController::class, 'index']);

// Esta única línea maneja todas las categorías
Route::get('/catalogo/{categoria}', [CatalogoController::class, 'mostrarCategoria']);

// Quiénes somos
Route::get('/quienes-somos', [QuienesSomosController::class, 'index']);

// Comercialización
Route::get('/comercializacion', [ComercializacionController::class, 'index']);

// Términos y usos
Route::get('/terminos', [TerminosController::class, 'index']);

// Contacto (GET muestra el formulario, POST lo procesa)
Route::get('/contacto', [ContactoController::class, 'index']);
Route::post('/contacto', [ContactoController::class, 'procesar']);

// Login
Route::get('/login', [LoginController::class, 'index']);

// Registro
Route::get('/registro', [RegistroController::class, 'index']);

//Informacion
Route::get('/informacion', [InformacionController::class, 'index']);