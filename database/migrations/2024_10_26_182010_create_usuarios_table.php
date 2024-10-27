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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('usuario_id'); // Crea un campo 'usuario_id' auto-incremental
            $table->string('nombre', 100); // Crea un campo 'nombre' de tipo string con longitud máxima de 100
            $table->string('email', 100)->unique(); // Crea un campo 'email' único
            $table->string('contraseña'); // Crea un campo 'contraseña' de tipo string
            $table->decimal('saldo_actual', 10, 2)->default(0.00); // Crea un campo 'saldo_actual' con precisión de 10, 2
            $table->timestamp('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP')); // Crea un campo 'fecha_registro' con valor por defecto de la fecha y hora actual
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
