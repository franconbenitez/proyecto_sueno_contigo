@extends('layouts.plantilla')

@section('contenido')

<div class="container mt-5 pt-5" style="min-height: 60vh;">

    <h2 class="titulo-seccion text-center mb-4">Mis Pedidos</h2>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-hover align-middle mb-0" style="background-color: #fffafa;">
            <thead style="background-color: var(--color-rosa-claro); color: white;">
                <tr>
                    <th class="py-3">N° Pedido</th>
                    <th class="py-3">Fecha</th>
                    <th class="py-3">Estado</th>
                    <th class="py-3">Total</th>
                    <th class="py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                    <tr>
                        <td class="fw-bold text-secondary">
                            #{{ str_pad($pedido->numero_pedido ?? $pedido->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($pedido->estado == 'Pendiente')
                                <span class="badge bg-warning text-dark">{{ $pedido->estado }}</span>
                            @elseif($pedido->estado == 'Entregado' || $pedido->estado == 'Completado')
                                <span class="badge bg-success">{{ $pedido->estado }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $pedido->estado }}</span>
                            @endif
                        </td>
                        <td class="fw-bold color-primario">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                        <td class="text-center">
                            {{-- Botón que abre el modal --}}
                            <button type="button" class="btn btn-sm text-white" style="background-color: #5d4d7a; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modalDetalle{{ $pedido->id }}">
                                <i class="bi bi-eye"></i> Ver detalle
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-bag-x text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-3 text-muted fs-5">Todavía no realizaste compras.</p>
                            <a href="/catalogo/productos" class="btn btn-carrito w-auto px-4 mt-2">Ir a la tienda</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODALES GENERADOS AFUERA DE LA TABLA (Para no romper el HTML) --}}
@foreach($pedidos as $pedido)
    <div class="modal fade" id="modalDetalle{{ $pedido->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header text-white" style="background-color: #5d4d7a;">
                    <h5 class="modal-title">
                        <i class="bi bi-bag-check me-2"></i>Detalle del Pedido #{{ str_pad($pedido->numero_pedido ?? $pedido->id, 5, '0', STR_PAD_LEFT) }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="border-bottom">
                                <tr class="text-muted small text-uppercase">
                                    <th>Producto</th>
                                    <th class="text-center">Cant.</th>
                                    <th class="text-end">Precio Un.</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Recorremos cada detalle del pedido --}}
                                @foreach($pedido->detalles as $detalle)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                {{-- Verificamos que el producto exista (por si fue borrado de la base) --}}
                                                @if($detalle->producto)
                                                    <img src="{{ asset('storage/' . $detalle->producto->url_imagen) }}" alt="{{ $detalle->producto->nombre }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0 fw-bold color-primario">{{ $detalle->producto->nombre }}</h6>
                                                        <small class="text-muted">Código: {{ $detalle->producto_id }}</small>
                                                    </div>
                                                @else
                                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px;">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                    <span class="text-muted fst-italic">Producto eliminado</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center fw-medium">{{ $detalle->cantidad }}</td>
                                        <td class="text-end text-muted">${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr class="text-muted opacity-25">
                    
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <h5 class="mb-0 text-muted">Total abonado:</h5>
                        <h3 class="mb-0 fw-bold color-primario">${{ number_format($pedido->total, 0, ',', '.') }}</h3>
                    </div>

                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary" style="border-radius: 8px;" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection