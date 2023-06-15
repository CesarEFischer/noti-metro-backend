<?php

namespace App\Http\Controllers\Lineas;

use App\Http\Controllers\Controller;
use App\Models\lineas\Lineas;
use Illuminate\Http\Request;

class LineasEstaciones extends Controller
{
    //
    public function nuevaLinea(Request $request){

        $validate = validateRequestParams($request,[
            'nombre' => 'required|string',
            'color' => 'required|string'
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);

        return Lineas::nuevaLinea($request);
    }

    public function updateLinea(Request $request){
        $validate = validateRequestParams($request,[
            'id_linea' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Lineas::updateLinea($request);

    }
}
