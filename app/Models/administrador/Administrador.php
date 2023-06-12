<?php

namespace App\Models\administrador;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administrador';
    protected $primaryKey = 'id';
    const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_mod';


    public static function nuevoAdmin($request){
      try{
          $admin = new Administrador();
          $admin->apellido_paterno = $request->apellido_paterno;
          $admin->apellido_materno = $request->apellido_materno;
          $admin->nombre =  $request->nombre;
          $admin->correo = $request->correo;
          $admin->contrasena = '';
          $admin->id_user_alta = $request->id_user_alta;
          $admin->rol = $request->rol;
          if(!($admin->save())) throw new Exception("Error al realizar el registro");

          return response()->json([
              'result' => true,
              'message' => 'Registro generado correctamente',
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

    public static function updateAdmin($request){
        try{
            $admin = Administrador::find($request->id);
            $admin->apellido_paterno = $request->apellido_paterno;
            $admin->apellido_materno = $request->apellido_materno;
            $admin->nombre =  $request->nombre;
            $admin->correo = $request->correo;
            $admin->contrasena = '';
            $admin->id_user_mod = $request->id_user_mod;
            $admin->rol = $request->rol;
            if(!($admin->save())) throw new Exception("Error al actualizar el administrador");

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

    public static function deleteAdmin($request){
        try{
            $admin = Administrador::find($request->id);
            $admin->id_user_baja = $request->id_user_baja;
            $admin->fecha_baja = now();
            $admin->status = 2;
            if(!($admin->save())) throw new Exception("Error al eliminar al  administrador");

            return response()->json([
                'result' => true,
                'message' => 'Administrador eliminado',
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

    public static function getAdmins($request){
        try{
            $admins = Administrador::all();
            return response()->json([
                'result' => true,
                'data' => $admins
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
