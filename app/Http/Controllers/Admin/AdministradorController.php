<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\administrador\Administrador;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdministradorController extends Controller
{

    public function getRol(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required|string',
        ]);

        if($validate->fails())
            return validateResponse($validate);

        $user = Administrador::where('correo',$request->email)->get();

        if(count($user) == 0 )
            return response()->json([
                'result' => 0,
                'message' => 'Tiene rol 0',
            ], 200);

        
        return response()->json([
                'result' => 1,
                'message' => 'Tiene rol 1',
            ], 200);

    }


    public function logIn(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if($validate->fails())
            return validateResponse($validate);

        
        return Administrador::logIn($request);

    }


    public function nuevoAdmin(Request $request){

        /*$validate = validateRequestParams($request,[
            'nombre' => 'required|string',
            'email' => 'required|string',
            'contrasena' => 'required|string',
            'rol' => 'required|string'
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);*/

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
