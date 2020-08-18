<?php

namespace App\Http\Controllers;

use App\Notificacion;
use App\Seguidor;
use App\Post;
use App\Perfil;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
            'foto' => $usuario['foto'],
            'cantidad_seguidores'=>Seguidor::ContadorSeguidor($usuario['usuario_id']),
            'cantidad_seguidos'=>Seguidor::ContadorSeguidos($usuario['usuario_id']),
            'cantidad_posts'=>Post::ContadorPosts($usuario['usuario_id'])
        );

        $posts=DB::table('post')
        ->select(DB::raw ("post.id,TRIM(post.foto) as foto,TRIM(post.descripcion) as descripcion,post.fecha_actualizada,post.estado,post.id_usuario"))
        ->orderByDesc('post.fecha_actualizada')
        ->where('post.estado','=','t')
        ->where('post.id_usuario','=',$datos['usuario_id'])
        ->get();

        return view('post')->with(compact('datos','posts'));
    }

    public function insertPost(Request $request){
        $usuario = Session::get('login');
        $date = Carbon::now();
        //$hora = $date->toTimeString();
        $fecha = $date->toDateTimeString();
        

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

                $notificacion = new Notificacion();
                $notificacion->id_post=Notificacion::maxID();
                $notificacion->fecha_hora=$fecha;
                $notificacion->save();
            }
        }
        
        return redirect()->route('home');   
    }

    public function eliminar(Request $request)
    {
        $post=Post::findid($request->id);
        $post->estado=$request->estado;
        $post->save();
        return redirect()->route('post');
    }
}
