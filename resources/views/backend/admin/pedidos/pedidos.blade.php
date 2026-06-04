@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="row mb-4">
    <div class="col">
        <h2 class="titulo-seccion color-primario">Pedidos Recibidos</h2>
        <p class="intro-legal">Control de despachos y logística.</p>
    </div>
</div>

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
                        <td class="texto-legal">{{ $pedido->created_at->format('d/m/Y') }}</td>
                        <td>{{ $pedido->persona->nombre ?? 'Usuario Eliminado' }}</td>
                        <td class="fw-bold">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td>
                            @if($pedido->estado == 'Pendiente')
                                <span class="badge" style="background-color: var(--color-rosa-claro);">{{ $pedido->estado }}</span>
                            @elseif($pedido->estado == 'Entregado')
                                <span class="badge bg-success">{{ $pedido->estado }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $pedido->estado }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-box-seam me-1"></i> Detalle</button>
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

@endsection