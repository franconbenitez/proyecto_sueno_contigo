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
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID automático 
            $table->string('nombre', 150); // Campo nombre 
            $table->text('descripcion')->nullable(); // Campo descripción 
            $table->decimal('precio', 10, 2); // Campo precio 
            $table->integer('stock')->default(0); // Campo stock 
            $table->string('url_imagen')->nullable(); // Campo URL imagen 
            // Relación categoría (primero tabla categoría )
            $table->foreignId('categoria_id')->constrained('categorias'); 
            $table->boolean('activo')->default(true); // Campo activo 
            $table->timestamps(); // Created_at y updated_at 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
