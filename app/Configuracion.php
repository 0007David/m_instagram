<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';

    protected $fillable = [
        'notificaciones', 'tema_fondo', 'id_usuario'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }
    
    public static function find($id)
    {
        return static::where('id_usuario',compact('id'))->first();
    }
}
