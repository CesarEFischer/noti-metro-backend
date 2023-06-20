<?php

use Illuminate\Support\Facades\Route;

Route::group([
     'namespace' => 'App\Http\Controllers\Usuarios',
     'middleware' => 'api',
], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('usuario/logIn','UsuariosController@logIn');
        Route::post('usuario/getCodigoVerificacion','UsuariosController@logIn');
    });
});

?>