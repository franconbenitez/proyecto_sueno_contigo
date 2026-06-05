<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Verifica si la columna NO existe antes de intentar crearla
        if (!Schema::hasColumn('productos', 'deleted_at')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('productos', 'deleted_at')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};