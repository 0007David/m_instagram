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
        $perfil = Perfil::find($usuario['usuario_id']);
        $posts = Post::where('id_usuario', '=', $usuario['usuario_id'])
            ->where('estado','=','t')
            ->orderByDesc('id')
            ->get();
        LogController::storeLog('GET','Vista Post Usuario',json_encode(Session::get('login')));    
        return view('post')->with(compact('datos','posts','perfil'));
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
            $moved =$file->move($path, $fileName);
            if ($moved) {
                $post = new Post();
                $post->foto = $fileName;
                $post->descripcion = $request->descripcion;
                $post->fecha_creada = $fecha;
                $post->fecha_actualizada = $fecha;        
                $post->id_usuario=$usuario['usuario_id'];
                $resp = $post->save();

                $notificacion = new Notificacion();
                $notificacion->id_post=Notificacion::maxID();
                $notificacion->descripcion = "@". $post->user->perfil->nombre_usuario. " ha publicado un post: '". $post->resumenDescripcion ."'";
                $notificacion->fecha_hora=$fecha;
                $notificacion->save();
            }
        }

        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Has publicado un Post.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'No se pudo publicar tu Post.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Insertar Post Usuario',json_encode(Session::get('login')));   
        return redirect()->route('home');   
    }

    public function eliminar(Request $request)
    {
        $post=Post::findid($request->id);
        $post->estado=$request->estado;
        $resp=$post->save();
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se a eliminado tu Post Correctamente.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'Ha ocurrido un error a la hora de eliminar tu Post.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Eliminar Post Usuario',json_encode(Session::get('login')));   
        return redirect()->route('post');
    }
}
