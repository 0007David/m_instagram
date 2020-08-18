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
        'foto', 'descripcion','fecha_creada','fecha_actualizada','id_usuario','estado'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'id_usuario');
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
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
        return static::where('id',compact('id'))->first();
    }

    public function getLikesCountAttribute()
    {
        $id = $this->id;
        $datos= DB::table('likes')
        ->select(DB::raw('count(*)'))
        ->where('likes.id_post', '=' ,$id)
        ->get();
        return $datos[0]->count;
    }

    public function getComentarioCountAttribute()
    {
        $id = $this->id;
        $datos= DB::table('comentario')
        ->select(DB::raw('count(*)'))
        ->where('comentario.id_post', '=' ,$id)
        ->get();
        return $datos[0]->count;
    }

    public function getFirstComentarioAttribute()
    {
        $id = $this->id;
        $datos= DB::table('comentario')
        ->select(DB::raw('*'))
        ->join('perfil', 'comentario.id_usuario', '=', 'perfil.id_usuario')
        ->where('comentario.id_post', '=' ,$id)
        ->limit(1)
        ->get();


        return $datos->first();
    }

    /*public function getFirstComentarioAttribute()
    {
        $id = $this->id;
        $datos= DB::table('comentario')
        ->select(DB::raw('*'))
        ->where('comentario.id_post', '=' ,$id)
        ->limit(1)
        ->get();


        return $datos->first();
    }*/

    static public function contadorPosts($id)
    {
        $datos= DB::table('post')
        ->select(DB::raw('count(*)'))
        ->where('post.id_usuario', '=' ,$id)
        ->get();
        return $datos[0]->count;
    }

    static public function ayuda1($id){
        return DB::table('seguidor')
        ->select('id_usuario')
        ->where('id_usuario_seguidor', '=' ,$id)
        ->get();
    }

    static public function postsegme($id){
        $datos= Post::ayuda1($id);
        $respuesta=array();
        foreach ($datos as $dato){
            $respuesta[]=$dato->id_usuario;
        }
        // select *
        // from post
        // where post.id_usuario in (select seguidor.id_usuario
        // from usuario, seguidor
        // where usuario.id=seguidor.id_usuario_seguidor and usuario.id=9) OR post.id_usuario=9
        // order by id desc

        return DB::table('post')
        //->join('perfil', 'post.id_usuario', '=', 'perfil.id_usuario')
        ->select(DB::raw('post.id,post.foto,post.descripcion,post.fecha_creada,post.fecha_actualizada,post.id_usuario,post.estado'))
        ->where('post.estado','=','t')
        ->whereIn('post.id_usuario', $respuesta)
        ->orwhere('post.id_usuario', '=' ,$id)
        ->orderByDesc('post.id')
        ->get();
    }
}
