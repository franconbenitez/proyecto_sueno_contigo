@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container">

    <h2 class="mb-4">
        Editar Producto
    </h2>

    <form action="{{ route('productos.update', $producto->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label class="form-label">
                Nombre
            </label>

            <input type="text"
                   name="nombre"
                   class="form-control"
                   value="{{ old('nombre', $producto->nombre) }}">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Descripción
            </label>

            <textarea name="descripcion"
                      class="form-control"
                      rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Precio
            </label>

            <input type="number"
                   step="0.01"
                   name="precio"
                   class="form-control"
                   value="{{ old('precio', $producto->precio) }}">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Stock
            </label>

            <input type="number"
                   name="stock"
                   class="form-control"
                   value="{{ old('stock', $producto->stock) }}">

        </div>

        <div class="mb-3">

            <label class="form-label">
                Categoría
            </label>

            <select name="categoria_id"
                    class="form-select">

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>

                        {{ $categoria->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Imagen actual
            </label>

            <br>

            @if($producto->url_imagen)

                <img
                    src="{{ asset('storage/' . $producto->url_imagen) }}"
                    width="120"
                    class="img-thumbnail">

            @endif

        </div>

        <div class="mb-4">

            <label class="form-label">
                Nueva imagen (opcional)
            </label>

            <input type="file"
                   name="imagen"
                   class="form-control">

        </div>

        <button class="btn btn-success">
            Guardar Cambios
        </button>

        <a href="{{ route('productos.index') }}"
           class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection