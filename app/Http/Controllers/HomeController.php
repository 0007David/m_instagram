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
        $usuario = Session::get('login');

        $user = User::find($usuario['usuario_id']);
        $seguidosIds = $user->array_seguidos;

        $posts = Post::where('estado', '=','t')
            ->whereIn('id_usuario', $seguidosIds)
            ->orwhere('id_usuario', '=', $usuario['usuario_id'])
            ->orderByDesc('id')
            ->get();
        // $onlySeguidores = array_slice($seguidoresIds,0,(count($seguidoresIds) > 4 )? 4: count($seguidoresIds));
        $seguidores= $user->seguidores->where('estado','=','t')->take(4);
        LogController::storeLog('GET','Vista Home Usuario',json_encode($usuario));

        return view('home')->with(compact('posts', 'usuario', 'seguidores'));
    }

    public function search(Request $request){

        $query = $request->q; $amigos = array();
        if(isset($query)){
            $query = strtolower($query);
            $amigos = Perfil::where('nombre_usuario','like','%'.$request->q.'%')->where('id_usuario','!=', $request->usuarioId)->get();
        }
        LogController::storeLog('POST','Search Usuario',json_encode(Session::get('login')));
        return response()->json(array('answer'=>$amigos,'count'=>count($amigos)));
    }

    public function searchByAttr($attr, $query)
    {   
        // dd($query);
        $amigo = array();
        if(isset($query) && isset($attr) ){
            if($attr == 'email'){
                $amigo = User::where($attr,'=',$query)->first();
            }else{
                $amigo = Perfil::where($attr,'=',$query)->first();

            }
        }
        return response()->json(array('exito'=> true,'answer'=>$amigo));
    }
}
