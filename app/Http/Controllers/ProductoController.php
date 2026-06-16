<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
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

    // Cambiamos ProductoRequest por Request estándar para validar acá mismo
    public function store(Request $request)
    {
        // 1. VALIDACIONES AL CREAR UN PRODUCTO NUEVO
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string', // Nullable significa que no es obligatorio
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Imagen obligatoria
        ], [
            // MENSAJES DE ERROR PERSONALIZADOS EN ESPAÑOL
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'Debes ingresar el precio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'stock.required' => 'Debes indicar la cantidad en stock.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'imagen.required' => 'Subir una foto del producto es obligatorio.',
            'imagen.image' => 'El archivo debe ser una imagen válida (jpg, png, webp).',
            'imagen.max' => 'La imagen es demasiado pesada (Máximo 2MB).'
        ]);

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

    // Cambiamos ProductoRequest por Request estándar
    public function update(Request $request, string $id)
    {
        // 2. VALIDACIONES AL EDITAR
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            // La imagen acá es NULLABLE (opcional), por si no quiere cambiarla
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'Debes ingresar el precio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'stock.required' => 'Debes indicar la cantidad en stock.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'imagen.image' => 'El archivo debe ser una imagen válida (jpg, png, webp).',
            'imagen.max' => 'La imagen es demasiado pesada (Máximo 2MB).'
        ]);

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