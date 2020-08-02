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

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }
    public function usuario2()
    {
        return $this->belongsTo('App\User');
    }

    static public function contadorSeguidor($id)
    {
        $datos= DB::table('seguidor')
        ->select(DB::raw('count(*)'))
        ->where('seguidor.id_usuario', '=' ,$id)
        ->get();

        return $datos[0]->count;
    }

    static public function contadorSeguidos($id)
    {
        $datos= DB::table('seguidor')
        ->select(DB::raw('count(*)'))
        ->where('seguidor.id_usuario_seguidor', '=' ,$id)
        ->get();

        return $datos[0]->count;
    }

}
