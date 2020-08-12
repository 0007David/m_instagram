<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index()
    {
        $users=DB::table('usuario')
        ->join('perfil', 'usuario.id', '=', 'perfil.id_usuario')
        ->select('usuario.id','perfil.nombre','perfil.nombre_usuario','usuario.email','perfil.genero','perfil.fecha_nacimiento','perfil.telefono')
        ->where('estado','=','t')
        ->orderBy('usuario.id')
        ->get();
        //$users=User::all();
        return view('admin.usuarios')->with(compact('users'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
