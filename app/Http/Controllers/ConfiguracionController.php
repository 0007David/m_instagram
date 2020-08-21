<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Configuracion;
class ConfiguracionController extends Controller
{
    public function index()
    {
        LogController::storeLog('GET','Vista Configuracion Usuario',json_encode(Session::get('login')));
        return view('configuracion');
    }

    public function edit()
    {
        $usuario = Session::get('login');
        $configuracion = Configuracion::find($usuario['usuario_id']);
        LogController::storeLog('GET','Vista Editar Configuracion Usuario',json_encode(Session::get('login')));
        return view('configuracion_edit')->with(compact('configuracion'));
    }


    public function update(Request $request)
    {
        $usuario = Session::get('login');
        $configuracion = Configuracion::find($usuario['usuario_id']);
        $configuracion->notificaciones = $request->notificaciones;
        $configuracion->tema_fondo = $request->tema_fondo;
        $configuracion->save();

        // Actualizamos las Configuraciones del Usuario Logueado
        $usuario['notificaciones'] = $request->notificaciones;
        $usuario['tema_fondo'] = $request->tema_fondo;
        Session::forget('login');
        Session::put('login', $usuario);
        LogController::storeLog('POST','Editar Configuracion Usuario',json_encode(Session::get('login')));
        return redirect()->route('home');
    }
}
