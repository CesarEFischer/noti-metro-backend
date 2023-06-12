<?php

use Illuminate\Support\Facades\Route;

Route::group([
     'namespace' => 'App\Http\Controllers\Admin',
     'middleware' => 'api',
     'prefix' => 'auth',
], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('admin/logIn','AdministradorController@logIn');
        Route::post('admin/newRegister','AdministradorController@newAdmin');
        Route::post('admin/update','AdministradorController@actualizarAdmin');
    });
});


?>

