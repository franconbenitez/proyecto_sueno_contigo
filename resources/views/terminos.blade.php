@extends('layouts.plantilla')

@section('contenido')
<div class="container container-legal mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="titulo-legal text-center mb-5">🧾 Términos y Condiciones</h1>

            <div class="card-legal shadow-sm p-4">

                <div class="seccion-legal mb-4">
                    <h4><i class="bi bi-arrow-left-right me-2"></i> Cambios</h4>
                    <p class="texto-legal">
                        Se aceptan cambios dentro de los 7 días posteriores a la compra,
                        únicamente por fallas de fábrica o problemas de talle.
                        El producto debe encontrarse en perfecto estado.
                    </p>
                </div>

                <div class="seccion-legal mb-4">
                    <h4><i class="bi bi-cash-stack me-2"></i> Devoluciones</h4>
                    <p class="texto-legal">
                        No realizamos devoluciones de dinero. Los productos pueden cambiarse
                        por otro modelo o talle disponible.
                    </p>
                </div>

                <div class="seccion-legal mb-4">
                    <h4><i class="bi bi-shield-lock me-2"></i> Privacidad</h4>
                    <p class="texto-legal">
                        Los datos personales proporcionados serán utilizados únicamente para
                        gestionar compras y consultas, y no serán compartidos con terceros.
                    </p>
                </div>

                <div class="seccion-legal mb-0">
                    <h4><i class="bi bi-info-circle me-2"></i> Uso del sitio</h4>
                    <p class="texto-legal">
                        El uso de este sitio es únicamente informativo. Los productos exhibidos
                        pueden estar sujetos a disponibilidad.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection