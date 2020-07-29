<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    
    public function post()
    {
        return $this->belongsTo('App\User', 'id_usuario');
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
    }

    
}
