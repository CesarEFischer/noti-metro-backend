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

    public function preRegistro(Request $request){

        $validate = Validator::make($request->all(),[
            'email' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if($validate->fails())
            return validateResponse($validate);

       return Usuarios::nuevoUsuario($request);
    }



    public function generarCodigoVerificacion(Request $request){
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
            'codigo' => $codigo,
        ], 200);


    }


    public function registroTerminal(Request $request){

        $validate = Validator::make($request->all(),[
            'id_user' => 'required',
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'rutina' => 'required|string',
        ]);

        if($validate->fails())
            return validateResponse($validate);

       return Usuarios::registroTerminal($request);
    }


    public function updateUsuario(Request $request){
        $validate = validateRequestParams($request,[
            'id_user' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Usuarios::updateUsuario($request);

    }

    public function deleteUsuario(Request $request){
        $validate = validateRequestParams($request,[
            'id_user' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Usuarios::deleteUsuario($request);
    }

    
    public function getUsuarios(Request $request){
        return Usuarios::getUsuarios($request);
    }

}
