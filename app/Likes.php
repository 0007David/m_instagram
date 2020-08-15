<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'estado', 'id_usuario','id_post'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }
}
