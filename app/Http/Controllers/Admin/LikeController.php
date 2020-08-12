<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class LikeController extends Controller
{
    public function index()
    {
        $likes=DB::table('likes')
        ->join('perfil as a', 'likes.id_usuario', '=', 'a.id_usuario')
        ->join('post', 'post.id', '=', 'likes.id_post')
        ->join('perfil as b', 'post.id_usuario', '=', 'b.id_usuario')
        ->select('likes.id as id','a.nombre as nombre_usuario','likes.id_post as id_post','b.nombre as dueño_post')
        ->orderBy('likes.id')
        ->get();
        return view('admin.likes')->with(compact('likes'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
