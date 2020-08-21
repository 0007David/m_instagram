<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Comentario;
use Carbon\Carbon;
use App\Post;
class ComentarioController extends Controller
{
    public function index($id){
        //dd($id);
        $post=Post::find($id);



        LogController::storeLog('GET','Vista Comentario Usuario',json_encode(Session::get('login')));
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
        LogController::storeLog('POST','Insertar Comentario Usuario',json_encode(Session::get('login')));
        return redirect()->route('home');
    }

}
