<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr; // Importante para manejar los arrays

class CatalogoController extends Controller
{
    public function mostrarCategoria($categoria)
    {
        $todosLosProductos = [
            'pijamas' => [
                ['nombre' => 'Pijama Satin Rose', 'precio' => 15500, 'desc' => 'Seda premium.', 'img' => 'pijama1.jpeg'],
                ['nombre' => 'Conjunto Sweet Dream', 'precio' => 12300, 'desc' => 'Algodón soft.', 'img' => 'pijama2.jpeg'],
                ['nombre' => 'Pijama Night Blue', 'precio' => 14200, 'desc' => 'Satén azul.', 'img' => 'pijama3.jpeg'],
            ],
            'batas' => [
                ['nombre' => 'Bata Seda Velvet', 'precio' => 18000, 'desc' => 'Elegancia pura.', 'img' => 'bata1.jpeg'],
                ['nombre' => 'Bata Algodón Spa', 'precio' => 12000, 'desc' => 'Súper absorbente.', 'img' => 'bata2.jpeg'],
                ['nombre' => 'Kimono Floral', 'precio' => 15000, 'desc' => 'Diseño exclusivo.', 'img' => 'bata3.jpeg'],
            ],
            'pantuflas' => [
                ['nombre' => 'Pantuflas Cloud', 'precio' => 5500, 'desc' => 'Sentite en las nubes.', 'img' => 'pantuflas1.jpeg'],
                ['nombre' => 'Pantuflas Rabbit', 'precio' => 6200, 'desc' => 'Diseño tierno.', 'img' => 'pantuflas2.jpeg'],
                ['nombre' => 'Slide Relax', 'precio' => 4800, 'desc' => 'Ideales para relax.', 'img' => 'pantuflas3.jpeg'],
            ],
            'lenceria' => [
                ['nombre' => 'Conjunto Encaje Red', 'precio' => 9500, 'desc' => 'Detalles finos.', 'img' => 'lenceria1.jpeg'],
                ['nombre' => 'Body Night', 'precio' => 11000, 'desc' => 'Ajuste perfecto.', 'img' => 'lenceria2.jpeg'],
                ['nombre' => 'Bralette Soft', 'precio' => 7500, 'desc' => 'Comodidad total.', 'img' => 'lenceria3.jpeg'],
            ],
        ];

        // Lógica para la nueva categoría "Productos" (Todos juntos)
        if ($categoria == 'productos') {
            $productos = [];
            foreach ($todosLosProductos as $subcategoria) {
                $productos = array_merge($productos, $subcategoria);
            }
            $titulo = "Todos los Productos";
        } else {
            // Verificamos si la categoría individual existe
            if (!array_key_exists($categoria, $todosLosProductos)) {
                abort(404);
            }
            $productos = $todosLosProductos[$categoria];
            $titulo = ucfirst($categoria);
        }

        return view('catalogo', compact('productos', 'titulo'));
    }
}