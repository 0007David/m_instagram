<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comentario;
use Illuminate\Support\Facades\DB;
class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios=DB::table('comentario')
        ->join('perfil as a', 'comentario.id_usuario', '=', 'a.id_usuario')
        ->join('post', 'post.id', '=', 'comentario.id_post')
        ->join('perfil as b', 'post.id_usuario', '=', 'b.id_usuario')
        ->select('comentario.id as id','comentario.descripcion as descripcion','a.nombre as nombre_usuario','comentario.id_post as id_post','b.nombre as dueño_post','comentario.fecha_actualizada as fecha','post.foto')
        ->orderBy('comentario.id')
        ->get();
    
        return view('admin.comentarios')->with(compact('comentarios'));
    }

    public function show($id)
    {
        $comentario=DB::table('comentario')
        ->join('perfil as a', 'comentario.id_usuario', '=', 'a.id_usuario')
        ->join('post', 'post.id', '=', 'comentario.id_post')
        ->join('perfil as b', 'post.id_usuario', '=', 'b.id_usuario')
        ->select('comentario.id as id','comentario.descripcion as descripcion','a.nombre as nombre_usuario','comentario.id_post as id_post','b.nombre as dueño_post','comentario.fecha_actualizada as fecha','post.foto')
        ->where('comentario.id', '=', $id)
        ->first();
        //first no es lo mismo que get, first elimina el array
        return view('admin.comentario_edit')->with(compact('comentario'));
    }

    public function update(Request $request)
    {
        
        // dd($request);
        $data = request()->validate([
            'descripcion' => 'required',
        ], [
            'descripcion' => 'Necesita agregar una descripcion al comentario'
        ]);
        $comentario=Comentario::findid(request()->id);
        $comentario->update($data);
        
        return redirect()->route('comentarios');
    }
    
}
