@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="row mb-4">
    <div class="col">
        <h2 class="titulo-seccion color-primario">Pedidos Recibidos</h2>
        <p class="intro-legal">Control de despachos y logística.</p>
    </div>
</div>

{{-- Mostrar mensaje de éxito si se actualizó el estado --}}
@if(session('success'))
    <div class="alert alert-success shadow-sm rounded-3">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    </div>
@endif

<div class="card-legal p-4 shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-muted" style="border-bottom: 2px solid var(--color-suave);">
                <tr>
                    <th># Orden</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                    <tr>
                        <td class="fw-bold color-primario">{{ $pedido->numero_pedido }}</td>
                        <td class="texto-legal">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $pedido->persona->nombre ?? 'Usuario Eliminado' }}</td>
                        <td class="fw-bold">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td>
                            @if($pedido->estado == 'Pendiente')
                                <span class="badge" style="background-color: var(--color-rosa-claro);">{{ $pedido->estado }}</span>
                            @elseif($pedido->estado == 'Entregado')
                                <span class="badge bg-success">{{ $pedido->estado }}</span>
                            @elseif($pedido->estado == 'Enviado')
                                <span class="badge bg-info text-dark">{{ $pedido->estado }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $pedido->estado }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            {{-- Botón que activa el modal correspondiente usando el ID del pedido --}}
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalDetalle{{ $pedido->id }}">
                                <i class="bi bi-box-seam me-1"></i> Detalle
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted opacity-50"></i>
                            Aún no hay pedidos registrados en la base de datos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ZONA DE MODALES (Ventanas emergentes) --}}
@foreach($pedidos as $pedido)
<div class="modal fade" id="modalDetalle{{ $pedido->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $pedido->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #5d4d7a;">
                <h5 class="modal-title" id="modalLabel{{ $pedido->id }}">
                    <i class="bi bi-receipt me-2"></i> Orden: {{ $pedido->numero_pedido }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4">
                
                {{-- Datos del cliente --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted small">Cliente</p>
                        <p class="fw-bold mb-0">{{ $pedido->persona->nombre ?? 'N/A' }} {{ $pedido->persona->apellido ?? '' }}</p>
                        <p class="text-muted small">{{ $pedido->persona->email ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1 text-muted small">Fecha de compra</p>
                        <p class="fw-bold">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                {{-- Tabla de productos comprados --}}
                <div class="table-responsive rounded-3 border">
                    <table class="table table-sm table-borderless mb-0 align-middle">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th class="ps-3 py-2">Producto</th>
                                <th>Talle</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-end pe-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->detalles as $detalle)
                            <tr class="border-top">
                                <td class="ps-3 py-2">
                                    <div class="d-flex align-items-center">
                                        {{-- Verificamos si el producto aún existe o fue borrado --}}
                                        @if($detalle->producto)
                                            <img src="{{ asset('imagenes/' . $detalle->producto->url_imagen) }}" width="40" height="40" class="rounded object-fit-cover me-2">
                                            <span class="fw-bold text-dark">{{ $detalle->producto->nombre }}</span>
                                        @else
                                            <span class="text-muted fst-italic">Producto Eliminado</span>
                                        @endif
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary">{{ $detalle->talle }}</span></td>
                                <td class="text-center fw-bold">{{ $detalle->cantidad }}</td>
                                <td class="text-end pe-3 fw-bold">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold py-3">TOTAL:</td>
                                <td class="text-end fw-bold text-primary pe-3 fs-5">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <div class="modal-footer bg-light d-flex justify-content-between align-items-center">
                
                {{-- Formulario para cambiar estado --}}
                <form action="/pedidos/{{ $pedido->id }}/estado" method="POST" class="d-flex align-items-center gap-2 m-0">
                    @csrf
                    @method('PUT')
                    <label for="estado" class="text-muted small mb-0 text-nowrap fw-bold">Estado:</label>
                    <select name="estado" class="form-select form-select-sm shadow-sm" style="width: auto; cursor: pointer;">
                        <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Enviado" {{ $pedido->estado == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                        <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="Cancelado" {{ $pedido->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    <button type="submit" class="btn btn-sm text-white px-3 rounded-pill" style="background-color: #5d4d7a;">
                        Actualizar
                    </button>
                </form>

                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection