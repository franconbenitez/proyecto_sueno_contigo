@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-5 pt-5">
    <h2 class="color-primario mb-4" style="font-family: 'Cormorant Garamond', serif;">Tu Carrito 💖</h2>

    {{-- ALERTAS DE ÉXITO O ERROR --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-4">{{ session('error') }}</div>
    @endif

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="table-responsive shadow-sm rounded-4 p-3 bg-white">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted text-center"> {{-- Centramos todo el encabezado --}}
                        <th class="text-start">Producto</th> {{-- Excepto el producto, que queda mejor a la izquierda --}}
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach(session('carrito') as $key => $item)
                        @php $total += $item['precio'] * $item['cantidad'] @endphp
                        <tr class="text-center"> {{-- Centramos todas las celdas de la fila --}}
                            <td class="text-start"> {{-- El producto mantiene alineación izquierda --}}
                                <img src="{{ asset('storage/' . $item['img']) }}"
                                width="50"
                                class="rounded me-2">
                                <span class="fw-bold">{{ $item['nombre'] }}</span>
                            </td>
                            <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                            
                            <td>
                                {{-- Contenedor de cantidad perfectamente centrado --}}
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    
                                    {{-- Botón Restar --}}
                                    <a href="/carrito/restar/{{ $key }}" 
                                       class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                       style="width: 28px; height: 28px; line-height: 1;">
                                        <i class="bi bi-dash"></i>
                                    </a>
                                    
                                    {{-- Cantidad numérica --}}
                                    <span class="fw-bold fs-5" style="min-width: 20px;">
                                        {{ $item['cantidad'] }}
                                    </span>
                                    
                                    {{-- Botón Sumar --}}
                                    <a href="/carrito/sumar/{{ $key }}" 
                                       class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                       style="width: 28px; height: 28px; line-height: 1;">
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
        
        <div class="text-end mt-4">
            <h3 class="mb-4">Total: ${{ number_format($total, 0, ',', '.') }}</h3>
            
            <div class="d-flex justify-content-end align-items-center gap-2">
                <a href="/carrito/vaciar" class="btn btn-outline-secondary rounded-pill px-4">Vaciar Carrito</a>
                
                {{-- Validamos si el usuario está logueado para mostrar el formulario real --}}
                @auth
                    <form action="/carrito/comprar" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-lg text-white px-5" style="background-color: #5d4d7a; border-radius: 25px;">
                            Finalizar Compra
                        </button>
                    </form>
                @else
                    <a href="/login" class="btn btn-lg text-white px-5" style="background-color: #5d4d7a; border-radius: 25px;">
                        Iniciá sesión para comprar
                    </a>
                @endauth
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted italic">Tu carrito está durmiendo... 😴</h4>
            <a href="/catalogo/productos" class="btn btn-lg mt-3 text-white" style="background-color: #5d4d7a; border-radius: 25px;">Ir a ver pijamas</a>
        </div>
    @endif
</div>

{{-- Espaciado extra --}}
<div class="py-5"></div>
@endsection