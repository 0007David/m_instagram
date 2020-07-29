<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

}
