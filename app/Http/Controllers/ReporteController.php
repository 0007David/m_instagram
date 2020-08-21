<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReporteController extends Controller
{
    public function getReporte($tipo)
    {
        $usuario = Session::get('login');
        $salida = array();
        switch ($tipo) {
            case 'posts':
                $user = User::find($usuario['usuario_id']);
                $salida['posts'] = array(); //
                $salida['count'] = $user->post->count();
                foreach ($user->post as $post) {
                    if ($post->estado == 't') {
                        $salida['posts'][] = array(
                            'usuario_id' => $usuario['usuario_id'],
                            'descripcion' => $post->descripcion,
                            'foto' => $post->foto,
                            'fecha' => $post->fecha_creada,
                        );
                    }
                }

                break;
            case 'seguidores':
                $user = User::find($usuario['usuario_id']);
                $salida['seguidores'] = array(); //
                $seguidores = $user->seguidores->where('estado','=','t');
                $salida['count'] = $user->seguidores->where('estado','=','t')->count();
                foreach ($seguidores as $seguidor) {
                    if($seguidor->estado == 't'){
                        $salida['seguidores'][] = array(
                            'usuario_id' => $seguidor->id_usuario_seguidor,
                            'nombre' => $seguidor->usuarioSeguidor->perfil->nombre,
                            'nombre_usuario' => $seguidor->usuarioSeguidor->perfil->nombre_usuario,
                            'foto' => $seguidor->usuarioSeguidor->perfil->foto,
                            'fecha_hora' => $seguidor->fecha_hora,
                        );
                    }
                }
                break;
            case 'seguidos':
                $user = User::find($usuario['usuario_id']);
                $salida['seguidos'] = array();
                $seguidos = $user->seguidos->where('estado','=','t');
                $salida['count'] = $user->seguidos->where('estado','=','t')->count();
                foreach ($seguidos as $seguido) {
                    if ($seguido->estado == 't') {
                        $salida['seguidos'][] = array(
                            'usuario_id' => $seguido->id_usuario,
                            'nombre' => $seguido->usuarioSeguido->perfil->nombre,
                            'nombre_usuario' => $seguido->usuarioSeguido->perfil->nombre_usuario,
                            'foto' => $seguido->usuarioSeguido->perfil->foto,
                            'fecha_hora' => $seguido->fecha_hora,
                        );
                    }
                }
                break;
            default:
                $salida['count'] = 0;
                $salida['default'] = array();
                break;
        }

        return response()->json($salida);
    }
}
