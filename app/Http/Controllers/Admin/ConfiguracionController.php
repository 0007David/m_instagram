<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones=DB::table('configuracion')
        ->join('perfil', 'configuracion.id_usuario', '=', 'perfil.id_usuario')
        ->select('configuracion.id','notificaciones','tema_fondo','perfil.nombre as usuario')
        ->orderBy('configuracion.id')
        ->get();
        return view('admin.configuraciones')->with(compact('configuraciones'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
