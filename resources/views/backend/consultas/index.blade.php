@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container-fluid">

    <h2 class="mb-4">Consultas Recibidas</h2>

    {{-- Alertas de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alertas de error de validación --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="tabla-admin table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Pedido</th>
                    <th>Tipo</th>
                    <th>Mensaje</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($consultas as $consulta)
                    <tr>
                        <td>{{ $consulta->id }}</td>
                        <td>{{ $consulta->nombre }}</td>
                        <td>{{ $consulta->email }}</td>
                        <td>{{ $consulta->pedido ?? '-' }}</td>
                        <td>{{ $consulta->tipo_consulta }}</td>
                        <td>
                            {{ Str::limit($consulta->mensaje, 30) }}
                            <button class="btn btn-sm btn-link p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalLeer{{ $consulta->id }}">
                                Ver más
                            </button>
                        </td>
                        <td>
                            @if($consulta->leido)
                                <span class="badge bg-success">Leído</span>
                            @else
                                <span class="badge bg-warning text-dark">No leído</span>
                            @endif
                            
                            @if($consulta->respuesta)
                                <span class="badge bg-info mt-1 d-block">Respondido</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- Botón Marcar Leído/No Leído --}}
                                <form action="{{ route('consultas.toggle', $consulta->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $consulta->leido ? 'btn-secondary' : 'btn-success' }}" title="Cambiar estado">
                                        <i class="bi {{ $consulta->leido ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
                                    </button>
                                </form>

                                {{-- Botón Responder (Abre Modal) --}}
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalResponder{{ $consulta->id }}" title="Responder">
                                    <i class="bi bi-reply"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL PARA LEER EL MENSAJE COMPLETO --}}
                    <div class="modal fade" id="modalLeer{{ $consulta->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Mensaje de {{ $consulta->nombre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Email:</strong> {{ $consulta->email }}</p>
                                    <p><strong>Fecha:</strong> {{ $consulta->created_at->format('d/m/Y H:i') }}</p>
                                    <hr>
                                    <div class="mb-3">
                                        <label class="text-muted small fw-bold">Consulta del cliente:</label>
                                        <p class="mb-0">{{ $consulta->mensaje }}</p>
                                    </div>

                                    {{-- ACÁ AGREGAMOS LA VISTA DE LA RESPUESTA --}}
                                    @if($consulta->respuesta)
                                        <hr>
                                        <div class="bg-light p-3 rounded border-start border-4 border-success">
                                            <label class="text-success small fw-bold mb-1">
                                                <i class="bi bi-reply-all-fill"></i> Tu respuesta:
                                            </label>
                                            <p class="mb-0">{{ $consulta->respuesta }}</p>
                                        </div>
                                    @endif

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MODAL PARA RESPONDER --}}
                    <div class="modal fade" id="modalResponder{{ $consulta->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Responder a {{ $consulta->nombre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('consultas.responder', $consulta->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Mensaje original:</label>
                                            <p class="fst-italic border-start border-3 border-primary ps-2">{{ $consulta->mensaje }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Tu respuesta:</label>
                                            <textarea name="respuesta" class="form-control" rows="5" required>{{ $consulta->respuesta }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Respuesta</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            No hay consultas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection