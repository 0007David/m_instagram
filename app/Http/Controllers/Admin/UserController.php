<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Perfil;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('usuario')
            ->join('perfil', 'usuario.id', '=', 'perfil.id_usuario')
            ->select('usuario.id', 'perfil.nombre', 'perfil.nombre_usuario', 'usuario.email', 'perfil.genero', 'perfil.fecha_nacimiento', 'perfil.telefono')
            ->where('estado', '=', 't')
            ->orderBy('usuario.id')
            ->get();
        //$users=User::all();
        return view('admin.usuarios')->with(compact('users'));
    }

    public function show($id)
    {

        $user = DB::table('usuario')
            ->join('perfil', 'usuario.id', '=', 'perfil.id_usuario')
            ->select('*')
            ->where('usuario.estado', '=', 't')
            ->where('usuario.id', '=', $id)
            ->first();
        // dd($user);
        return view('admin.usuario_edit')->with(compact('user'));
    }

    public function update(Request $request)
    {
        
        // dd($request);
        $data = request()->validate([
            'email' => 'required',
            'nombre' => 'required',
            'nombre_usuario' => 'required',
            'presentacion' => '',
            'sitio_web' => '',
            'genero' => 'required',
            'fecha_nacimiento' => '',
            'telefono' => '',
        ], [
            'email' => 'El email no puede ir vacio',
            'nombre' => 'Ingrese su nombre completo',
            'nombre_usuario' => 'Ingrese su nombre de ususrio',
            'genero' => 'Ingrese su genero'
        ]);
        $dataUser['email'] = $data['email'];
        $dataUser['estado'] = 't';
        
        $user = User::find(request()->id);
        $user->update($dataUser);
        $perfil = Perfil::find(request()->id);
        $perfil->update($data);
        return redirect()->route('usuarios');
    }
}
