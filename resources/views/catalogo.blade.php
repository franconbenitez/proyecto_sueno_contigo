@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-5">
    {{-- Título dinámico: Pijamas, Batas, etc. --}}
    <h1 class="titulo-legal text-center mb-5">{{ $titulo }}</h1>

    <div class="row g-4">
        @foreach($productos as $item)
        <div class="col-12 col-sm-6 col-lg-4"> {{-- Cambié a col-lg-4 para que 3 productos queden centrados --}}
            <div class="card h-100 border-0 shadow-sm card-producto">
                <img src="{{ asset('imagenes/' . $item['img']) }}" class="card-img-top p-2 rounded-4" alt="{{ $item['nombre'] }}">
                <div class="card-body text-center">
                    <h5 class="card-title color-primario">{{ $item['nombre'] }}</h5>
                    <p class="card-text text-muted small">{{ $item['desc'] }}</p>
                    <p class="fw-bold fs-5 color-primario">${{ number_format($item['precio'], 0, ',', '.') }}</p>
                    <a href="#" class="btn btn-volver-legal w-100" style="background-color: #5d4d7a; color: white; border: none;">
                        Añadir al carrito
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection