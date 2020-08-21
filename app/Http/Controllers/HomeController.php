<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Post;
use App\Perfil;

class HomeController extends Controller
{
    public function index()
    {
        // $usuarios = User::all();
        $usuario = Session::get('login');

        $user = User::find($usuario['usuario_id']);
        $seguidosIds = $user->array_seguidos;

        $posts = Post::where('estado', '=','t')
            ->whereIn('id_usuario', $seguidosIds)
            ->orwhere('id_usuario', '=', $usuario['usuario_id'])
            ->orderByDesc('id')
            ->get();
        // $onlySeguidores = array_slice($seguidoresIds,0,(count($seguidoresIds) > 4 )? 4: count($seguidoresIds));
        $seguidores= $user->seguidores->only($user->array_seguidores);
        LogController::storeLog('GET','obetner','Home','quien','descripcion');
        return view('home')->with(compact('posts', 'usuario', 'seguidores'));
    }

    public function search(Request $request){
        // dd($request);
        $query = $request->q; $amigos = array();
        if(isset($query)){
            $query = strtolower($query);
            $amigos = Perfil::where('nombre_usuario','like','%'.$request->q.'%')->get();
        }

        return response()->json(array('answer'=>$amigos,'count'=>count($amigos)));
    }
}
