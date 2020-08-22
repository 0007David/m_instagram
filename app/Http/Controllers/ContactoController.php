<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Contacto;
use Illuminate\Support\Facades\DB;
class ContactoController extends Controller
{
    public function index()
    {
        $usuario = Session::get('login');
        $contactos = DB::table('contacto')
            ->select(DB::raw ("contacto.id as id,TRIM(contacto.telefono) as telefono,contacto.id_usuario"))
            ->orderBy('contacto.id')
            ->where('contacto.id_usuario','=',$usuario['usuario_id'])
            ->get();
        LogController::storeLog('GET','Vista Contacto Usuario',json_encode(Session::get('login')));
        return view('contacto')->with(compact('contactos','usuario'));
    }

    public function index2()
    {
        LogController::storeLog('GET','Vista Crear Contacto Usuario',json_encode(Session::get('login')));
        return view('crearcontacto');
    }

    public function crear(Request $request){
        $usuario = Session::get('login');
        $contacto=new Contacto();
        $contacto->telefono=$request->telefono;
        $contacto->id_usuario=$usuario['usuario_id'];
        $resp=$contacto->save();
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se ha creado Contacto Correctamente.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'Ha ocurrido un error a la hora de crear tu Contacto.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Crear Contacto Usuario',json_encode(Session::get('login')));
        return redirect()->route('home');   
    }

    public function compararcontacto()
    {
        $usuario = Session::get('login');
        $contactos = DB::table('contacto')
        ->join('perfil','contacto.telefono','perfil.telefono')
        ->select(DB::raw ("contacto.id,TRIM(perfil.nombre) as nombre,TRIM(perfil.nombre_usuario) as nombre_usuario,perfil.id_usuario,TRIM(perfil.telefono) as telefono"))
        ->orderBy('contacto.id')
        ->where('contacto.id_usuario','=',$usuario['usuario_id'])
        ->get();
        LogController::storeLog('GET','Vista Comparar Contacto Usuario',json_encode(Session::get('login')));
        return response()->json(array('exito'=>true, 'respuesta'=>$contactos ));

    }

    public function show($id)
    {
        $contacto=DB::table('contacto')
        ->join('perfil', 'contacto.id_usuario', '=', 'perfil.id_usuario')
        ->select(DB::raw ("contacto.id,TRIM(contacto.telefono) as telefono,TRIM(perfil.nombre) as usuario"))
        ->where('contacto.id', '=', $id)
        ->first();
        //first no es lo mismo que get, first elimina el array
        LogController::storeLog('GET','Vista Editar Contacto Usuario',json_encode(Session::get('login')));
        return view('contacto_edit')->with(compact('contacto'));
    }

    public function update()
    {
        $data = request()->validate([
            'telefono' => 'required',
        ], [
            'telefono' => 'Es necesario colocar un numero de telefono o celular'
        ]);
        $contacto=Contacto::findid(request()->id);
        $resp = $contacto->update($data);
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se ha editado tu contacto correctamente.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'No se ha editado tu contacto.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Editar Contacto Usuario',json_encode(Session::get('login')));
        return redirect()->route('contacto');
    }

    public function delete(Request $request)
    {   
    
        $contacto=Contacto::findid(request()->id);
        $resp=$contacto->delete();
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se ha eliminado tu Contacto Correctamente.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'Ha ocurrido un error a la hora de eliminar tu Contacto.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Eliminar Contacto Usuario',json_encode(Session::get('login')));
        return redirect()->route('contacto');
    }



}
