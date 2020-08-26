<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $table = 'post';

    /**
     * The attributes that are mass assignable.
     * 'name','email', 'password',
     * @var array
     */
    protected $fillable = [
        'foto', 'descripcion', 'fecha_creada', 'fecha_actualizada', 'id_usuario', 'estado'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public static function find($id)
    {
        return static::where('id', compact('id'))->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_usuario');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes', 'id_post', 'id');
    }

    public function notificacion()
    {
        return $this->hasOne('App\Notificacion', 'id_post', 'id');
    }

    public function comentario()
    {
        return $this->hasMany('App\Comentario', 'id_post', 'id');
    }
    public function getIdAttribute($value)
    {
        return trim($value);
    }

    public static function findid($id)
    {
        return static::where('id', compact('id'))->first();
    }

    public function getLikesCountAttribute()
    {
        $id = $this->id;
        $datos = DB::table('likes')
            ->select(DB::raw('count(*)'))
            ->where('likes.id_post', '=', $id)
            ->get();
        return $datos[0]->count;
    }

    public function getComentarioCountAttribute()
    {
        $id = $this->id;
        $datos = DB::table('comentario')
            ->select(DB::raw('count(*)'))
            ->where('comentario.id_post', '=', $id)
            ->get();
        return $datos[0]->count;
    }

    public function getFirstComentarioAttribute()
    {
        $id = $this->id;
        $datos = DB::table('comentario')
            ->select(DB::raw('*'))
            ->join('perfil', 'comentario.id_usuario', '=', 'perfil.id_usuario')
            ->where('comentario.id_post', '=', $id)
            ->limit(1)
            ->get();


        return $datos->first();
    }
    public function dioLikeSeguidor($id_seguidor)
    {
        $id = $this->id;
        return $this->likes()->where('id_usuario','=',$id_seguidor)->where('id_post','=',$id)->first();
    }

    static public function contadorPosts($id)
    {
        $datos = DB::table('post')
            ->select(DB::raw('count(*)'))
            ->where('post.id_usuario', '=', $id)
            ->get();
        return $datos[0]->count;
    }

    public function getFotoAttribute($value)
    {
        //http://lorempixel.com/400/450/sports/
        if(  empty($value) || trim($value) == "")
            return "http://lorempixel.com/400/450/sports/";
        return trim($value);
    }

    public function getDescripcionAttribute($value)
    {
        return trim($value);
    }
    
}
