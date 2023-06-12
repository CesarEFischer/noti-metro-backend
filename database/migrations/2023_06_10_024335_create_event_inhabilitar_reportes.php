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
      DB::unprepared("CREATE EVENT IF NOT EXIST event_inhabilitar_reportes
                         ON SCHEDULE EVERY DAY STARTS '2018-06-09 00:00:00'
                        DO
                          UPDATE reportes
                             SET status = 2
                          WHERE CAST(fecha_baja AS DATE) = CAST(DATEADD(day,-1,now()) AS DATE)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP EVENT IF NOT EXIST event_inhabilitar_reportes");
    }
};
