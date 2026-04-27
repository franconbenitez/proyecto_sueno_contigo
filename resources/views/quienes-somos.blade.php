@extends('layouts.plantilla')
@section('contenido')


{{-- SECCIÓN 1: BANNER DE PÁGINA --}}
<section class="banner-pagina text-center py-5">
    <div class="container">
        <h1 class="titulo-pagina">Quiénes Somos</h1>
        <p class="subtitulo-pagina">El corazón detrás de Sueño Contigo </p>
    </div>
</section>


{{-- SECCIÓN 2: PRESENTACIÓN DE LA MARCA --}}
{{-- CORREGIDO: quitada la columna de imagen que quedaba vacía, ahora el texto ocupa el ancho completo --}}
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h2 class="titulo-seccion mb-3">Nuestra historia</h2>
                <p class="texto-quienes">
                    <strong>Sueño Contigo</strong> es un emprendimiento familiar nacido con el objetivo
                    de ofrecer prendas cómodas, lindas y pensadas para el día a día.
                </p>
                <p class="texto-quienes">
                    Creemos que sentirse bien en casa también es importante, y que la comodidad
                    no está peleada con verse bien.
                </p>
                <p class="texto-quienes">
                    Detrás de este proyecto estamos <strong>Sol, Diana y Eva</strong>, quienes trabajamos
                    juntas buscando llegar a cada persona que valore el descanso y el confort.
                </p>
            </div>
        </div>
    </div>
</section>


{{-- SECCIÓN 3: NUESTRA ESENCIA --}}
<section class="py-5 seccion-esencia text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <span class="icono-esencia">🐱</span>
                <h2 class="titulo-seccion mt-3 mb-3">Nuestra esencia</h2>
                <p class="texto-quienes">
                    El logo, representado por un gato, refleja la esencia del proyecto:
                    <strong>comodidad, calma y amor por los pequeños placeres de la vida</strong>,
                    como estar en pijamas.
                </p>
                <p class="frase-central mt-4">
                    "Porque cada momento en casa merece sentirse especial "
                </p>
            </div>
        </div>
    </div>
</section>


{{-- SECCIÓN 4: VALORES --}}
<section class="py-5">
    <div class="container">

        <h2 class="titulo-seccion text-center mb-5">Nuestros valores</h2>

        <div class="row g-4 justify-content-center text-center">

            <div class="col-12 col-md-4">
                <div class="card card-valor h-100 p-4">
                    <span class="icono-valor">🤍</span>
                    <h5 class="mt-3 mb-2">Comodidad</h5>
                    <p class="text-muted">Cada prenda está pensada para que tu cuerpo y mente descansen.</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-valor h-100 p-4">
                    <span class="icono-valor">🌸</span>
                    <h5 class="mt-3 mb-2">Calidad</h5>
                    <p class="text-muted">Seleccionamos materiales suaves y duraderos para que duren mucho tiempo.</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-valor h-100 p-4">
                    <span class="icono-valor">💕</span>
                    <h5 class="mt-3 mb-2">Amor familiar</h5>
                    <p class="text-muted">Somos un emprendimiento familiar, hecho con dedicación y cariño.</p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- SECCIÓN 5: EL EQUIPO --}}
<section class="py-5 seccion-equipo">
    <div class="container">

        <h2 class="titulo-seccion text-center mb-5">Nuestro equipo </h2>

        <div class="row g-4 justify-content-center text-center">

            <div class="col-12 col-md-4">
                <div class="card card-equipo h-100 p-4">
                    <div class="avatar-equipo mx-auto mb-3">S</div>
                    <h5 class="nombre-equipo">Sol</h5>
                    <p class="rol-equipo">Diseño & Creatividad</p>
                    <p class="text-muted">La mente creativa detrás de cada diseño y colección nueva.</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-equipo h-100 p-4">
                    <div class="avatar-equipo mx-auto mb-3">D</div>
                    <h5 class="nombre-equipo">Diana</h5>
                    <p class="rol-equipo">Producción & Calidad</p>
                    <p class="text-muted">Se asegura de que cada prenda cumpla con los más altos estándares.</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-equipo h-100 p-4">
                    <div class="avatar-equipo mx-auto mb-3">E</div>
                    <h5 class="nombre-equipo">Eva</h5>
                    <p class="rol-equipo">Ventas & Atención al cliente</p>
                    <p class="text-muted">Siempre lista para ayudarte y que tu experiencia sea la mejor.</p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- SECCIÓN 6: LLAMADO A LA ACCIÓN --}}
<section class="py-5 text-center seccion-cta">
    <div class="container">
        <h2 class="titulo-seccion mb-3">¿Querés conocer nuestros productos?</h2>
        <p class="texto-quienes mb-4">Entrá al catálogo y encontrá la prenda perfecta para vos.</p>
        {{-- CORREGIDO: lleva a /catalogo/productos --}}
        <a href="/catalogo/productos" class="btn btn-hero me-2">Ver catálogo</a>
        <a href="/contacto" class="btn btn-catalogo">Contactarnos</a>
    </div>
</section>

@endsection