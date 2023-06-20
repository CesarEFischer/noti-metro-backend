<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Reportes',
    'middleware' => 'api',

], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('Reportes/nuevoReporte','ReportesController@nuevoReporte');
        Route::post('Reportes/updateReporte','ReportesController@updateReporte');
        Route::post('Reportes/deleteReporte','ReportesController@deleteReporte');
        Route::get('Reportes/getReportesActivas','ReportesController@getReportesActivas');
        Route::get('Reportes/getReportesInactivas','ReportesController@getReportesInactivas');


    });
});


?>
