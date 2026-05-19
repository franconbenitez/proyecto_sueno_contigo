<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Creamos las categorías primero
        $pijamasId = DB::table('categorias')->insertGetId([
            'nombre' => 'Pijamas',
            'activa' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $pantuflasId = DB::table('categorias')->insertGetId([
            'nombre' => 'Pantuflas',
            'activa' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 2. Insertamos los productos apuntando al ID de la categoría correspondiente
        DB::table('productos')->insert([
            [
                'nombre' => 'Pijama Satin Rose',
                'descripcion' => 'Hermoso pijama de satén color rosa, ideal para noches frescas.',
                'precio' => 31000.00,
                'stock' => 10,
                'url_imagen' => 'pijama-satin-rose.png', // Debe coincidir con url_imagen de tu tabla
                'categoria_id' => $pijamasId,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Conjunto Sweet Dream',
                'descripcion' => 'Conjunto súper cómodo de algodón premium.',
                'precio' => 28500.00,
                'stock' => 15,
                'url_imagen' => 'conjunto-sweet-dream.png',
                'categoria_id' => $pijamasId,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Pantuflas Soft Gray',
                'descripcion' => 'Pantuflas abrigadas con suela antideslizante.',
                'precio' => 14000.00,
                'stock' => 8,
                'url_imagen' => 'pantuflas-soft.png',
                'categoria_id' => $pantuflasId,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}