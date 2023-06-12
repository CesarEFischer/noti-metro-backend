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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_estacion')->unsigned()->nullable(false);
            $table->integer('tiempo')->nullable(false);
            $table->smallInteger('status')->default(1)->nullable(false);


            $table->dateTime('fecha_alta')->nullable(false);
            $table->bigInteger('id_user_alta')->unsigned()->nullable(false);
            $table->dateTime('fecha_mod')->nullable();
            $table->bigInteger('id_user_mod')->unsigned()->nullable();
            $table->dateTime('fecha_baja')->nullable();
            $table->bigInteger('id_user_baja')->unsigned()->nullable();

            #Llaves foraneas
            $table->foreign('id_estacion')->references('id')->on('estaciones');
            $table->foreign('id_user_alta')->references('id')->on('usuarios');
            $table->foreign('id_user_mod')->references('id')->on('usuarios');
            $table->foreign('id_user_baja')->references('id')->on('usuarios');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
