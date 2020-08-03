<?php

namespace App\Http\Controllers;
use App\Seguidor;
use App\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;
class PostController extends Controller
{
    
   
    public function index()
    {
        $usuario = Session::get('login');
        //dd($usuario);
        $datos = array(
            'usuario_id' => $usuario['usuario_id'],
            'nombre_usuario'=> $usuario['nombre_usuario'],
            'nombre' => $usuario['nombre'],
            'cantidad_seguidores'=>Seguidor::ContadorSeguidor($usuario['usuario_id']),
            'cantidad_seguidos'=>Seguidor::ContadorSeguidos($usuario['usuario_id']),
            'cantidad_posts'=>Post::ContadorPosts($usuario['usuario_id'])
        );
        return view('post')->with(compact('datos'));
    }

    public function insertPost(Request $request){
        $usuario = Session::get('login');
        $date = Carbon::now();
        //$hora = $date->toTimeString();
        $fecha = $date->toDateString();
        

        $file = $request->file('foto');
        if($file->extension()=='png' || $file->extension()=='jpeg' || $file->extension()=='jpg')
        {
            $path = public_path() . '/Imagen';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) {
                $post = new Post();
                $post->foto = $fileName;
                $post->descripcion = $request->descripcion;
                $post->fecha_creada = $fecha;
                $post->fecha_actualizada = $fecha;        
                $post->id_usuario=$usuario['usuario_id'];
                $post->save();
            }
        }
        
        return redirect()->route('home');   
    }
}
