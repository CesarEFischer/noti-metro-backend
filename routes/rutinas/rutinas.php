<?php

use Illuminate\Support\Facades\Route;

Route::group([
     'namespace' => 'App\Http\Controllers\Rutinas',
     'middleware' => 'api',
], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('reportes/getAfluencia','RutinasController@getAfluencia');
    });
});


?>
