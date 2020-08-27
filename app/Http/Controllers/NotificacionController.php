<?php

namespace App\Http\Controllers;

use App\Notificacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificacionController extends Controller
{

    public function deleteNotificacion()
    {
        $notificacion = array();
        if (Session::has('msj')) {
            $notificacion = Session::get('msj');
            Session::forget('msj');
        }
        return response()->json(array('status' => true, 'notify' => $notificacion));
    }

    public function getNotificaciones(Request $request)
    {

        $usuarioId =  $request->usuarioId;

        $user = User::find($usuarioId);
        $seguidos = $user->seguidos->where('estado', '=', 't');
        $salida = array();
        // dd($seguidos);
        foreach ($seguidos as $seguido) {
            $postsUsuario = $seguido->usuarioSeguido->post;
            foreach ($postsUsuario as $post) { //usuarioSeguido->post
                if (isset($post->notificacion) && !empty($post->notificacion)) {
                    if ($post->notificacion->estado == 't') {
                        $salida['noty_posts'][] = $post->notificacion;
                        
                    }
                }
            }
        }
        $seguidores = $user->seguidores->where('estado', '=', 't');
        foreach ($seguidores as $seguido) {
            $notificacion = $seguido->notificacion;
            if (isset($notificacion) && !empty($notificacion)) {
                if ($notificacion->estado == 't') {
                    $salida['noty_seguidores'][] = array(
                        'descripcion'=> $notificacion->descripcion,
                        'estado'=> $notificacion->estado,
                        'fecha_hora'=> $notificacion->fecha_hora,
                        'id'=> $notificacion->id,
                        'id_seguidor'=> $notificacion->id_seguidor,
                        'usuario_seguidor'=> $notificacion->seguidor->usuarioSeguidor->perfil->nombre_usuario
                    );
                     
                }
            }
        }
        return response()->json(array('status' => true, 'notify' => $salida));
    }
    public function deleteNotificacionPostSeguidor(Request $request)
    {
        $idNotify  =  $request->notify_id;
        $notificacion = Notificacion::find($idNotify);
        $notificacion->estado = 'f';
        $notificacion->save();
        return response()->json($notificacion);
    }
}
