<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
        $mensaje = 'Su correo o contraseña son incorrectos!';
        if (LoginController::auth()) {
            $mensaje = 'Wellcome to Instagram!';
        }
        return view('componentes.login')->with(compact('mensaje'));
    }


    /**
     * authenticate
     */
    public function autenticar(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::findByEmail($credentials['email']);
        if (isset($user) &&  $user->estado=='t' && $this->verificar($credentials)) {
            // Authentication passed...
            //creamos la sesion traemos los datos nesesarios del usuario 
            // session_start();
            
            $perfil = $user->perfil;
            $configuracion=$user->configuracion;
            
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
                'ip_address'=>$this->getRealIP() // trae de $_SERVER['REMOTE_ADDR'];
            );
            Session::put('login', $datos);
            
            LogController::storeLog('POST','Autenticado Login Usuario',json_encode($datos));
            return redirect()->route('home');
        }else{
            $datos = array(
                'usuario_id' => 0,
                'usuario_email' =>$credentials['email'],
                'password' => $credentials['password'],
                'user_agent'=>$request->server('HTTP_USER_AGENT'),
                'ip_address'=>$this->getRealIP() // trae de $_SERVER['REMOTE_ADDR'];
            );
            LogController::storeLog('POST','No Autenticado Login Usuario',json_encode($datos));
        }

        $request->session()->flash('status', 'Task was successful!');

        return back();
    }

    static public function auth()
    {
        return true;
    }

    private function verificar($credentials)
    {
        $usuario = User::findByEmail($credentials['email']);

        $password = $credentials['password'];
        if (Hash::check($password, optional($usuario)->password)) {

            return true;
        }
        
        return false;
    }

    public function logout(){

        // Session::forget('login');
        LogController::storeLog('GET','Logout Usuario',json_encode(Session::get('login')));
        LogController::storeLog('POST','Historial Usuario',json_encode(Session::get('count_view')));
        Session::flush();

        return redirect('/');
    }
    
    function getRealIP(){

        if (isset($_SERVER["HTTP_CLIENT_IP"])){

            return $_SERVER["HTTP_CLIENT_IP"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

            return $_SERVER["HTTP_X_FORWARDED"];

        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

            return $_SERVER["HTTP_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_FORWARDED"])){

            return $_SERVER["HTTP_FORWARDED"];

        }else{

            return $_SERVER["REMOTE_ADDR"];

        }
    }       
    
}
