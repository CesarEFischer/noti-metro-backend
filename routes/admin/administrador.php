<?php

use Illuminate\Support\Facades\Route;

Route::group([
     'namespace' => 'App\Http\Controllers\Admin',
     'middleware' => 'api',
], function (){
    Route::group([
        'middleware' => 'api',
    ], function (){
        Route::post('admin/logIn','AdministradorController@logIn');
        Route::post('admin/nuevoAdmin','AdministradorController@nuevoAdmin');
        Route::post('admin/updateAdmin','AdministradorController@updateAdmin');
        Route::post('admin/deleteAdmin','AdministradorController@deleteAdmin');
        Route::get('admin/getAdmins','AdministradorController@getAdmins');
        Route::post('admin/getRol','AdministradorController@getRol');

    });
});


?>

