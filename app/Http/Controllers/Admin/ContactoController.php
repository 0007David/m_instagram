<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class ContactoController extends Controller
{
    public function index()
    {
        $contactos=DB::table('contacto')
        ->join('perfil', 'contacto.id_usuario', '=', 'perfil.id_usuario')
        ->select('contacto.id','contacto.telefono as telefono','perfil.nombre as usuario')
        ->orderBy('contacto.id')
        ->get();
        //$users=User::all();
        LogController::storeLog('GET','Vista Contacto Admi',json_encode(Session::get('login')));
        return view('admin.contactos')->with(compact('contactos'));
    }

    public function show($id)
    {
        $contacto=DB::table('contacto')
        ->join('perfil', 'contacto.id_usuario', '=', 'perfil.id_usuario')
        ->select('contacto.id','contacto.telefono as telefono','perfil.nombre as usuario')
        ->where('contacto.id', '=', $id)
        ->first();
        //first no es lo mismo que get, first elimina el array
        LogController::storeLog('GET','Vista Editar Contacto Admi',json_encode(Session::get('login')));
        return view('admin.contacto_edit')->with(compact('contacto'));
    }

    public function update()
    {
        $data = request()->validate([
            'telefono' => 'required',
        ], [
            'telefono' => 'Es necesario colocar un numero de telefono o celular'
        ]);
        $contacto=Contacto::findid(request()->id);
        $contacto->update($data);
        LogController::storeLog('GET','Editar Contacto Admi',json_encode(Session::get('login')));
        return redirect()->route('contactos');
    }
    
}
