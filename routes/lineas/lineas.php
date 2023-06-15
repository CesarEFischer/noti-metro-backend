<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Lineas',
    'middleware' => 'api',
    'prefix' => 'auth',
], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('Lineas/nuevaLinea','LineasEstaciones@nuevaLinea');
        Route::post('Lineas/updateLinea','LineasEstaciones@updateLinea');
    });
});


?>

