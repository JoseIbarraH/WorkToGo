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
        Schema::create('postulacion_administrador', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_postulacion');
            $table->foreign('id_postulacion')->references('id')->on('postulacion');
            $table->unsignedBigInteger('id_administrador');
            $table->foreign('id_administrador')->references('id')->on('administrador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulacion_administrador');
    }
};
