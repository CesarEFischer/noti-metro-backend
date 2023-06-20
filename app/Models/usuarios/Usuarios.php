<?php

namespace App\Models\usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_mod';


    public static function logIn($request){

        $user = Usuarios::where('correo',$request->email)->get();

        if(count($user)== 0)
            return response()->json([
                'result' => false,
                'message' => 'El correo ingresado no esta registrado',
                'code' => 400,
            ], 400);

        if($user->status == 0)
            return response()->json([
                'result' => false,
                'message' => 'El usuario no ha concluido con su registro',
                'code' => 400,
            ], 400);

        if($user->status == 2)
            return response()->json([
                'result' => false,
                'message' => 'El usuario esta dado de baja',
                'code' => 400,
            ], 400);

        
          $pass = decrypt(base64_decode($user->contrasena));
          
          if($pass != $request->contrasena)
            return response()->json([
                'result' => false,
                'message' => 'La contraseña es incorrecta',
                'code' => 400,
            ], 400);


         return response()->json([
                'result' => true,
                'message' => 'Usuario verificado',
            ], 200);
  


    }

    public static function nuevoUsuario($request){
      try{

          $admin = new Usuarios();
          $admin->correo = $request->correo;
          $admin->contrasena = base64_encode(encrypt($request->contrasena));
          $admin->status = 0;
    
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

    public static function updateUsuario($request){
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

    public static function deleteUsuario($request){
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

    public static function getUsuario($request){
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
