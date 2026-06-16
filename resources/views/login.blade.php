@extends('layouts.plantilla')
@section('contenido')

<section class="seccion-auth d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5">

                <div class="card-auth">

                    {{-- Encabezado --}}
                    <div class="auth-header text-center mb-4">
                        <span class="auth-icono">🌙</span>
                        <h1 class="auth-titulo">Bienvenida</h1>
                        <p class="auth-subtitulo">Iniciá sesión en tu cuenta</p>
                    </div>

                    @if(session('mensajeAuth'))
                        <div class="alert alert-info text-center rounded-4 mb-4">
                            {{ session('mensajeAuth') }}
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form method="POST" action="/login">
                    @csrf

                        {{-- Email --}}
                        <div class="auth-campo mb-3">
                            <label for="email" class="auth-label">Correo electrónico</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="auth-input"
                                placeholder="tu@email.com"
                                required>
                        </div>
                        @error('email')
                            <small class="text-danger d-block mb-3">{{ $message }}</small>
                        @enderror

                        {{-- Contraseña --}}
                        <div class="auth-campo mb-2">
                            <label for="password" class="auth-label">Contraseña</label>
                            <div class="input-password-wrap">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="auth-input"
                                    placeholder="••••••••"
                                    required>
                                <button type="button"
                                        class="btn-ojo"
                                        onclick="togglePassword('password', this)"
                                        title="Mostrar contraseña">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Recordar + Olvidé --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="recordar-label">
                                <input type="checkbox" name="recordar" class="recordar-check">
                                <span>Recordar mi correo</span>
                            </label>
                            <a href="#" class="link-olvide">¿Olvidaste tu contraseña?</a>
                        </div>

                        {{-- Botón iniciar sesión --}}
                        <button type="submit" class="btn-auth-primary w-100 mb-4">
                            Iniciar sesión
                        </button>

                    </form>

                    {{-- Link a registro --}}
                    <p class="text-center auth-pie mb-0">
                        ¿No tenés cuenta?
                        <a href="/registro" class="link-auth fw-bold">Registrate acá</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- Script para mostrar/ocultar contraseña --}}
<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icono = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icono.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icono.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>

@endsection