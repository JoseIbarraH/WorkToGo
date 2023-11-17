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
        Schema::create('pqrs', function(Blueprint $table){
            $table -> id();
            $table -> string ('titulo');
            $table -> string ('tipo');
            $table -> string ('descripcion');
            $table -> date ('fechaCreacion');
            $table -> string ('estado');
            $table -> string ('respuesta')->nullable();
            $table -> date ('fechaResolucion')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrs');
    }
};
