<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Reportes',
    'middleware' => 'api',
    'prefix' => 'auth',
], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('Reportes/nuevoReporte','Reportes@nuevoReporte');
        Route::post('Reportes/updateReporte','Reportes@updateReporte');
        Route::post('Reportes/deleteReporte','Reportes@deleteReporte');
        Route::get('Reportes/getReportesActivas','Reportes@getReportesActivas');
        Route::get('Reportes/getReportesInactivas','Reportes@getReportesInactivas');


    });
});


?>
