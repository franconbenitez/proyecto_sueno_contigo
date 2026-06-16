@extends('layouts.plantilla')
@section('contenido')

<section class="seccion-auth d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5">

                <div class="card-auth">

                    {{-- Encabezado --}}
                    <div class="auth-header text-center mb-4">
                        <span class="auth-icono">🌸</span>
                        <h1 class="auth-titulo">Crear cuenta</h1>
                        <p class="auth-subtitulo">Sumate a la familia Sueño Contigo</p>
                    </div>

                    @if(session('mensajeAuth'))
                        <div class="alert alert-info text-center rounded-4 mb-4">
                            {{ session('mensajeAuth') }}
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form method="POST" action="/registro">
                    @csrf

                        {{-- Nombre --}}
                        <div class="auth-campo mb-3">
                            <label for="nombre" class="auth-label">Nombre</label>
                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                class="auth-input"
                                placeholder="Tu nombre"
                                value="{{ old('nombre') }}"
                                required>
                            @error('nombre')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Apellido --}}
                        <div class="auth-campo mb-3">
                            <label for="apellido" class="auth-label">Apellido</label>
                            <input
                                type="text"
                                id="apellido"
                                name="apellido"
                                class="auth-input"
                                placeholder="Tu apellido"
                                value="{{ old('apellido') }}"
                                required>
                            @error('apellido')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="auth-campo mb-3">
                            <label for="email" class="auth-label">Correo electrónico</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="auth-input"
                                placeholder="tu@email.com"
                                value="{{ old('email') }}"
                                required>
                            @error('email')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="auth-campo mb-3">
                            <label for="password" class="auth-label">Contraseña</label>
                            <div class="input-password-wrap">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="auth-input"
                                    placeholder="Mínimo 8 caracteres"
                                    required>
                                <button type="button"
                                        class="btn-ojo"
                                        onclick="togglePassword('password', this)"
                                        title="Mostrar contraseña">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Repetir contraseña --}}
                        <div class="auth-campo mb-4">
                            <label for="password_confirm" class="auth-label">Repetí tu contraseña</label>
                            <div class="input-password-wrap">
                                <input
                                    type="password"
                                    id="password_confirm"
                                    name="password_confirmation"
                                    class="auth-input"
                                    placeholder="••••••••"
                                    required>
                                <button type="button"
                                        class="btn-ojo"
                                        onclick="togglePassword('password_confirm', this)"
                                        title="Mostrar contraseña">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Términos y condiciones --}}
                        <div class="mb-4">
                            <label class="recordar-label align-items-start">
                                <input type="checkbox" name="terminos" class="recordar-check mt-1" required>
                                <span>
                                    Acepto los
                                    <a href="/terminos" class="link-auth">Términos y Condiciones</a>
                                    y las políticas de privacidad del sitio.
                                </span>
                            </label>
                        </div>

                        {{-- Botón registrarse --}}
                        <button type="submit" class="btn-auth-primary w-100 mb-4">
                            Crear mi cuenta
                        </button>

                    </form>

                    {{-- Link a login --}}
                    <p class="text-center auth-pie mb-0">
                        ¿Ya tenés cuenta?
                        <a href="/login" class="link-auth fw-bold">Iniciá sesión acá</a>
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