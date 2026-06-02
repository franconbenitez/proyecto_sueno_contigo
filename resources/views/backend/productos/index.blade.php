@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestión de Productos</h2>

        <a href="{{ route('productos.create') }}"
           class="btn btn-success">
            <i class="bi bi-plus-circle"></i>
            Agregar Producto
        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($productos as $producto)

                    <tr>

                        <td>{{ $producto->id }}</td>

                        <td>

                            @if($producto->url_imagen)

                                <img
                                src="{{ asset('storage/' . $producto->url_imagen) }}"
                                width="60"
                                class="img-thumbnail">

                            @else

                                Sin imagen

                            @endif

                        </td>

                        <td>{{ $producto->nombre }}</td>

                        <td>${{ $producto->precio }}</td>

                        <td>{{ $producto->stock }}</td>

                        <td>
                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                        </td>

                        <td>

                            @if($producto->deleted_at)

                                <span class="badge bg-danger">
                                    Eliminado
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Activo
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('productos.edit', $producto->id) }}"
                            class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            @if(!$producto->deleted_at)

                                <form
                                    action="{{ route('productos.destroy', $producto->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar producto?')">

                                        Eliminar

                                    </button>

                                </form>

                            @else

                                <form
                                    action="{{ route('productos.restore', $producto->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PUT')

                                    <button
                                        class="btn btn-success btn-sm">

                                        Restaurar

                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center">
                            No hay productos cargados
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection