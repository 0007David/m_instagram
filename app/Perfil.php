<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Perfil extends Model
{
    protected $table = 'perfil';

    /**
     * The attributes that are mass assignable.
     * 'name','email', 'password',
     * @var array
     */
    protected $fillable = [
        'nombre', 'nombre_usuario','presentacion','sitio_web','genero','id_usuario','fecha_nacimiento','telefono','foto'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public static function find($id)
    {
        return static::where('id_usuario',compact('id'))->first();
    }

    public static function findByUserName($name)
    {
        return static::where('nombre_usuario',compact('name'))->first();
    }
    public function usuario()
    {
        return $this->belongsTo('App\User', 'id_usuario');
    }
    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }

    public function getEdadAttribute()
    {
        $fecha_nacimiento = $this->fecha_nacimiento;
        $edad = Carbon::parse($fecha_nacimiento)->age;
        return $edad;
    }

    public function getNombreAttribute($value)
    {
        return trim($value);
    }

    public function getNombreUsuarioAttribute($value)
    {
        return trim($value);
    }

    public function getPresentacionAttribute($value)
    {
        return trim($value);
    }

    public function getSitioWebAttribute($value)
    {
        return trim($value);
    }

    public function getTelefonoAttribute($value)
    {
        return trim($value);
    }

    public function getFotoAttribute($value)
    {
        return trim($value);
    }
}
