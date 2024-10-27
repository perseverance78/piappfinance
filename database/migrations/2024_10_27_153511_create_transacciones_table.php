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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id('transaccion_id'); // Columna primaria con auto-incremento
            $table->unsignedBigInteger('id'); // Relación con usuarios
            $table->unsignedBigInteger('categoria_id'); // Relación con categorias
            $table->enum('tipo', ['Ingreso', 'Gasto'])->notNullable(); // Tipo de transacción
            $table->decimal('monto', 10, 2)->notNullable(); // Monto de la transacción
            $table->date('fecha')->notNullable(); // Fecha de la transacción
            $table->string('descripcion', 255)->nullable(); // Descripción de la transacción
            
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
        Schema::dropIfExists('transacciones');
    }
};
