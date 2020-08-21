<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class PostController extends Controller
{
    public function index()
    {
        $posts=DB::table('post')
        ->join('perfil', 'post.id_usuario', '=', 'perfil.id_usuario')
        ->select(DB::raw ("post.id,TRIM(post.foto) as foto,TRIM(post.descripcion) as descripcion,post.fecha_actualizada,TRIM(perfil.nombre) as nombre,post.estado"))
        ->orderBy('post.id')
        ->get();
        LogController::storeLog('GET','Vista Post Admi',json_encode(Session::get('login')));
        return view('admin.postsynotifs')->with(compact('posts'));
    }

    public function show($id)
    {
        $post=DB::table('post')
        ->join('perfil', 'post.id_usuario', '=', 'perfil.id_usuario')
        ->select(DB::raw ("post.id,TRIM(post.foto) as foto,TRIM(post.descripcion) as descripcion,post.fecha_actualizada,TRIM(perfil.nombre) as nombre,post.estado"))
        ->where('post.id', '=', $id)
        ->first();
        //first no es lo mismo que get, first elimina el array
        LogController::storeLog('GET','Vista Editar Post Admi',json_encode(Session::get('login')));
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
        LogController::storeLog('POST','Editar Post Admi',json_encode(Session::get('login')));
        return redirect()->route('postsynotifs');
    }

    public function eliminar(Request $request)
    {
        $post=Post::findid($request->id);
        $post->estado=$request->estado;
        $post->save();
        LogController::storeLog('POST','Eliminar Post Admi',json_encode(Session::get('login')));
        return redirect()->route('postsynotifs');
    }
    
}
