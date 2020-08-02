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
        'foto', 'descripcion','fecha_creado','fecha_actualizado','id_usuario'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\User', 'id_usuario');
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes', 'id_usuario', 'id');
    }

    public function notificacion()
    {
        return $this->hasOne('App\Notificacion', 'id_post', 'id');
    }
    
    public function comentario()
    {
        return $this->hasMany('App\Comentario', 'id_usuario', 'id');
    }

    static public function contadorPosts($id)
    {
        $datos= DB::table('post')
        ->select(DB::raw('count(*)'))
        ->where('post.id_usuario', '=' ,$id)
        ->get();
        return $datos[0]->count;
    }
}
