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
        Schema::create('lineas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable(false);
            $table->string('color')->nullable(false);
            $table->smallInteger('status');

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
        Schema::dropIfExists('lineas');
    }
};
