<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Likes;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function store(Request $request)
    {
        $like = Likes::where('id_usuario', '=', $request->json('usuario_id'))->where('id_post', '=', $request->json('post_id'))->first();
        $exito = false;
        if (!isset($like)) {
            $like = new Likes();
            $like->id_usuario = $request->json('usuario_id');
            $like->id_post = $request->json('post_id');
            $exito = $like->save();
        } else {
            $exito = $like->delete();
        }
        LogController::storeLog('POST','Insertar Like Usuario',json_encode(Session::get('login')));   
        return response()->json(array('exito'=>$exito,'like'=>$like,'likes_count'=>Likes::where('id_post','=',$request->json('post_id'))->count()));
    }
}
