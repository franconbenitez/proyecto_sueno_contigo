@extends('layouts.plantilla')

@section('contenido')

<div class="container mt-5 pt-5">

    <h2 class="mb-4">Mis Pedidos</h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>N° Pedido</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>

        @forelse($pedidos as $pedido)

            <tr>
                <td>{{ $pedido->numero_pedido }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>${{ number_format($pedido->total,0,',','.') }}</td>
                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
            </tr>

        @empty

            <tr>
                <td colspan="4" class="text-center">
                    Todavía no realizaste compras.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection