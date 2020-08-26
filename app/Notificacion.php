<?php

namespace App;
use Illuminate\Support\Facades\DB;
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
    public static function findid($id)
    {
        return static::where('id',compact('id'))->first();
    }

    static public function maxID(){
        return DB::table('post')
        ->max('id');
    }
    
}
