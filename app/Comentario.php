<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';

    protected $fillable = [
        'descripcion', 'fecha_creada','fecha_actualizada', 'id_usuario', 'id_post'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User','id_usuario','id');
    }
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }

    public function getDescripcionAttribute($value)
    {
        return trim($value);
    }
}
