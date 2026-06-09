@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container-fluid">

    <h1 class="admin-titulo">
        Dashboard Administrador
    </h1>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Productos Totales</h6>
                <h2>{{ $totalProductos }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Productos Activos</h6>
                <h2 class="numero-activo">
                    {{ $productosActivos }}
                </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Productos Eliminados</h6>
                <h2 class="numero-eliminado">
                    {{ $productosEliminados }}
                </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Usuarios Registrados</h6>
                <h2 class="numero-usuarios">
                    {{ $usuariosRegistrados }}
                </h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Consultas Recibidas</h6>
                <h2>{{ $consultasTotales }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Pedidos Totales</h6>
                <h2>{{ $pedidosTotales }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Pedidos Pendientes</h6>
                <h2>{{ $pedidosPendientes }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-dashboard">
                <h6>Ventas Totales</h6>
                <h2>${{ number_format($ventasTotales, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection