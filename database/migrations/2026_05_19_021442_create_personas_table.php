<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 100);
            $table->string('apellido', 100);

            $table->string('email')->unique();

            $table->string('password');

            // Relación con perfiles
            $table->foreignId('perfil_id')
                  ->constrained('perfiles');

            // 1 = activo | 0 = inactivo
            $table->boolean('activo')->default(true);

            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};