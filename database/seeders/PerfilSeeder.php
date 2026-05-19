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
                'nombre_perfil' => 'Administrador', // <-- Ajustado acá
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre_perfil' => 'Cliente',       // <-- Ajustado acá
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}