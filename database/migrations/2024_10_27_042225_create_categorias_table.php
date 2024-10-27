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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('categoria_id'); 
            $table->unsignedBigInteger('id'); 
            $table->string('nombre', 50)->notNullable(); 
            $table->enum('tipo', ['Ingreso', 'Gasto'])->notNullable(); 
            $table->foreign('id')->references('id')->on('users'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
