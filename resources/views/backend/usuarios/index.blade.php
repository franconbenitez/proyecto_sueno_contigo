@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Gestión de Usuarios
        </h2>

        <a href="{{ route('usuarios.create') }}"
        class="btn btn-success">

            <i class="bi bi-plus-circle"></i>
            Agregar Administrador

        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

                @forelse($usuarios as $usuario)

                    <tr>

                        <td>
                            {{ $usuario->id }}
                        </td>

                        <td>
                            {{ $usuario->nombre }}
                            {{ $usuario->apellido }}
                        </td>

                        <td>
                            {{ $usuario->email }}
                        </td>

                        <td>

                            @if($usuario->perfil_id == 1)

                                <span class="badge bg-danger">
                                    Administrador
                                </span>

                            @else

                                <span class="badge bg-primary">
                                    Cliente
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($usuario->activo)

                                <span class="badge bg-success">
                                    Activo
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactivo
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No hay usuarios registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection