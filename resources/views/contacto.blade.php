@extends('layouts.plantilla')

@section('contenido')
<div class="container container-legal mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h1 class="titulo-legal text-center mb-3">Contacto</h1>
            <p class="intro-legal text-center mb-5">
                ¿Tenés alguna consulta o querés hacer un pedido?<br>
                Podés comunicarte con nosotras por los siguientes medios o completar el formulario 💖
            </p>

            <div class="row g-4">

                {{-- Columna Izquierda: Medios de contacto --}}
                <div class="col-md-4">
                    <div class="card-legal p-4 shadow-sm h-100">
                        <h4 class="mb-4 color-primario subtitulo-contacto">Nuestros medios</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="https://instagram.com/suenio.contigo" target="_blank" class="texto-legal text-decoration-none">
                                    <i class="bi bi-instagram me-2 color-primario"></i> @suenio.contigo
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="https://wa.me/543795340652" target="_blank" class="texto-legal text-decoration-none">
                                    <i class="bi bi-whatsapp me-2 color-primario"></i> 3795 340652
                                </a>
                            </li>
                            <li class="mb-3 texto-legal">
                                <i class="bi bi-envelope me-2 color-primario"></i> suenio_contigo@gmail.com
                            </li>
                        </ul>
                        <div class="aviso-contacto mt-4 p-3 rounded-3">
                            <small class="texto-legal-italic">Te responderemos a la brevedad 💕</small>
                        </div>
                    </div>
                </div>

                {{-- Columna Derecha: Formulario --}}
                <div class="col-md-8">
                    <div class="card-legal p-4 shadow-sm">

                        {{-- Alerta general por si hay errores --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>¡Ups!</strong> Por favor revisá los campos en rojo.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ url('/contacto') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input 
                                        type="text" 
                                        name="nombre" 
                                        class="form-control @error('nombre') is-invalid @enderror" 
                                        placeholder="Tu nombre" 
                                        minlength="3" 
                                        value="{{ old('nombre') }}" 
                                        required>
                                    @error('nombre')
                                        <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        placeholder="nombre@ejemplo.com" 
                                        value="{{ old('email') }}" 
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Número de pedido (opcional)</label>
                                    <input 
                                        type="text" 
                                        name="pedido" 
                                        class="form-control @error('pedido') is-invalid @enderror" 
                                        placeholder="#1234"
                                        value="{{ old('pedido') }}">
                                    @error('pedido')
                                        <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tipo de consulta</label>
                                    <select name="tipo_consulta" class="form-select @error('tipo_consulta') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('tipo_consulta') ? '' : 'selected' }}>Elegir opción...</option>
                                        <option value="pedido" {{ old('tipo_consulta') == 'pedido' ? 'selected' : '' }}>Pedido</option>
                                        <option value="talles" {{ old('tipo_consulta') == 'talles' ? 'selected' : '' }}>Talles</option>
                                        <option value="envios" {{ old('tipo_consulta') == 'envios' ? 'selected' : '' }}>Envíos</option>
                                        <option value="otro" {{ old('tipo_consulta') == 'otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('tipo_consulta')
                                        <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mensaje</label>
                                <textarea 
                                    name="mensaje" 
                                    class="form-control @error('mensaje') is-invalid @enderror" 
                                    rows="4" 
                                    placeholder="Escribinos tu consulta aquí..." 
                                    minlength="10" 
                                    required>{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn-enviar-contacto">
                                    Enviar mensaje
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection