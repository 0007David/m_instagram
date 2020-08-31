<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

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
        if (empty($value) || trim($value) == "")
            return "sin_imagen.png";
        return trim($value);
    }

    public function getFotoBase64Attribute()
    {
        $foto = $this->foto;
        $path = public_path('Imagen/'.trim($foto));
        $filetype = pathinfo($path);
        $data = file_get_contents($path);
        return 'data:image/'.$filetype['extension'].';base64,'.base64_encode($data);
    }

    public function getFileLogAttribute(){
        $nombre_usuario = $this->nombre_usuario;
        // Storage::disk('local')->exists($fileName)
        // $path = storage_path("app"."\\".$nombre_usuario .".log");        
        $fileName = $nombre_usuario . '.log';
        return Storage::disk('local')->exists($fileName);
    }
}
