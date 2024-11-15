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
            $table->id('alerta_id');
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo_alerta', ['presupuesto', 'deuda', 'ahorro', 'ingreso', 'gasto_diario']);
            $table->text('mensaje');
            $table->date('fecha_alerta');
            $table->boolean('vista')->default(false);
            $table->timestamps();
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
