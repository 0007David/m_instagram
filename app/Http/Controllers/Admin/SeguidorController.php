<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class SeguidorController extends Controller
{
    public function index()
    {
        $seguidores=DB::table('seguidor')
        ->join('perfil as p', 'seguidor.id_usuario', '=', 'p.id_usuario')
        ->join('perfil as h', 'seguidor.id_usuario_seguidor', '=', 'h.id_usuario')
        ->select('seguidor.id as id','p.nombre as usuario','h.nombre as usuario_seguidor')
        ->where('estado','=','t')
        ->orderBy('seguidor.id')
        ->get();
        return view('admin.seguidores')->with(compact('seguidores'));
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
