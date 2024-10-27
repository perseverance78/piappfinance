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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id('alerta_id'); // Columna primaria con auto-incremento
            $table->unsignedBigInteger('id'); // Relación con usuarios
            $table->string('tipo', 50)->notNullable(); // Tipo de alerta
            $table->text('mensaje')->notNullable(); // Mensaje de la alerta
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP')); // Fecha de la alerta
            $table->boolean('visto')->default(false); // Estado de alerta (visto o no)

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
        Schema::dropIfExists('alertas');
    }
};
