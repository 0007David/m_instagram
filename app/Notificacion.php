<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacion';

    protected $fillable = [
        'fecha_hora', 'id_post'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
