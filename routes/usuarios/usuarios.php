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
        Route::post('usuario/preRegistro','UsuariosController@preRegistro');
        Route::post('usuario/getCodigoVerificacion','UsuariosController@generarCodigoVerificacion');
        Route::post('usuario/registroTerminal','UsuariosController@registroTerminal');
        Route::post('usuario/updateUsuario','UsuariosController@updateUsuario');
        Route::post('usuario/deleteUsuario','UsuariosController@deleteUsuario');
        Route::get('usuario/getUsuarios','UsuariosController@getUsuarios');
    });
});

?>