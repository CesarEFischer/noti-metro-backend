<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('estaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_linea')->nullable(false);
            $table->string('ruta_imagen')->nullable(false);
            $table->smallInteger('status')->nullable(false);

            $table->dateTime('fecha_alta')->nullable(false);
            $table->bigInteger('id_user_alta')->unsigned()->nullable(false);
            $table->dateTime('fecha_mod')->nullable();
            $table->bigInteger('id_user_mod')->unsigned()->nullable();
            $table->dateTime('fecha_baja')->nullable();
            $table->bigInteger('id_user_baja')->unsigned()->nullable();

            #Llaves foraneas
            $table->foreign('id_user_alta')->references('id')->on('administrador');
            $table->foreign('id_user_mod')->references('id')->on('administrador');
            $table->foreign('id_user_baja')->references('id')->on('administrador');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estaciones');
    }
};
