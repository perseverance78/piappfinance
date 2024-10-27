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
        Schema::create('deudas', function (Blueprint $table) {
            $table->id('deuda_id'); // Columna primaria con auto-incremento
            $table->unsignedBigInteger('id'); // Relación con usuarios
            $table->string('nombre', 100)->notNullable(); // Nombre de la deuda
            $table->decimal('monto_total', 10, 2)->notNullable(); // Monto total de la deuda
            $table->decimal('monto_pagado', 10, 2)->default(0.00); // Monto pagado hasta la fecha
            $table->date('fecha_vencimiento')->notNullable(); // Fecha de vencimiento de la deuda
            $table->boolean('recordatorio')->default(false); // Estado de recordatorio
            
            // Clave foránea
            $table->foreign('id')->references('id')->on('users');
            
            $table->timestamps(); // Campos de tiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deudas');
    }
};
