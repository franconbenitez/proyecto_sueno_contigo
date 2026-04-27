@extends('layouts.plantilla')
@section('contenido')

<section class="seccion-auth d-flex align-items-center justify-content-center py-5">
    <div class="container text-center">
        <div class="card-auth mx-auto" style="max-width: 500px;">
            <span style="font-size: 3rem;">💖</span>
            <h1 class="auth-titulo mt-3">¡Mensaje enviado!</h1>
            <p class="texto-quienes mt-2">
                Hola <strong>{{ $nombre }}</strong>, recibimos tu consulta.
                Te responderemos a la brevedad al correo
                <strong>{{ $email }}</strong>.
            </p>
            <a href="/" class="btn btn-hero mt-3">Volver al inicio</a>
        </div>
    </div>
</section>

@endsection