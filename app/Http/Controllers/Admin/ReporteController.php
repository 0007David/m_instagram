<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class UserController extends Controller
{
    public function index()
    {
        $users=DB::table('usuario')
        ->join('perfil', 'usuario.id', '=', 'perfil.id_usuario')
        ->select('usuario.id','perfil.nombre','perfil.nombre_usuario','usuario.email','perfil.genero')
        ->where('estado','=','t')
        ->orderBy('usuario.id')
        ->get();
        //$users=User::all();
        LogController::storeLog('GET','Vista Reporte Admi',json_encode(Session::get('login')));
        return view('admin.usuarios')->with(compact('users'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
