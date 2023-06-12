<?php

namespace App\Models\lineas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineas extends Model
{
    use HasFactory;

    protected $table = 'lineas';
    protected $primaryKey = 'id';
    const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_mod';


    public static function nuevaLinea($request){
        try{
            $linea = new Lineas();
            $linea->nombre = $request->apellido_paterno;
            $linea->color = $request->apellido_materno;
            $linea->id_user_alta =  $request->id_user_alta;
            if(!($linea->save())) throw new Exception("Error al ingresar la linea");

            return response()->json([
                'result' => true,
                'message' => 'Linea guardadamente correctamente',
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

    public static function updateLinea($request){
        try{
            $linea = Lineas::find($request->id);
            $linea->nombre = $request->nombre;
            $linea->color = $request->color;
            $linea->id_user_mod =  $request->id_user_mod;
            if(!($linea->save())) throw new Exception("Error al actualizar");

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

    public static function deleteLinea($request){
        try{
            $linea = Lineas::find($request->id);
            $linea->status = 2;
            $linea->id_user_baja = $request->id_user_baja;
            $linea->fecha_baja = now();
            if(!($linea->save())) throw new Exception("Error al eliminar la linea");

            return response()->json([
                'result' => true,
                'message' => 'Linea eliminada',
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

    public static function getLineas(){
        try{
            $lineas = Linea::getAll();

            foreach ($lineas as $linea){
                $linea->estaciones = Estaciones::where('id_linea',$linea->id)->get();
            }

            return response()->json([
                'result' => true,
                'data' => $lineas
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



}
