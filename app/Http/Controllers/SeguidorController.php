<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Seguidor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeguidorController extends Controller
{
    public function index($name)
    {   
        $perfil = Perfil::findByUserName($name);
        return view('seguido')->with(compact('perfil'));
    }

    public function getSeguidores($idUsuario)
    {   
        $user = User::find($idUsuario);
        $seguidores = $user->seguidores;
        $salida['seguidores'] = array(); //
        $salida['count'] = $user->seguidores->count();
        foreach($seguidores as $seguidor){
            $seg = $seguidor->loEstoySiguiendo($seguidor->id_usuario_seguidor);
            $salida['seguidores'][] = array(
                'usuario_id' => $seguidor->usuarioSeguidor->perfil->id_usuario,
                'nombre' => $seguidor->usuarioSeguidor->perfil->nombre,
                'nombre_usuario' => $seguidor->usuarioSeguidor->perfil->nombre_usuario,
                'foto' => $seguidor->usuarioSeguidor->perfil->foto,
                'fecha_hora' => $seguidor->fecha_hora,
                'loEstoySiguiendo' => is_null($seg) ? false:true
            );
        }
        return response()->json($salida);
    }

    public function getSeguidor($id){
        $user = User::find($id);
        return response()->json(array('status'=>true,'perfil'=>$user->perfil));
    }

    public function store(Request $request)
    {
        $seguidor = Seguidor::where('id_usuario', '=', $request->json('usuario_seg_id'))
                    ->where('id_usuario_seguidor', '=', $request->json('usuario_id'))->first();
        $exito = false;
        if (!isset($seguidor)) {
            if($request->json('seguir')){
                $seguidor = new Seguidor();
                $seguidor->id_usuario = $request->json('usuario_seg_id');
                $seguidor->id_usuario_seguidor =  $request->json('usuario_id');
                $seguidor->estado='t';
                $exito = $seguidor->save();
            }
        } else if(!$request->json('seguir')){
            $seguidor->estado='f';
            $exito = $seguidor->update();
        }else{
            $seguidor->estado='t';
            $date = Carbon::now();
            $seguidor->fecha_hora = $date->toDateTimeString();
            $exito = $seguidor->update();
            dd($seguidor);
        }
        return response()->json(array('exito'=>$exito,'seguidor'=>$seguidor->usuarioSeguido->perfil,'seguir'=>$request->json('seguir')));
    }
}
