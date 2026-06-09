@extends('layouts.plantilla')

@section('contenido')

<div class="container mt-5 pt-5">

    <h2 class="mb-4">Gestionar Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input
                type="text"
                name="nombre"
                class="form-control"
                value="{{ Auth::user()->nombre }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ Auth::user()->email }}">
        </div>

        <button class="btn btn-primary">
            Guardar Cambios
        </button>

    </form>

</div>

@endsection