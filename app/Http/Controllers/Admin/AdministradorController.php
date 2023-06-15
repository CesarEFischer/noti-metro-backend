<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\administrador\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{

    public function logIn(Request $request){
        $validate = validateRequestParams($request,[
            'email' => 'required|string',
            'contrasena' => 'required|string',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);

    }

    public function nuevoAdmin(Request $request){

        $validate = validateRequestParams($request,[
            'nombre' => 'required|string',
            'email' => 'required|string',
            'contrasena' => 'required|string',
            'rol' => 'required|string'
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);

       return Administrador::nuevoAdmin($request);

    }

    public function updateAdmin(Request $request){
        $validate = validateRequestParams($request,[
            'id_admin' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Administrador::updateAdmin($request);

    }

    public function deleteAdmin(Request $request){
        $validate = validateRequestParams($request,[
            'id_admin' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Administrador::deleteAdmin($request);
    }
    public function getAdmins(Request $request){
        return Administrador::getAdmins($request);
    }





}
