<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Seguidor;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeguidorController extends Controller
{
    public function index($name)
    {
        $usuario = Session::get('login');
        $perfil = Perfil::findByUserName($name);

        $posts = Post::where('id_usuario', '=', $perfil->id_usuario)
            ->where('estado', '=', 't')
            ->orderByDesc('id')
            ->get();
        LogController::storeLog('GET', 'Vista Seguidor Usuario', json_encode(Session::get('login')));
        return view('seguido')->with(compact('perfil', 'posts'));
    }

    public function getSeguidores($idUsuario)
    {
        $user = User::find($idUsuario);
        $seguidores = $user->seguidores;
        $salida['seguidores'] = array(); //
        $salida['count'] = $user->seguidores->count();
        foreach ($seguidores as $seguidor) {
            $seg = $seguidor->loEstoySiguiendo($seguidor->id_usuario_seguidor);
            $salida['seguidores'][] = array(
                'usuario_id' => $seguidor->usuarioSeguidor->perfil->id_usuario,
                'nombre' => $seguidor->usuarioSeguidor->perfil->nombre,
                'nombre_usuario' => $seguidor->usuarioSeguidor->perfil->nombre_usuario,
                'foto' => $seguidor->usuarioSeguidor->perfil->foto,
                'fecha_hora' => is_null($seg) ? $seguidor->fecha_hora:$seg->fecha_hora,
                'loEstoySiguiendo' => is_null($seg) ? false : true
            );
        }
        LogController::storeLog('GET', 'Get Seguidores Usuario', json_encode(Session::get('login')));
        return response()->json($salida);
    }

    public function getSeguidor($id)
    {
        $user = User::find($id);
        LogController::storeLog('GET', 'Get Seguidor Usuario', json_encode(Session::get('login')));
        return response()->json(array('status' => true, 'perfil' => $user->perfil));
    }

    public function store(Request $request)
    {
        $seguidor = Seguidor::where('id_usuario', '=', $request->json('usuario_seg_id'))
            ->where('id_usuario_seguidor', '=', $request->json('usuario_id'))->first();
        $exito = false;
        if (is_null($seguidor)) {
            if ($request->json('seguir')) {
                $seguidor = new Seguidor();
                $seguidor->id_usuario = $request->json('usuario_seg_id');
                $seguidor->id_usuario_seguidor =  $request->json('usuario_id');
                $seguidor->estado = 't';
                $seguidor->fecha_hora = date('Y-m-d H:i:s');
                $exito = $seguidor->save();
            }
        } else if (!$request->json('seguir')) {
            $seguidor->estado = 'f';
            $exito = $seguidor->update();
        } else {
            $seguidor->estado = 't';
            $seguidor->fecha_hora = date('Y-m-d H:i:s');//date('Y-m-d H:i:s');
            $exito = $seguidor->update();
        }
        LogController::storeLog('POST', 'Store Seguidor Usuario', json_encode(Session::get('login')));
        return response()->json(array('exito' => $exito, 'seguidor' => $seguidor->usuarioSeguido->perfil, 'seguir' => $request->json('seguir')));
    }
}
