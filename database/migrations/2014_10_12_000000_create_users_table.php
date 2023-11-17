<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->String('cedula');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('celular')->unique();
            $table->string('genero');
            $table->string('tipo')->default('Cliente');
            $table->string('estado')->default('Activo');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('service')->default('Inactivo');
        });

        DB::table('users')->insert([
            'nombre' => 'Jose Carlos Ibarra Herrera',
            'cedula' => '1007260280',
            'email' => 'jcibarrah1423@gmail.com',
            'username' => 'jose',
            'celular' => '3164749242',
            'genero' => 'Masculino',
            'tipo' => 'Administrador',
            'password' => Hash::make('123456789'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
