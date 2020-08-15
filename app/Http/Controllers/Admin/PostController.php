<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function index()
    {
        $posts=DB::table('post')
        ->join('perfil', 'post.id_usuario', '=', 'perfil.id_usuario')
        ->select('post.id','post.foto','post.descripcion','post.fecha_actualizada','perfil.nombre','post.estado')
        ->orderBy('post.id')
        ->get();
        return view('admin.postsynotifs')->with(compact('posts'));
    }

    public function show($id)
    {
        $post=DB::table('post')
        ->join('perfil', 'post.id_usuario', '=', 'perfil.id_usuario')
        ->select('post.id','post.foto','post.descripcion','post.fecha_actualizada','perfil.nombre','post.estado')
        ->where('post.id', '=', $id)
        ->first();
        //first no es lo mismo que get, first elimina el array
        return view('admin.postynotif_edit')->with(compact('post'));
    }

    public function update(Request $request)
    {
        
        // dd($request);
        $data = request()->validate([
            'descripcion' => 'required',
            'estado' => 'required',
        ], [
            'descripcion' => 'Es necesario que haya una descripcion',
            'estado' => 'Es necesario que tenga un estado'
        ]);
        $post=Post::findid(request()->id);
        $post->update($data);
        
        return redirect()->route('postsynotifs');
    }

    public function eliminar(Request $request)
    {
        $post=Post::findid($request->id);
        $post->estado=$request->estado;
        $post->save();
        return redirect()->route('postsynotifs');
    }
    
}
