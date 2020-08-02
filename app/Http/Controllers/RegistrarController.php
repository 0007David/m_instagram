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
        $configuracion->tema_fondo = 'white'; 
        $configuracion->id_usuario=$user->id;

        $datos = array(
            'usuario_id' => $user->id,
            'usuario_email' => $user->email,
            'usuario_estado' => $user->estado,
            'nombre_usuario'=> $perfil->nombre_usuario,
            'nombre' => $perfil->nombre
        );
        Session::put('login', $datos);

        return redirect()->route('home');
    }
}
