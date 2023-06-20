<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\usuarios\Usuarios;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{

    public function logIn(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if($validate->fails())
            return validateResponse($validate);

        return Usuarios::logIn($request);
        
    }

    public function nuevoUsuario(Request $request){

        $validate = validateRequestParams($request,[
            'email' => 'required|string',
            'contrasena' => 'required|string',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);

       return Administrador::nuevoAdmin($request);
    }

    public function generarCodigoValidacion(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if($validate->fails())
            return validateResponse($validate);

        $codigo = '';

        for($i = 0;$i<6;$i++){
            $codigo.= rand(0,9);
        }

        return response()->json([
            'result' => true,
            'message' => 'Usuario verificado',
        ], 200);


    }


    public function updateUsuario(Request $request){
        $validate = validateRequestParams($request,[
            'id_admin' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Administrador::updateAdmin($request);

    }

    public function deleteUsuario(Request $request){
        $validate = validateRequestParams($request,[
            'id_admin' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Administrador::deleteAdmin($request);
    }

    
    public function getUsuarios(Request $request){
        return Administrador::getAdmins($request);
    }

}
