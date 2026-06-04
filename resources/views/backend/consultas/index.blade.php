@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container-fluid">

    <h2 class="mb-4">
        Consultas Recibidas
    </h2>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Pedido</th>
                    <th>Tipo</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>

            <tbody>

                @forelse($consultas as $consulta)

                    <tr>

                        <td>{{ $consulta->id }}</td>

                        <td>{{ $consulta->nombre }}</td>

                        <td>{{ $consulta->email }}</td>

                        <td>{{ $consulta->pedido }}</td>

                        <td>{{ $consulta->tipo_consulta }}</td>

                        <td>{{ $consulta->mensaje }}</td>

                        <td>
                            {{ $consulta->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            No hay consultas registradas.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection