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
        Schema::create('administrador', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombre')->nullable(false);
            $table->string('correo')->nullable(false);
            $table->string('contrasena')->nullable(false);
            $table->smallInteger('rol')->nullable(false);
            $table->smallInteger('status')->nullable(false);

            $table->dateTime('fecha_alta')->nullable(false);
            $table->integer('id_user_alta')->nullable(false);
            $table->dateTime('fecha_mod')->nullable();
            $table->integer('id_user_mod')->nullable();
            $table->dateTime('fecha_baja')->nullable();
            $table->integer('id_user_baja')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
