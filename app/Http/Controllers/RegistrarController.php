<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Perfil;
use App\Configuracion;
class RegistrarController extends Controller
{
    public function index()
    {
        LogController::storeLog('GET','Vista Registrar Usuario',json_encode(Session::get('login')));
        return view('componentes.registrar');
    }

    public function crear(Request $request){
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->estado = 't';            
        $user->save();

        $perfil = new Perfil();
        $perfil->nombre = $request->nombre;
        $perfil->nombre_usuario = $request->nombre_usuario;
        $perfil->id_usuario=$user->id;
        $perfil->save();

        $configuracion = new Configuracion();
        $configuracion->notificaciones = 't'; 
        $configuracion->tema_fondo = 'light'; 
        $configuracion->id_usuario=$user->id;
        $configuracion->save();

        $ip = LoginController::getRealIP() == "127.0.0.1" ? "161.22.208.246": LoginController::getRealIP();
        $location = LoginController::ip_info($ip);

        $datos = array(
            'usuario_id' => $user->id,
            'usuario_email' => $user->email,
            'usuario_estado' => $user->estado,
            'nombre_usuario'=> $perfil->nombre_usuario,
            'nombre' => $perfil->nombre,
            'foto' => $perfil->foto,
            'rol' => $user->rol,
            'notificaciones' => $configuracion->notificaciones,
            'tema_fondo' => $configuracion->tema_fondo,
            'user_agent'=>$request->server('HTTP_USER_AGENT'),
            'ip_address'=>$ip, // trae de $_SERVER['REMOTE_ADDR'];
            'location' => $location
        );
        Session::put('login', $datos);
        LogController::storeLog('POST','Registrar Usuario',json_encode(Session::get('login')));
        return redirect()->route('home');
    }
}
