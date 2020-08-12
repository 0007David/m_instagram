<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function index()
    {
        $posts=DB::table('post')
        ->join('perfil', 'post.id_usuario', '=', 'perfil.id_usuario')
        ->select('post.id','post.foto','post.descripcion','post.fecha_actualizada','perfil.nombre')
        ->orderBy('post.id')
        ->get();
        return view('admin.postsynotifs')->with(compact('posts'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
