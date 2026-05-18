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
            $table->id();
            $table->string('nombre', 150); [cite: 62]
            $table->text('descripcion')->nullable(); [cite: 63]
            $table->decimal('precio', 10, 2); [cite: 64]
            $table->integer('stock')->default(0); [cite: 65]
            $table->string('url_imagen')->nullable(); [cite: 66]
            $table->boolean('activo')->default(true); [cite: 67]
            $table->timestamps();
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
