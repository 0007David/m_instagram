<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
use Carbon\Carbon;
class ComentarioController extends Controller
{
    public function index(){
        return view('comentarios');
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
