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

                        {{-- CORREGIDO: action apunta a /contacto con POST --}}
                        <form action="{{ url('/contacto') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input
                                        type="text"
                                        name="nombre"
                                        class="form-control"
                                        placeholder="Tu nombre"
                                        minlength="3"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    {{-- CORREGIDO: type="email" garantiza que solo acepte correos válidos --}}
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="nombre@ejemplo.com"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Número de pedido (opcional)</label>
                                    <input
                                        type="text"
                                        name="pedido"
                                        class="form-control"
                                        placeholder="#1234">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tipo de consulta</label>
                                    <select name="tipo_consulta" class="form-select">
                                        <option value="">Elegir opción...</option>
                                        <option value="pedido">Pedido</option>
                                        <option value="talles">Talles</option>
                                        <option value="envios">Envíos</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mensaje</label>
                                <textarea
                                    name="mensaje"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Escribinos tu consulta aquí..."
                                    minlength="10"
                                    required></textarea>
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