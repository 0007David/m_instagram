<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones=DB::table('configuracion')
        ->join('perfil', 'configuracion.id_usuario', '=', 'perfil.id_usuario')
        ->select('configuracion.id','notificaciones','tema_fondo','perfil.nombre as usuario')
        ->orderBy('configuracion.id')
        ->get();
        LogController::storeLog('GET','Vista Configuracion Admi',json_encode(Session::get('login')));
        return view('admin.configuraciones')->with(compact('configuraciones'));
    }

    public function show($id)
    {
        $configuracion=DB::table('configuracion')
        ->join('perfil', 'configuracion.id_usuario', '=', 'perfil.id_usuario')
        ->select('configuracion.id','notificaciones','tema_fondo','perfil.nombre as usuario')
        ->where('configuracion.id', '=', $id)
        ->first();
        //first no es lo mismo que get, first elimina el array
        LogController::storeLog('GET','Vista Editar Configuracion Admi',json_encode(Session::get('login')));
        return view('admin.configuracion_edit')->with(compact('configuracion'));
    }

    public function update(Request $request)
    {
        
        // dd($request);
        $data = request()->validate([
            'notificaciones' => 'required',
            'tema_fondo' => 'required',
        ], [
            'notificaciones' => 'Las notificaciones no deben ir vacias',
            'tema_fondo' => 'El tema de fondo no puede ir vacio'
        ]);
        $configuracion=Configuracion::findid(request()->id);
        $configuracion->update($data);
        LogController::storeLog('POST','Editar Configuracion Admi',json_encode(Session::get('login')));
        return redirect()->route('configuraciones');
    }
    
}
