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
        if(LoginController::auth()){
            $mensaje = 'Wellcome to Instagram!';
        }
        return view('componentes.login')->with(compact('mensaje'));
    }

    public function home()
    {
        $usuarios = User::all();
        $password = '12932388';
        $user = User::find(12);
        $user->password = Hash::make($password);
        $user->save();

        return view('home')->with(compact('usuarios'));;
    }


    /**
     * authenticate
     */
    public function autenticar(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if ( $this->verificar($credentials) ) {
            // Authentication passed...
            //creamos la sesion traemos los datos nesesarios
            //del usuario 
            // session_start();
            return redirect()->route('home');
        }
        
       
        
        
        
        // // echo var_dump($_SESSION);
        
        return back();
    }

    static public function auth(){
        return true;
    }

    private function verificar($credentials){

        return true;
    }


}
