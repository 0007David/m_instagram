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
            //161.22.208.246
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
            
            LogController::storeLog('POST','Autenticado Login Usuario',json_encode($datos));
            return redirect()->route('home');
        }else{
            $ip = LoginController::getRealIP() == "127.0.0.1" ? "161.22.208.246": LoginController::getRealIP();
            $location = LoginController::ip_info("161.22.208.246");
            $datos = array(
                'usuario_id' => 0,
                'usuario_email' =>$credentials['email'],
                'password' => $credentials['password'],
                'user_agent'=>$request->server('HTTP_USER_AGENT'),
                'ip_address'=>$ip, // trae de $_SERVER['REMOTE_ADDR'];
                'location'=> $location
            );
            LogController::storeLog('POST','No Autenticado Login Usuario',json_encode($datos));
        }
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
    
    static public function getRealIP(){

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
    
    static public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
    
}
