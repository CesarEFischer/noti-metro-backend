<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id');
            $table->string('apellido_paterno')->nullable(true);
            $table->string('apellido_materno')->nullable(true);
            $table->string('nombre')->nullable(true);
            $table->string('correo');
            $table->text('contrasena');
            $table->smallInteger('status');
            $table->dateTime('fecha_alta');
            $table->dateTime('fecha_mod')->nullable(true);
            $table->dateTime('fecha_baja')->nullable(true);


        });
    }


    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
