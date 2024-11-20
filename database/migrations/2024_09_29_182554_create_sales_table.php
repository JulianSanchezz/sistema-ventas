<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Decimal;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('total',10,2);
            $table->decimal('pago',10,2)->nullable();
            $table->date('fecha');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->boolean('estadoVenta')->default(true)->after('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('sales');
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('estadoVenta'); // Elimina la columna si se revierte la migración
        });
    }
};
