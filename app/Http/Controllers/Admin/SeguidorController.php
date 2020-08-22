<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Perfil;
use App\Seguidor;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class SeguidorController extends Controller
{
    public function index($id)
    {
        $usuario=Perfil::find($id);
        $seguidores=DB::table('seguidor')
        ->join('perfil as p', 'seguidor.id_usuario', '=', 'p.id_usuario')
        ->join('perfil as h', 'seguidor.id_usuario_seguidor', '=', 'h.id_usuario')
        ->select('seguidor.id as id','p.nombre as usuario','h.nombre as usuario_seguidor','seguidor.estado')
        ->orderBy('seguidor.id')
        ->where('seguidor.id_usuario','=',$id)
        ->get();
        LogController::storeLog('GET','Vista Seguidor Admi',json_encode(Session::get('login')));
        return view('admin.seguidores')->with(compact('seguidores','usuario'));
    }

    public function eliminar(Request $request)
    {
        $seguidor=Seguidor::findid($request->id);
        $seguidor->estado=$request->estado;
        $resp=$seguidor->save();
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se ha eliminado el Seguidor Correctamente.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'Ha ocurrido un error a la hora de eliminar el Seguidor.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Eliminar Seguidor Admi',json_encode(Session::get('login')));
        return redirect()->route('seguidores',$seguidor->id_usuario);
    }

    
}
