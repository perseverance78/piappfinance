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
        Schema::create('objetivos_ahorro', function (Blueprint $table) {
            $table->id('objetivo_id'); // Columna primaria con auto-incremento
            $table->unsignedBigInteger('id'); // Relación con usuarios
            $table->string('nombre', 100)->notNullable(); // Nombre del objetivo
            $table->decimal('monto_objetivo', 10, 2)->notNullable(); // Monto objetivo
            $table->decimal('monto_actual', 10, 2)->default(0.00); // Monto acumulado actual
            $table->date('fecha_meta')->nullable(); // Fecha de cumplimiento de meta
            
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
        Schema::dropIfExists('objetivos_ahorro');
    }
};
