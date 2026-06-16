<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

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

    // Función para alternar entre Leído y No Leído
    public function toggleLeido(string $id)
    {
        $consulta = Consulta::findOrFail($id);
        
        // Cambia el estado al contrario del actual (si es true pasa a false, y viceversa)
        $consulta->leido = !$consulta->leido;
        $consulta->save();

        return redirect()->back()->with('success', 'Estado de la consulta actualizado.');
    }

    // Función para guardar la respuesta
    public function responder(Request $request, string $id)
    {
        $request->validate([
            'respuesta' => 'required|string|min:5'
        ], [
            'respuesta.required' => 'Debes escribir un mensaje de respuesta.'
        ]);

        $consulta = Consulta::findOrFail($id);
        
        $consulta->respuesta = $request->respuesta;
        $consulta->leido = true; // Si la respondemos, automáticamente pasa a leída
        $consulta->save();

        // ACÁ IRÍA LA LÓGICA DEL EMAIL (Ejemplo)
        // Mail::to($consulta->email)->send(new RespuestaConsultaMail($consulta));

        return redirect()->back()->with('success', 'Respuesta guardada correctamente.');
    }
}