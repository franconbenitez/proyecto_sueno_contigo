@extends('layouts.plantilla')

@section('contenido')
<div class="container container-legal mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <h1 class="titulo-legal text-center mb-3">Contacto</h1>
            <p class="text-center mb-5 text-muted">
                ¿Tenés alguna consulta o querés hacer un pedido?<br>
                Podés comunicarte con nosotras por los siguientes medios o completar el formulario 💖
            </p>

            <div class="row g-4">
                {{-- Columna Izquierda: Medios de contacto --}}
                <div class="col-md-4">
                    <div class="card-legal p-4 shadow-sm h-100">
                        <h4 class="mb-4 color-primario">Nuestros medios</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="https://instagram.com/suenio.contigo" target="_blank" class="text-decoration-none text-muted">
                                    <i class="bi bi-instagram me-2 color-primario"></i> @suenio.contigo
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="https://wa.me/543795340652" target="_blank" class="text-decoration-none text-muted">
                                    <i class="bi bi-whatsapp me-2 color-primario"></i> 3795 340652
                                </a>
                            </li>
                            <li class="mb-3 text-muted">
                                <i class="bi bi-envelope me-2 color-primario"></i> suenio_contigo@gmail.com
                            </li>
                        </ul>
                        <div class="mt-4 p-3 rounded-3" style="background-color: rgba(252, 228, 236, 0.5);">
                            <small class="text-muted italic">Te responderemos a la brevedad 💕</small>
                        </div>
                    </div>
                </div>

                {{-- Columna Derecha: Formulario --}}
                <div class="col-md-8">
                    <div class="card-legal p-4 shadow-sm">
                        <form action="#" method="POST">
                            @csrf {{-- Esto es obligatorio en Laravel para formularios --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" placeholder="Tu nombre" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="nombre@ejemplo.com" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Número de pedido (opcional)</label>
                                    <input type="text" class="form-control" placeholder="#1234">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tipo de consulta</label>
                                    <select class="form-select">
                                        <option selected>Elegir opción...</option>
                                        <option value="1">Pedido</option>
                                        <option value="2">Talles</option>
                                        <option value="3">Envíos</option>
                                        <option value="4">Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mensaje</label>
                                <textarea class="form-control" rows="4" placeholder="Escribinos tu consulta aquí..." required></textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn-volver-legal border-0" style="background-color: #5d4d7a; color: white;">
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