<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Ejecutamos los seeders base de perfiles y productos
        $this->call([
            PerfilSeeder::class,
            ProductoSeeder::class,
        ]);

        // 2. Creamos los accesos de prueba para el profesor (ID 1 = Administrador, ID 2 = Cliente)
        Persona::create([
            'nombre' => 'Admin',
            'apellido' => 'General',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'), // Encriptado obligatorio
            'perfil_id' => 1, // Vinculado a Administrador
            'activo' => true
        ]);

        Persona::create([
            'nombre' => 'Franco',
            'apellido' => 'Benitez',
            'email' => 'franco@cliente.com',
            'password' => Hash::make('12345678'),
            'perfil_id' => 2, // Vinculado a Cliente
            'activo' => true
        ]);
    }
}