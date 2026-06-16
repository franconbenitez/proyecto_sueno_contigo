@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-5 pt-5" style="min-height: 60vh;">
    <h2 class="color-primario mb-4" style="font-family: 'Cormorant Garamond', serif;">Tu Carrito 💖</h2>

    {{-- ALERTAS DE ÉXITO O ERROR --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-4">{{ session('error') }}</div>
    @endif

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="table-responsive shadow-sm rounded-4 p-3 bg-white mb-4">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted text-center">
                        <th class="text-start">Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('carrito') as $key => $item)
                        <tr class="text-center">
                            <td class="text-start">
                                <img src="{{ asset('storage/' . $item['img']) }}" width="50" class="rounded me-2">
                                <span class="fw-bold">{{ $item['nombre'] }}</span>
                            </td>
                            <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="/carrito/restar/{{ $key }}" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; line-height: 1;">
                                        <i class="bi bi-dash"></i>
                                    </a>
                                    <span class="fw-bold fs-5" style="min-width: 20px;">{{ $item['cantidad'] }}</span>
                                    <a href="/carrito/sumar/{{ $key }}" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; line-height: 1;">
                                        <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                            </td>
                            <td>${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</td>
                            <td>
                                <a href="/carrito/eliminar/{{ $key }}" class="text-danger">
                                    <i class="bi bi-trash fs-5"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="row justify-content-end">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                    
                    {{-- RESUMEN DE COMPRA --}}
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal:</span>
                        <span class="fw-bold text-dark">${{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    {{-- ALERTA DE 10% DE DESCUENTO --}}
                    @if($esPrimeraCompra)
                        <div class="d-flex justify-content-between mb-3 text-success">
                            <span><i class="bi bi-tag-fill me-1"></i> Descuento Primera Compra (10%):</span>
                            <span class="fw-bold">-${{ number_format($descuento, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <hr class="opacity-25">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 fw-bold color-primario">Total:</h4>
                        <h3 class="mb-0 fw-bold color-primario">${{ number_format($total, 0, ',', '.') }}</h3>
                    </div>
                    
                    <div class="d-flex flex-column gap-2">
                        @auth
                            <form action="/carrito/comprar" method="POST" class="m-0 d-grid">
                                @csrf
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #5d4d7a; border-radius: 25px;">
                                    Finalizar Compra
                                </button>
                            </form>
                        @else
                            <a href="/login" class="btn btn-lg text-white" style="background-color: #5d4d7a; border-radius: 25px;">
                                Iniciá sesión para comprar
                            </a>
                        @endauth
                        
                        <a href="/carrito/vaciar" class="btn btn-link text-muted text-decoration-none">Vaciar Carrito</a>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="text-center py-5">
            <h4 class="text-muted fst-italic">Tu carrito está durmiendo... 😴</h4>
            <a href="/catalogo/productos" class="btn btn-lg mt-3 text-white px-4" style="background-color: #5d4d7a; border-radius: 25px;">Ir a ver pijamas</a>
        </div>
    @endif
</div>

{{-- Espaciado extra --}}
<div class="py-5"></div>
@endsection