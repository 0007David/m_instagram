<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class ContactoController extends Controller
{
    public function index()
    {
        $contactos=DB::table('contacto')
        ->join('perfil', 'contacto.id_usuario', '=', 'perfil.id_usuario')
        ->select('contacto.id_usuario','contacto.telefono as telefono','perfil.nombre as usuario')
        ->orderBy('contacto.id_usuario')
        ->get();
        //$users=User::all();
        return view('admin.contactos')->with(compact('contactos'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
