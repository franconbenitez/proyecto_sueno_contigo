@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <img src="{{ asset('imagenes/' . $producto['img']) }}" class="img-fluid rounded-4 shadow-sm" style="width: 100%; height: 500px; object-fit: cover;">
        </div>

        <div class="col-md-5">
            <h1 class="color-primario mb-3">{{ $producto['nombre'] }}</h1>
            <h2 class="fw-bold mb-4" style="color: #5d4d7a;">${{ number_format($producto['precio'], 0, ',', '.') }}</h2>
            <p class="text-muted mb-4">{{ $producto['desc'] }}</p>

            <form action="{{ route('carrito.agregar') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $producto['id'] }}">
                <input type="hidden" name="nombre" value="{{ $producto['nombre'] }}">
                <input type="hidden" name="precio" value="{{ $producto['precio'] }}">
                <input type="hidden" name="img" value="{{ $producto['img'] }}">

                <div class="mb-4">
                    <label class="form-label fw-bold color-primario">Elegí tu talle:</label>
                    <div class="d-flex gap-2">
                        <input type="radio" class="btn-check" name="talle" id="talleS" value="S" required>
                        <label class="btn btn-outline-secondary px-4 py-2" for="talleS">S</label>

                        <input type="radio" class="btn-check" name="talle" id="talleM" value="M">
                        <label class="btn btn-outline-secondary px-4 py-2" for="talleM">M</label>

                        <input type="radio" class="btn-check" name="talle" id="talleL" value="L">
                        <label class="btn btn-outline-secondary px-4 py-2" for="talleL">L</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg w-100 mb-3 text-white" style="background-color: #5d4d7a; border-radius: 25px;">
                    <i class="bi bi-cart-plus"></i> Añadir al Carrito
                </button>
            </form>
            
            <a href="https://wa.me/543795340652" class="btn btn-outline-success w-100" style="border-radius: 25px;">
                <i class="bi bi-whatsapp"></i> Consultar por WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection