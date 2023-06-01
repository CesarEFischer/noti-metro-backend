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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_estacion')->unsigned()->nullable(false);
            $table->integer('tiempo')->nullable(false);
            $table->integer('no_reportes')->default(0)->nullable(false);
            $table->dateTime('fecha_alta')->nullable(false);
            $table->dateTime('fecha_baja')->nullable();

            #Llaves foraneas
            $table->foreign('id_estacion')->references('id')->on('estaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
