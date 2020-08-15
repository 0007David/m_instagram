<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';

    protected $fillable = [
        'telefono', 'id_usuario'
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }
    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }
    
}
