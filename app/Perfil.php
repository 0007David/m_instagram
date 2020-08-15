<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public static function find($id)
    {
        return static::where('id_usuario',compact('id'))->first();
    }
    public function usuario()
    {
        return $this->belongsTo('App\User');
    }
    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }

}
