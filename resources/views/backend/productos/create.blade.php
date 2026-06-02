@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container">

    <h2 class="mb-4">Agregar Producto</h2>

    <form action="{{ route('productos.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre</label>

            <input type="text"
                   name="nombre"
                   class="form-control"
                   value="{{ old('nombre') }}">

            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>

            <textarea name="descripcion"
                      class="form-control"
                      rows="4">{{ old('descripcion') }}</textarea>

            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>

            <input type="number"
                   step="0.01"
                   name="precio"
                   class="form-control"
                   value="{{ old('precio') }}">

            @error('precio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>

            <input type="number"
                   name="stock"
                   class="form-control"
                   value="{{ old('stock') }}">

            @error('stock')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>

            <select name="categoria_id"
                    class="form-select">

                <option value="">
                    Seleccionar una opción
                </option>

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                        {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>

                        {{ $categoria->nombre }}

                    </option>

                @endforeach

            </select>

            @error('categoria_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Imagen</label>

            <input type="file"
                   name="imagen"
                   class="form-control">

            @error('imagen')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-success">
            Guardar Producto
        </button>

        <a href="{{ route('productos.index') }}"
           class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>

@endsection