<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')
            ->withTrashed()
            ->get();

        return view(
            'backend.productos.index',
            compact('productos')
        );
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view(
            'backend.productos.create',
            compact('categorias')
        );
    }

    public function store(ProductoRequest $request)
    {
        $rutaImagen = null;

        if ($request->hasFile('imagen')) {

            $rutaImagen = $request->file('imagen')
                ->store('productos', 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'url_imagen' => $rutaImagen,
            'activo' => true
        ]);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);

        $categorias = Categoria::all();

        return view(
            'backend.productos.edit',
            compact('producto', 'categorias')
        );
    }

    public function update(ProductoRequest $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        if ($request->hasFile('imagen')) {

            // Borra la imagen anterior
            if ($producto->url_imagen &&
                Storage::disk('public')->exists($producto->url_imagen)) {

                Storage::disk('public')->delete($producto->url_imagen);
            }

            // Guarda la nueva
            $rutaImagen = $request->file('imagen')
                                ->store('productos', 'public');

            $producto->url_imagen = $rutaImagen;
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;

        $producto->save();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }

    public function restore(string $id)
    {
        $producto = Producto::withTrashed()
            ->findOrFail($id);

        $producto->restore();

        return redirect()
            ->route('productos.index')
            ->with(
                'success',
                'Producto restaurado correctamente'
            );
    }
}