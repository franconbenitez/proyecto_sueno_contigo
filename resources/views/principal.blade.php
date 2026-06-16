@extends('layouts.plantilla')
@section('contenido')


{{-- SECCIÓN 1: BANNER PRINCIPAL (HERO) --}}
<section class="banner-hero d-flex align-items-center justify-content-center text-center">
    <div class="container">

        <img src="{{ asset('imagenes/logo.png') }}"
             alt="Logo Sueño Contigo"
             class="logo-hero mb-3"
             onerror="this.style.display='none'">

        <h1 class="titulo-hero">Sueño Contigo</h1>
        <p class="subtitulo-hero">Pijamas & Lencería</p>
        <p class="frase-hero">Dormir nunca se sintió tan lindo</p>

        {{-- CORREGIDO: lleva a /catalogo/productos --}}
        <a href="/catalogo/productos" class="btn btn-hero mt-3">Ver catálogo</a>

    </div>
</section>


{{-- SECCIÓN 2: MINI TEXTO --}}
<section class="mini-texto text-center py-5">
    <div class="container">
        <p class="frase-central">
            "Creamos prendas pensadas para que te sientas cómoda, segura y hermosa"
        </p>
    </div>
</section>


{{-- SECCIÓN 3: CARRUSEL DE FOTOS --}}
<section class="py-4">
    <div class="container">
        <div id="carruselPrincipal" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carruselPrincipal"
                        data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carruselPrincipal"
                        data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carruselPrincipal"
                        data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner rounded-4">
                <div class="carousel-item active">
                    <img src="{{ asset('imagenes/carrusel1.jpg') }}"
                         class="d-block w-100 imagen-carrusel" alt="Foto 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imagenes/carrusel2.jpg') }}"
                         class="d-block w-100 imagen-carrusel" alt="Foto 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imagenes/carrusel3.jpg') }}"
                         class="d-block w-100 imagen-carrusel" alt="Foto 3">
                </div>
            </div>

            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carruselPrincipal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-bs-target="#carruselPrincipal" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    </div>
</section>


{{-- SECCIÓN 4: NUEVA COLECCIÓN --}}
<section class="py-5 seccion-coleccion">
    <div class="container">

        <h2 class="titulo-seccion text-center mb-4">Nueva Colección</h2>

        <div class="row g-4 justify-content-center">

            {{-- Bucle dinámico de los últimos 3 productos --}}
            @forelse($nuevaColeccion as $productoNuevo)
                <div class="col-12 col-md-4">
                    <div class="card card-producto h-100 text-center shadow-sm">
                        
                        <img src="{{ asset('storage/' . $productoNuevo->url_imagen) }}"
                             class="card-img-top imagen-producto" 
                             alt="{{ $productoNuevo->nombre }}"
                             style="object-fit: cover; height: 300px;">
                             
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $productoNuevo->nombre }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($productoNuevo->descripcion, 35) }}</p>
                            <p class="precio mb-3">${{ number_format($productoNuevo->precio, 2, ',', '.') }}</p>
                            
                            {{-- Agregamos el botón de Comprar Directo para no perder la venta impulsiva --}}
                            <form action="/carrito/agregar" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="id" value="{{ $productoNuevo->id }}">
                                <button type="submit" class="btn text-white w-100" style="background-color: #5d4d7a; border-radius: 8px;">
                                    <i class="bi bi-cart-plus me-1"></i> Comprar
                                </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    <p>¡Pronto subiremos cosas nuevas y hermosas!</p>
                </div>
            @endforelse

        </div>
    </div>
</section>


{{-- SECCIÓN 5: MÁS VENDIDOS --}}
<section class="py-5 seccion-vendidos">
    <div class="container">

        <h2 class="titulo-seccion text-center mb-4">Más Vendidos</h2>

        <div class="row g-4 justify-content-center">

            {{-- Bucle dinámico del Top 3 --}}
            @forelse($masVendidos as $producto)
                <div class="col-12 col-md-4">
                    <div class="card card-producto h-100 text-center">
                        {{-- Usamos 'storage/' como me indicaste en tu resumen de arreglos --}}
                        <img src="{{ asset('storage/' . $producto->url_imagen) }}"
                             class="card-img-top imagen-producto" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            {{-- Str::limit corta la descripción si es muy larga para no deformar la tarjeta --}}
                            <p class="card-text text-muted">{{ Str::limit($producto->descripcion, 35) }}</p>
                            <p class="precio">${{ number_format($producto->precio, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Por si la base de datos está vacía o no hay ventas todavía --}}
                <div class="col-12 text-center text-muted py-4">
                    <p>¡Pronto verás nuestros productos estrella aquí!</p>
                </div>
            @endforelse

        </div>
    </div>
</section>


{{-- SECCIÓN 6: CATEGORÍAS --}}
<div class="container my-5">
    <h2 class="titulo-seccion text-center mb-4">Categorías</h2>
    <div class="row g-4 text-center">

        <div class="col-6 col-md-3">
            <a href="/catalogo/pijamas" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm p-4 card-categoria-home">
                    <p class="mb-0 color-primario">Pijamas</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="/catalogo/lenceria" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm p-4 card-categoria-home">
                    <p class="mb-0 color-primario">Lencería</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="/catalogo/batas" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm p-4 card-categoria-home">
                    <p class="mb-0 color-primario">Batas</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="/catalogo/pantuflas" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm p-4 card-categoria-home">
                    <p class="mb-0 color-primario">Pantuflas</p>
                </div>
            </a>
        </div>

    </div>
</div>

{{-- SECCIÓN 7: PROMOCIONES --}}
<section class="py-5 seccion-promociones">
    <div class="container text-center">
        <h2 class="titulo-seccion mb-4">Promociones</h2>
        <div class="rounded-4 shadow overflow-hidden d-inline-block">
            {{-- Mostramos solo el banner del 10% --}}
            <img src="{{ asset('imagenes/promo1.png') }}" class="img-fluid" alt="10% de descuento en tu primera compra" style="max-height: 400px; width: auto;">
        </div>
    </div>
</section>

@endsection