<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';

    /**
     * The attributes that are mass assignable.
     * 'name','email', 'password',
     * @var array
     */
    protected $fillable = [
        'email', 'password','estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 'password', 'remember_token',
     * @var array
     */
    // protected $hidden = [
    //     'password'
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function post()
    {
        return $this->hasMany('App\Post', 'id_usuario', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes', 'id_usuario', 'id');
    }

    public function contacto()
    {
        return $this->hasMany('App\Contacto', 'id_usuario', 'id');
    }

    public function configuracion()
    {
        return $this->hasOne('App\Configuracion', 'id_usuario', 'id');
    }

    public function seguidor()
    {
        return $this->hasMany('App\Seguidor', 'id_usuario', 'id');
    }

    public function seguidor_2()
    {
        return $this->hasMany('App\Seguidor', 'id_usuario_seguidor', 'id');
    }

    public function comentario()
    {
        return $this->hasMany('App\Comentario', 'id_usuario', 'id');
    }

    public function perfil()
    {
        // return $this->belongsTo('App\Perfil', );
        // return $this->hasOne('App\Phone');
        return $this->hasOne('App\Perfil', 'id_usuario', 'id');
    }
    
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }

    public static function findByEmail($email)
    {
        return static::where('email',compact('email'))->first();
    }

    public function getEmailAttribute($value)
    {
        return trim($value);
    }
    public function getPasswordAttribute($value)
    {
        return trim($value);
    }
    public function getEstadoAttribute($value)
    {
        return trim($value);
    }

    static public function ayuda1($id){
        return DB::table('seguidor')
        ->select('id_usuario')
        ->where('id_usuario_seguidor', '=' ,$id)
        ->get();
    }

    static public function consulta1($id){
        $datos= User::ayuda1($id);
        $respuesta=array();
        foreach ($datos as $dato){
            $respuesta[]=$dato->id_usuario;
        }
        //select nombre,nombre_usuario 
        // from seguidor,perfil 
        // where id_usuario_seguidor not in(select id_usuario from seguidor 
        // where id_usuario_seguidor = 5) and seguidor.id_usuario=5 and seguidor.id_usuario_seguidor=perfil.id_usuario

        return DB::table('seguidor')
        ->join('perfil', 'seguidor.id_usuario_seguidor', '=', 'perfil.id_usuario')
        ->select('nombre','nombre_usuario')
        ->whereNotIn('id_usuario_seguidor', $respuesta)
        ->where('seguidor.id_usuario', '=' ,$id)
        ->limit(4)
        ->get();
    }



}
