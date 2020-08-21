<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Seguidor;
use App\Post;
use App\User;
use App\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class PerfilController extends Controller
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
        $posts = Post::where('id_usuario', '=', $usuario['usuario_id'])
            ->where('estado','=','t')
            ->orderByDesc('id')
            ->get();
        return view('perfil')->with(compact('datos','posts'));
    }
    public function edit()
    { 
        $usuario = Session::get('login');

        $user = User::find($usuario['usuario_id']);
        $perfil = Perfil::find($usuario['usuario_id']);
        return view('perfil_edit')->with(compact('perfil','user'));;
    }

    public function update(Request $request)
    {
        $usuario = Session::get('login');
        $perfil = Perfil::find($usuario['usuario_id']);
        $perfil->nombre = $request->nombre;
        $perfil->nombre_usuario = $request->nombre_usuario;
        $perfil->presentacion = $request->presentacion;
        $perfil->sitio_web = $request->sitio_web;
        $perfil->genero = $request->genero;
        $perfil->fecha_nacimiento = $request->fecha_nacimiento;
        $perfil->telefono = $request->telefono;
        $perfil->save();

        $user = User::find($usuario['usuario_id']);
        $user->email = $request->email;
        //$user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('home');
    }

    public function updatePass(Request $request){
        $usuario = Session::get('login');
        $user = User::find($usuario['usuario_id']);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('home');
    }

    public function updateFoto(Request $request){
        $usuario = Session::get('login');
        $perfil = Perfil::find($usuario['usuario_id']);

        $file = $request->file('foto');
        if($file->extension()=='png' || $file->extension()=='jpeg' || $file->extension()=='jpg')
        {
            $path = public_path() . '/Imagen';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) {
                $perfil->foto = $fileName;
                $perfil->save();
            }
        }
        return redirect()->route('home');
    }
}
