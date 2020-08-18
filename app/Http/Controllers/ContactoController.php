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
        return view('contacto')->with(compact('contactos','usuario'));
    }

    public function index2()
    {
        return view('crearcontacto');
    }

    public function crear(Request $request){
        $usuario = Session::get('login');
        $contacto=new Contacto();
        $contacto->telefono=$request->telefono;
        $contacto->id_usuario=$usuario['usuario_id'];
        $contacto->save();
        
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

        return response()->json(array('exito'=>true, 'respuesta'=>$contactos ));

        
    }



}
