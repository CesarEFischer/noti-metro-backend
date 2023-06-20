<?php

namespace App\Models\rutinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutinas extends Model
{
    use HasFactory;

    protected $table = 'rutinas';
    protected $primaryKey = 'id';
    const CREATED_AT = 'fecha_alta';
    const UPDATED_AT = 'fecha_baja';


    public static function nuevaRutina($request){
        $rutina = new Rutinas();
        $rutina->id_usuario = $request->id_user;
        $rutina->recorrido = $request->rutina;
        return ($rutina->save())? $rutina->id: null;

    }
}
