@extends('layouts.plantilla')
@section('contenido')


{{-- SECCIÓN 1: BANNER DE PÁGINA --}}
<section class="banner-pagina text-center py-5">
    <div class="container">
        <h1 class="titulo-pagina">Comercialización</h1>
        <p class="subtitulo-pagina">Todo lo que necesitás saber para tu compra 🛍️</p>
    </div>
</section>


{{-- SECCIÓN 2: ENVÍOS --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-12 col-md-5 text-center">
                <span style="font-size: 6rem;">📦</span>
            </div>

            <div class="col-12 col-md-7">
                <h2 class="titulo-seccion mb-3">Envíos</h2>
                <p class="texto-quienes">
                    Realizamos envíos a toda la
                    <strong>provincia de Corrientes</strong>.
                </p>
                <p class="texto-quienes">
                    Ofrecemos entregas en el <strong>mismo día</strong> según disponibilidad,
                    o bien podés coordinar el <strong>retiro por domicilio</strong> en el
                    horario que más te convenga.
                </p>
            </div>

        </div>
    </div>
</section>


{{-- SECCIÓN 3: FORMAS DE PAGO --}}
<section class="py-5 seccion-esencia">
    <div class="container">

        <h2 class="titulo-seccion text-center mb-5">Formas de pago</h2>

        <div class="row g-4 justify-content-center text-center">

            <div class="col-12 col-md-4">
                <div class="card card-valor h-100 p-4">
                    <span class="icono-valor">🏦</span>
                    <h5 class="mt-3 mb-2">Transferencia bancaria</h5>
                    <p class="text-muted">
                        Realizá tu pago por transferencia y envianos el comprobante
                        por WhatsApp para confirmar tu pedido.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-valor h-100 p-4">
                    <span class="icono-valor">💙</span>
                    <h5 class="mt-3 mb-2">Mercado Pago</h5>
                    <p class="text-muted">
                        Aceptamos pagos a través de Mercado Pago,
                        con o sin tarjeta de crédito.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-valor h-100 p-4">
                    <span class="icono-valor">💳</span>
                    <h5 class="mt-3 mb-2">Tarjetas</h5>
                    <p class="text-muted">
                        Aceptamos todas las tarjetas de débito y crédito
                        a través de las plataformas disponibles.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- SECCIÓN 4: CAMBIOS Y DEVOLUCIONES --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-12 col-md-7">
                <h2 class="titulo-seccion mb-3">Cambios y devoluciones</h2>
                <p class="texto-quienes">
                    No contamos con local físico para prueba de prendas,
                    pero entendemos que a veces los talles pueden no ser exactos.
                </p>
                <p class="texto-quienes">
                    Por eso ofrecemos <strong>cambios dentro de los 7 días</strong>
                    en caso de inconvenientes con el talle o
                    <strong>fallas de fábrica</strong>.
                </p>
                <p class="texto-quienes">
                    Para gestionar un cambio, comunicate con nosotras por WhatsApp
                    o por el formulario de contacto con tu número de pedido.
                </p>
            </div>

            <div class="col-12 col-md-5 text-center">
                <span style="font-size: 6rem;">🔄</span>
            </div>

        </div>
    </div>
</section>


{{-- SECCIÓN 5: INFORMACIÓN ADICIONAL --}}
<section class="py-5 seccion-esencia">
    <div class="container">

        <h2 class="titulo-seccion text-center mb-5">Preguntas frecuentes</h2>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">

                {{-- Acordeón de preguntas --}}
                <div class="accordion" id="acordeonFaq">

                    <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                ¿Cuánto tarda en llegar mi pedido?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse"
                             data-bs-parent="#acordeonFaq">
                            <div class="accordion-body text-muted">
                                Según la disponibilidad del producto, podemos entregar
                                el mismo día del pedido. En otros casos coordinamos
                                la entrega dentro de las 48 horas.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                ¿Puedo probarme las prendas antes de comprar?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse"
                             data-bs-parent="#acordeonFaq">
                            <div class="accordion-body text-muted">
                                No contamos con local físico, pero podés consultarnos
                                sobre medidas y talles antes de realizar tu compra.
                                Estamos para ayudarte a elegir la opción correcta.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                ¿Cómo inicio un cambio o devolución?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse"
                             data-bs-parent="#acordeonFaq">
                            <div class="accordion-body text-muted">
                                Comunicate con nosotras dentro de los 7 días de
                                recibido el pedido por WhatsApp o por nuestro
                                formulario de contacto, indicando el motivo y
                                tu número de pedido.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                ¿Realizan envíos fuera de Corrientes?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse"
                             data-bs-parent="#acordeonFaq">
                            <div class="accordion-body text-muted">
                                Por el momento solo realizamos envíos dentro de la
                                provincia de Corrientes. Si estás en otra provincia
                                podés consultarnos y evaluamos la posibilidad.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



@endsection