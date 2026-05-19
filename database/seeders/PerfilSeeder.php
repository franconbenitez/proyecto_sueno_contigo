<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perfiles')->insert([
            [
                'nombre' => 'Administrador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cliente',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
