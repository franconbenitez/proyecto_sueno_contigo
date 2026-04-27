<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    /**
     * Simula la base de datos de Sueño Contigo.
     * Centralizamos aquí los datos para que el ID coincida en todas las vistas.
     */
    private function obtenerDatos()
    {
        return [
            'pijamas' => [
                ['id' => 1, 'nombre' => 'Pijama Satin Rose', 'precio' => 15500, 'desc' => 'Seda premium con detalles de encaje.', 'img' => 'pijama1.jpeg'],
                ['id' => 2, 'nombre' => 'Conjunto Sweet Dream', 'precio' => 12300, 'desc' => 'Algodón soft ideal para el descanso.', 'img' => 'pijama2.jpeg'],
                ['id' => 3, 'nombre' => 'Pijama Night Blue', 'precio' => 14200, 'desc' => 'Dos piezas en satén azul noche.', 'img' => 'pijama3.jpeg'],
            ],
            'batas' => [
                ['id' => 4, 'nombre' => 'Bata Seda Velvet', 'precio' => 18000, 'desc' => 'Elegancia pura para tus mañanas.', 'img' => 'bata1.jpeg'],
                ['id' => 5, 'nombre' => 'Bata Algodón Spa', 'precio' => 12000, 'desc' => 'Súper absorbente y tacto suave.', 'img' => 'bata2.jpeg'],
                ['id' => 6, 'nombre' => 'Kimono Floral', 'precio' => 15000, 'desc' => 'Diseño exclusivo de seda estampada.', 'img' => 'bata3.jpeg'],
            ],
            'pantuflas' => [
                ['id' => 7, 'nombre' => 'Pantuflas Cloud', 'precio' => 5500, 'desc' => 'Sentite en las nubes a cada paso.', 'img' => 'pantuflas1.jpeg'],
                ['id' => 8, 'nombre' => 'Pantuflas Rabbit', 'precio' => 6200, 'desc' => 'Diseño tierno, abrigado y confortable.', 'img' => 'pantuflas2.jpeg'],
                ['id' => 9, 'nombre' => 'Slide Relax', 'precio' => 4800, 'desc' => 'Ideales para descansar después del baño.', 'img' => 'pantuflas3.jpeg'],
            ],
            'lenceria' => [
                ['id' => 10, 'nombre' => 'Conjunto Encaje Red', 'precio' => 9500, 'desc' => 'Detalles finos para momentos especiales.', 'img' => 'lenceria1.jpeg'],
                ['id' => 11, 'nombre' => 'Body Night', 'precio' => 11000, 'desc' => 'Ajuste perfecto y diseño sensual.', 'img' => 'lenceria2.jpeg'],
                ['id' => 12, 'nombre' => 'Bralette Soft', 'precio' => 7500, 'desc' => 'Comodidad total sin aros.', 'img' => 'lenceria3.jpeg'],
            ],
        ];
    }

    // Muestra una categoría específica o todos los productos
    public function mostrarCategoria($categoria)
    {
        $todosLosProductos = $this->obtenerDatos();

        if ($categoria == 'productos') {
            $productos = [];
            foreach ($todosLosProductos as $subcategoria) {
                $productos = array_merge($productos, $subcategoria);
            }
            $titulo = "Todos los Productos";
        } else {
            if (!array_key_exists($categoria, $todosLosProductos)) {
                abort(404);
            }
            $productos = $todosLosProductos[$categoria];
            $titulo = ucfirst($categoria);
        }

        return view('catalogo', compact('productos', 'titulo'));
    }

    // Muestra el detalle de un producto individual por su ID
    public function detalle($id)
    {
        $categorias = $this->obtenerDatos();
        $productoEncontrado = null;

        // Buscamos el producto con ese ID recorriendo todas las categorías
        foreach ($categorias as $productos) {
            foreach ($productos as $p) {
                if ($p['id'] == $id) {
                    $productoEncontrado = $p;
                    break 2;
                }
            }
        }

        if (!$productoEncontrado) {
            abort(404);
        }

        return view('producto_detalle', ['producto' => $productoEncontrado]);
    }
}