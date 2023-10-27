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
        Schema::create('metodo_pago', function(Blueprint $table){
            $table->id();
            $table->string('tipo');
            $table->string('numeroTarjeta');
            $table->date('fechaVencimiento');
            $table->string('nombreTitular');
            $table->string('cvc');
            $table->string('numeroCuenta');
            $table->string('nombreBanco');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metodo_pago');
    }
};
