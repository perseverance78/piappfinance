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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('reporte_id'); // Columna primaria con auto-incremento
            $table->unsignedBigInteger('id'); // Relación con usuarios
            $table->string('tipo', 50)->notNullable(); // Tipo de reporte (e.g., 'PDF', 'Gráfico')
            $table->timestamp('fecha_generacion')->default(DB::raw('CURRENT_TIMESTAMP')); // Fecha de generación
            $table->text('enlace_reporte')->nullable(); // Enlace al archivo del reporte
            
            // Clave foránea
            $table->foreign('id')->references('id')->on('users');
            
            $table->timestamps(); // Campos de tiempo adicionales
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
