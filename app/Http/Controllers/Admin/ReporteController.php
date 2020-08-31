<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class ReporteController extends Controller
{
    
    public function getReporteUsuario($idUser,$tipo){

        $salida = array(); $user = User::find($idUser);
        switch ($tipo) {
            case 'posts':
                $salida['posts'] = array(); //
                $salida['count'] = $user->post->count();
                foreach ($user->post as $post) {
                    if ($post->estado == 't') {
                        $salida['posts'][] = array(
                            'usuario_id' => $idUser,
                            'descripcion' => $post->descripcion,
                            'foto' => $post->fotoBase64,
                            'fecha' => $post->fecha_creada,
                        );
                    }
                }

                break;
            case 'seguidores':
                $salida['seguidores'] = array(); //
                $seguidores = $user->seguidores->where('estado','=','t');
                $salida['count'] = $user->seguidores->where('estado','=','t')->count();
                foreach ($seguidores as $seguidor) {
                    if($seguidor->estado == 't'){
                        $salida['seguidores'][] = array(
                            'usuario_id' => $seguidor->id_usuario_seguidor,
                            'nombre' => $seguidor->usuarioSeguidor->perfil->nombre,
                            'nombre_usuario' => $seguidor->usuarioSeguidor->perfil->nombre_usuario,
                            'foto' => $seguidor->usuarioSeguidor->perfil->fotoBase64,
                            'fecha_hora' => $seguidor->fecha_hora,
                        );
                    }
                }
                break;
            case 'seguidos':
                $salida['seguidos'] = array();
                $seguidos = $user->seguidos->where('estado','=','t');
                $salida['count'] = $user->seguidos->where('estado','=','t')->count();
                foreach ($seguidos as $seguido) {
                    if ($seguido->estado == 't') {
                        $salida['seguidos'][] = array(
                            'usuario_id' => $seguido->id_usuario,
                            'nombre' => $seguido->usuarioSeguido->perfil->nombre,
                            'nombre_usuario' => $seguido->usuarioSeguido->perfil->nombre_usuario,
                            'foto' => $seguido->usuarioSeguido->perfil->fotoBase64,
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
        LogController::storeLog('GET','Get Reporte Admin',json_encode(Session::get('login')));
        return response()->json($salida);

    }
    
}
