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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('categoriaEstado')->default(true); // Nueva columna para la baja lógica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la columna 'categoriaEstado' antes de eliminar la tabla
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('categoriaEstado');
        });

        Schema::dropIfExists('categories');
        
    }
};
