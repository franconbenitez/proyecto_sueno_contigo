@extends('layouts.plantilla_admin')

@section('contenido_admin')

<div class="container">

    <h2 class="mb-4">
        Crear Administrador
    </h2>

    <form action="{{ route('usuarios.store') }}"
          method="POST">

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
            <label class="form-label">Apellido</label>

            <input type="text"
                   name="apellido"
                   class="form-control"
                   value="{{ old('apellido') }}">

            @error('apellido')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}">

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>

            <input type="password"
                   name="password"
                   class="form-control">

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">
                Confirmar Contraseña
            </label>

            <input type="password"
                   name="password_confirmation"
                   class="form-control">
        </div>

        <button class="btn btn-success">
            Crear Administrador
        </button>

        <a href="{{ route('usuarios.index') }}"
           class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>

@endsection