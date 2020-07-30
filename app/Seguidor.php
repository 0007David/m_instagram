<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    protected $table = 'seguidor';

    protected $fillable = [
        'estado', 'id_usuario','id_usuario_seguidor'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }
    public function usuario2()
    {
        return $this->belongsTo('App\User');
    }
}
