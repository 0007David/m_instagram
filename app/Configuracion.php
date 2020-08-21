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

    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }

    public function getTemaFondoAttribute($value)
    {
        return trim($value);
    }
}
