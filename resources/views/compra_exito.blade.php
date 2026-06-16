@extends('layouts.plantilla')

@section('contenido')
<div class="container my-5 pt-5" style="min-height: 65vh;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 text-center">
            
            {{-- Tarjeta contenedora --}}
            <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px; background-color: #fffafa;">
                
                {{-- Ícono de éxito --}}
                <div class="mb-4 d-inline-block p-4 rounded-circle" style="background-color: rgba(140, 82, 255, 0.1); width: fit-content; margin: 0 auto;">
                    <i class="bi bi-bag-heart-fill" style="font-size: 4rem; color: #8c52ff;"></i>
                </div>

                <h1 class="fw-bold mb-2" style="color: #5d4d7a; font-family: 'Cormorant Garamond', serif;">
                    ¡Muchas gracias por tu compra!
                </h1>
                
                <p class="fs-5 text-muted mb-4">
                    Tu pedido ya está registrado y lo estamos preparando con mucho amor. 💖
                </p>

                {{-- Cuadro con los datos de la orden --}}
                <div class="p-3 mb-4 rounded-3 text-start border" style="background-color: #f8f9fa;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small fw-bold text-uppercase">Número de Orden:</span>
                        <span class="fw-bold text-dark">{{ session('numero_pedido') }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2">
                        <span class="text-muted small">Estado actual:</span>
                        <span class="badge bg-warning text-dark fw-medium">Pendiente de preparación</span>
                    </div>
                </div>

                <p class="small text-muted mb-5">
                    Te enviamos un correo electrónico con los detalles del pago y el seguimiento de tu envío. Si tenés alguna consulta, no dudes en escribirnos desde la sección de contacto.
                </p>

                {{-- Botones de acción --}}
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="/mis-pedidos" class="btn text-white px-4 py-2" style="background-color: #5d4d7a; border-radius: 8px; font-weight: 500;">
                        <i class="bi bi-eye me-2"></i> Ver mis pedidos
                    </a>
                    <a href="/catalogo/productos" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 8px; font-weight: 500;">
                        Seguir comprando
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection