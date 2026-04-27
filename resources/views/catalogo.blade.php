@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-5">
    {{-- Título dinámico que cambia según la categoría --}}
    <h1 class="titulo-legal text-center mb-5" style="font-family: 'Cormorant Garamond', serif; font-weight: 600; color: #5d4d7a;">
        {{ $titulo }}
    </h1>

    <div class="row g-4">
        @foreach($productos as $item)
        <div class="col-12 col-sm-6 col-lg-4">
            {{-- El enlace envuelve a la card para que sea toda clickeable --}}
            <a href="/producto/{{ $item['id'] }}" class="text-decoration-none h-100 d-block">
                <div class="card h-100 border-0 shadow-sm card-producto">
                    
                    {{-- Imagen del producto --}}
                    <div class="p-2">
                        <img src="{{ asset('imagenes/' . $item['img']) }}" 
                             class="card-img-top rounded-4" 
                             alt="{{ $item['nombre'] }}"
                             style="height: 300px; object-fit: cover;">
                    </div>

                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title color-primario fw-bold">{{ $item['nombre'] }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $item['desc'] }}</p>
                        
                        {{-- Precio con formato de moneda --}}
                        <p class="fw-bold fs-4 mt-2 mb-3" style="color: #5d4d7a;">
                            ${{ number_format($item['precio'], 0, ',', '.') }}
                        </p>

                        {{-- Botón visual (el link real es el que envuelve la card) --}}
                        <div class="btn btn-volver-legal w-100" style="background-color: #5d4d7a; color: white; border: none; border-radius: 20px;">
                            Ver detalle / Comprar
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

{{-- Espaciado final para que no quede pegado al footer --}}
<div class="py-5"></div>
@endsection