<?php

namespace App\Models\reportes;

use App\Models\notificaciones\Notificaciones;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reportes extends Model
{

    use HasFactory;

    protected $table = 'reportes';
    protected $primaryKey = 'id';
    const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_baja';

    public static function nuevoReporte($request){
        try{
            $reporte = new Reportes();
            $reporte->id_estacion = $request->id_estacion;
            $reporte->tiempo = $request->tiempo;
            $reporte->id_user_alta = $request->id_user_alta;
            error_log($request->tiempo);

            //$reporte->tipo_reporte = $request->tipo_reporte;
            if(!($reporte->save())) throw new Exception("Error al ingresar reporte");

            $notificado = 0; // Es una bandera para saber si ha sido lanzada la notificación

           /* $query = "SELECT COUNT(1) AS notificar
                      FROM reportes
                      WHERE id_reporte = ".$request->id_estacion."
                      AND (TIMEDIFF(MINUTE, fecha_alta, now()) > 0
                        OR (TIMEDIFF(MINUTE, fecha_alta, now()) <= tiempo)";*/
            $query = "SELECT COUNT(1) AS notificar
                       FROM reportes
                       WHERE id_estacion = ".$request->id_estacion."";

            $notificar = DB::select($query)[0]->notificar;

            if($notificar > 0 ) {
                // Se hace el promedio
                // Se obtiene el tipo de reporte que más haya tenido
               // Se mando notificación
                $notificado = 1;
            }

            return response()->json([
                'result' => true,
                'message' => 'Reporte generado correctamente',
                'notificado' => $notificado,
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
                'code' => 400,
                'error' => 'g-401'
            ], 400);

        }
    }

    public static function updateReporte($request){
        try{
            $reporte = Reportes::find($request->id_estacion);
            $reporte->id_estacion = $request->id_estacion;
            $reporte->tiempo = $request->tiempo;
            $reporte->id_user_mod = $request->id_user_mod;
            if(!($reporte->save())) throw new Exception("Error al actualizar el  reporte");

            return response()->json([
                'result' => true,
                'message' => 'Reporte actualizado correctamente',
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
                'code' => 400,
                'error' => 'g-401'
            ], 400);

        }
    }

    public static function deleteReporte($request){
        try{
            $reporte = new Reportes();
            $reporte->id_estacion = $request->id_estacion;
            $reporte->tiempo = $request->tiempo;
            $reporte->id_user_baja = $request->id_user_baja;
            $reporte->fecha_baja = now();
            if(!($reporte->save())) throw new Exception("Error al ingresar reporte");

            return response()->json([
                'result' => true,
                'message' => 'Reporte generado correctamente',
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
                'code' => 400,
                'error' => 'g-401'
            ], 400);

        }
    }

    public static function getReportesActivas(){
        try{
            $reportes = Reportes::where('status', 1)->get();

            return response()->json([
                'result' => true,
                'data' => $reportes
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener los reportes activos: '.$e->getMessage(),
                'code' => 400,
                'error' => 'g-401'
            ], 400);

        }

    }

    public static function getReportesInactivas(){
        try{
            $reportes = Reportes::where('status', 2)->get();

            return response()->json([
                'result' => true,
                'data' => $reportes
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener los reportes inactivos: '.$e->getMessage(),
                'code' => 400,
                'error' => 'g-401'
            ], 400);

        }

    }


    public static function getAfluencia($request){
        $totales = Reportes::where('id_estacion',$request->id_estacion)->groupBy('tipo_reporte')->count();
        $tiempos = Reportes::where('id_estacion',$request->id_estacion)->sum('tiempo');

        $afluencia = [];

        if(count($totales)==0)
            return response()->json([
                'result' => true,
                'data' => $afluencia
            ], 200);


        for($i = 0; $i<count($totales); $i++){
            $afluencia[] = ['total_reportes'=> $totales[$i], 'tiempo' => $tiempos[$i]['tiempo']];
        }

        return response()->json([
            'result' => true,
            'data' => $afluencia
        ], 200);

    }

}