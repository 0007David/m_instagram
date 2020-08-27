<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seguidor extends Model
{
    protected $table = 'seguidor';

    protected $fillable = [
        'estado', 'id_usuario','id_usuario_seguidor'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function usuarioSeguido()
    {
        return $this->belongsTo('App\User', 'id_usuario');
    }
    public function usuarioSeguidor()
    {
        return $this->belongsTo('App\User', 'id_usuario_seguidor');
    }

    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }

    static public function contadorSeguidor($id)
    {
        $datos= DB::table('seguidor')
        ->select(DB::raw('count(*)'))
        ->where('seguidor.id_usuario', '=' ,$id)
        ->where('estado','=','t')
        ->get();

        return $datos[0]->count;
    }

    static public function contadorSeguidos($id)
    {
        $datos= DB::table('seguidor')
        ->select(DB::raw('count(*)'))
        ->where('seguidor.id_usuario_seguidor', '=' ,$id)
        ->where('estado','=','t')
        ->get();

        return $datos[0]->count;
    }

    public function loEstoySiguiendo($idSeguidor)
    {
        $id = $this->id_usuario;
        return $this->where('id_usuario_seguidor','=',$id)->where('id_usuario','=',$idSeguidor)->where('estado','=','t')->first();
    }

}
