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
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombre');
            $table->string('correo');
            $table->smallInteger('status');
            $table->dateTime('fecha_alta');
            $table->dateTime('fecha_mod');
            $table->dateTime('fecha_baja');


        });
    }


    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
