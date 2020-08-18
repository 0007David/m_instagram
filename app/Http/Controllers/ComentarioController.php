<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
use Carbon\Carbon;
use App\Post;
class ComentarioController extends Controller
{
    public function index($id){
        //dd($id);
        $post=Post::find($id);




        return view('comentarios')->with(compact('post'));
    }

    public function crear(Request $request)
    {
        $date = Carbon::now();
        //$hora = $date->toTimeString();
        $fecha = $date->toDateTimeString();
        $comentario = new Comentario();
        $comentario->descripcion = $request->descripcion;
        $comentario->id_post = $request->id_post;
        $comentario->id_usuario=$request->id_usuario;
        $comentario->fecha_creada=$fecha;
        $comentario->fecha_actualizada=$fecha;
        $comentario->save();

        return redirect()->route('home');
    }

}
