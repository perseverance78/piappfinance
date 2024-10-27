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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id('presupuesto_id'); // Columna primaria con auto-incremento
            $table->unsignedBigInteger('id'); // Relación con usuarios
            $table->unsignedBigInteger('categoria_id'); // Relación con categorias
            $table->decimal('monto_max', 10, 2)->notNullable(); // Monto máximo
            $table->date('fecha_inicio')->notNullable(); // Fecha de inicio
            $table->date('fecha_fin')->notNullable(); // Fecha de fin

            // Claves foráneas
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('categoria_id')->references('categoria_id')->on('categorias');
            
            $table->timestamps(); // Campos de tiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};
