@extends('layouts.plantilla')

@section('contenido')
<div class="container container-legal mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="titulo-legal text-center mb-5">✨ Información General</h1>

            <div class="card-legal shadow-sm p-4 mb-5">

                {{-- Guía de Talles --}}
                <div class="seccion-legal mb-5">
                    <h4><i class="bi bi-rulers me-2"></i> 📏 Guía de talles</h4>
                    <p class="texto-legal">Consultá nuestra tabla de medidas para elegir tu talle ideal:</p>

                    <div class="table-responsive">
                        <table class="table table-hover tabla-talles">
                            <thead>
                                <tr>
                                    <th>Talle</th>
                                    <th>S (1)</th>
                                    <th>M (2)</th>
                                    <th>L (3)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Busto (cm)</td>
                                    <td>85-90</td>
                                    <td>90-95</td>
                                    <td>95-100</td>
                                </tr>
                                <tr>
                                    <td>Cadera (cm)</td>
                                    <td>88-94</td>
                                    <td>94-100</td>
                                    <td>100-106</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Cuidado de Prendas --}}
                <div class="seccion-legal mb-0">
                    <h4><i class="bi bi-stars me-2"></i> 🧼 Cuidado de prendas</h4>
                    <p class="texto-legal">Para que tus conjuntos de <strong>Sueño Contigo</strong> duren más, te recomendamos:</p>
                    <ul class="list-unstyled ms-3">
                        <li class="mb-2 texto-legal"><i class="bi bi-check2-circle me-2 color-primario"></i> Lavar siempre con agua fría.</li>
                        <li class="mb-2 texto-legal"><i class="bi bi-check2-circle me-2 color-primario"></i> No utilizar secadora.</li>
                        <li class="mb-2 texto-legal"><i class="bi bi-check2-circle me-2 color-primario"></i> No planchar directamente sobre el encaje o telas delicadas.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection