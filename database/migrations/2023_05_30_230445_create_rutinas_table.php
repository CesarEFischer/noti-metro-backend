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
        Schema::create('rutinas', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('id_usuario')->unsigned()->nullable(false);
            $table->string('recorrido')->nullable(false);
            $table->integer('reincidencia')->default(0);
            $table->smallInteger('status')->nullable(false);

            $table->dateTime('fecha_alta')->nullable(false);
            $table->dateTime('fecha_mod')->nullable(true);
            $table->dateTime('fecha_baja')->nullable(true);

            #Llaves foraneas
            $table->foreign('id_usuario')->references('id')->on('usuarios');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutinas');
    }
};
