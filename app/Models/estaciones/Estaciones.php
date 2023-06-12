<?php

namespace App\Models\estaciones;

use App\Models\administrador\Administrador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estaciones extends Model
{
    use HasFactory;

    protected $table = 'estaciones';
    protected $primaryKey = 'id';
    const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_mod';


    public static function nuevaEstacion($request){
        try{
            $estacion = new Estaciones();
            $estacion->ruta_imagen = $request->apellido_paterno;
            $estacion->status = $request->apellido_materno;
            $estacion->id_user_alta =  $request->id_user_alta;
            if(!($estacion->save())) throw new Exception("Error al realizar el registro");

            return response()->json([
                'result' => true,
                'message' => 'Estación guardadamente correctamente',
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

    public static function updateEstacion($request){
        try{
            $estacion = Estaciones::find($request->id);
            $estacion->ruta_imagen = $request->apellido_paterno;
            $estacion->status = $request->apellido_materno;
            $estacion->id_user_mod =  $request->id_user_mod;
            if(!($estacion->save())) throw new Exception("Error al actualizar el administrador");

            return response()->json([
                'result' => true,
                'message' => 'Datos actualizados correctamente',
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

    public static function deleteEstacion($request){
        try{
            $estacion = Estaciones::find($request->id);
            $estacion->status = 2;
            $estacion->id_user_baja = $request->id_user_baja;
            $estacion->fecha_baja = now();
            if(!($estacion->save())) throw new Exception("Error al eliminar al  administrador");

            return response()->json([
                'result' => true,
                'message' => 'Estación eliminada',
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

    public static function getEstaciones($request){
        try{
            $estaciones = Estaciones::where('id_linea',$request->id_linea)->get();
            return response()->json([
                'result' => true,
                'data' => $estaciones
            ], 200);

        }catch (Exception $e){
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener las estaciones: '.$e->getMessage(),
                'code' => 400,
                'error' => 'g-401'
            ], 400);

        }

    }

}
