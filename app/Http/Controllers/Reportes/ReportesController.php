<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Models\lineas\Lineas;
use App\Models\reportes\Reportes;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function nuevoReporte(Request $request){

        /*$validate = validateRequestParams($request,[
            'nombre' => 'required|string',
            'color' => 'required|string',
            'tiempo' => 'required|string'
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);*/

        return Reportes::nuevoReporte($request);
    }
    public function updateReporte(Request $request){
        $validate = validateRequestParams($request,[
            'id_reporte' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Reportes::updateReporte($request);

    }
    public function deleteReporte(Request $request){
        $validate = validateRequestParams($request,[
            'id_reporte' => 'required|number',
        ],400,'g-401');

        if(!$validate['result'])
            return validateResponse($validate);
        return Reportes::deleteReporte($request);

    }

    public function getReportesInactivas(Request $request){

        return Reportes::getReportesInactivas($request);
    }



    public function getReportesActivas(Request $request){

        return Reportes::getReportesActivas($request);
    }

    public function getAfluencia(Request $request){
        $validate = Validator::make($request->all(),[
            'id_estacion' => 'required',
        ]);

        if($validate->fails())
            return validateResponse($validate);
    }
}
