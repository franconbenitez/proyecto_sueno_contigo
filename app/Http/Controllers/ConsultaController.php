<?php

namespace App\Http\Controllers;

use App\Models\Consulta;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::latest()->get();

        return view(
            'backend.consultas.index',
            compact('consultas')
        );
    }
}