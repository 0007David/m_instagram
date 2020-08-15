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
            ->select(DB::raw ("usuario.id as id,TRIM(usuario.email) as email,TRIM(usuario.estado) as estado,usuario.rol,TRIM(perfil.nombre) as nombre,TRIM(perfil.nombre_usuario) as nombre_usuario,TRIM(perfil.foto) as foto,TRIM(perfil.genero) as genero,perfil.fecha_nacimiento,TRIM(perfil.presentacion) as presentacion,TRIM(perfil.sitio_web) as sitio_web,TRIM(perfil.telefono) as telefono"))
            
            ->orderBy('usuario.id')
            ->get();
        //$users=User::all();
        return view('admin.usuarios')->with(compact('users'));
    }

    public function show($id)
    {

        $user = DB::table('usuario')
            ->join('perfil', 'usuario.id', '=', 'perfil.id_usuario')
            ->select(DB::raw ("usuario.id as id,TRIM(usuario.email) as email,TRIM(usuario.estado) as estado,usuario.rol,TRIM(perfil.nombre) as nombre,TRIM(perfil.nombre_usuario) as nombre_usuario,TRIM(perfil.foto) as foto,TRIM(perfil.genero) as genero,perfil.fecha_nacimiento,TRIM(perfil.presentacion) as presentacion,TRIM(perfil.sitio_web) as sitio_web,TRIM(perfil.telefono) as telefono"))
           
            ->where('perfil.id_usuario','=', $id)
            ->first();

        
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
            'fecha_nacimiento' => 'required',
            'telefono' => '',
            'estado' => 'required',
            'rol' => 'required'
        ], [
            'email' => 'El email no puede ir vacio',
            'nombre' => 'Ingrese su nombre completo',
            'nombre_usuario' => 'Ingrese su nombre de usuario',
            'genero' => 'Ingrese su genero',
            'fecha_nacimiento' => 'Ingrese su fecha de nacimiento',
            'estado' => 'Ingrese el estado para el usuario',
            'rol' => 'necesita introducir un rol para este usuario'
        ]);
        $dataUser['email'] = $data['email'];
        $dataUser['estado'] = $data['estado'];
        $dataUser['rol'] = $data['rol'];
        
        $user = User::find(request()->id);
        $user->update($dataUser);
        
        $perfil = Perfil::find(request()->id);
        $perfil->update($data);
        return redirect()->route('usuarios');
    }

    public function eliminar(Request $request)
    {
        $usuario=User::find($request->id);
        $usuario->estado=$request->estado;
        $usuario->save();
        return redirect()->route('usuarios',$usuario->id_usuario);
    }
}
