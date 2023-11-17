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
        Schema::create('postulas', function(Blueprint $table){
            $table->id();
            $table->string('estado')->default('Activo');
            $table->string('sugerido');
            $table->timestamps();
            $table->unsignedBigInteger('id_trabajador');
            $table->foreign('id_trabajador')->references('codigoTrabajador')->on('trabajadors');
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_servicio')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulas');
    }
};
