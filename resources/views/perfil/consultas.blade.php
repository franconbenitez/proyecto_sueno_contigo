@extends('layouts.plantilla')

@section('contenido')
<div class="container my-5" style="min-height: 60vh;">
    <div class="row">
        
        <div class="col-12 col-md-8 mx-auto">
            <h2 class="titulo-seccion text-center mb-4">Mis Consultas</h2>
            
            <a href="/profile" class="btn btn-outline-secondary mb-4">
                <i class="bi bi-arrow-left"></i> Volver a mi perfil
            </a>

            @forelse($consultas as $consulta)
                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">
                            <i class="bi bi-calendar3"></i> {{ $consulta->created_at->format('d/m/Y') }}
                        </span>
                        @if($consulta->respuesta)
                            <span class="badge bg-success">Respondida</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-3 text-muted">Asunto: {{ $consulta->tipo_consulta }}</h6>
                        
                        <p class="card-text fw-medium">{{ $consulta->mensaje }}</p>

                        @if($consulta->respuesta)
                            <hr class="text-muted opacity-25">
                            <div class="p-3 mt-3" style="background-color: #f8f9fa; border-radius: 10px; border-left: 4px solid #8c52ff;">
                                <p class="mb-1 fw-bold" style="color: #5d4d7a;">
                                    <i class="bi bi-person-workspace me-1"></i> Respuesta de Sueño Contigo:
                                </p>
                                <p class="mb-0 text-dark">{{ $consulta->respuesta }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-chat-square-text text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted fs-5">Aún no has realizado ninguna consulta.</p>
                    <a href="/contacto" class="btn btn-carrito w-auto px-4 mt-2">Ir a Contacto</a>
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection