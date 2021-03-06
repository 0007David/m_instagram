<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Perfil;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
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
        LogController::storeLog('GET','Vista Usuario Admi',json_encode(Session::get('login')));
        return view('admin.usuarios')->with(compact('users'));
    }

    public function show($id)
    {

        $user = DB::table('usuario')
            ->join('perfil', 'usuario.id', '=', 'perfil.id_usuario')
            ->select(DB::raw ("usuario.id as id,TRIM(usuario.email) as email,TRIM(usuario.password) as password,TRIM(usuario.estado) as estado,usuario.rol,TRIM(perfil.nombre) as nombre,TRIM(perfil.nombre_usuario) as nombre_usuario,TRIM(perfil.foto) as foto,TRIM(perfil.genero) as genero,perfil.fecha_nacimiento,TRIM(perfil.presentacion) as presentacion,TRIM(perfil.sitio_web) as sitio_web,TRIM(perfil.telefono) as telefono"))
           
            ->where('perfil.id_usuario','=', $id)
            ->first();

        LogController::storeLog('GET','Vista Editar Usuario Admi',json_encode(Session::get('login')));
        return view('admin.usuario_edit')->with(compact('user'));
    }

    public function update(Request $request)
    {
        
        // dd($request);
        $data = request()->validate([
            'email' => 'required',
            'password' => '',
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
            'password' => 'El password no puede ir vacio',
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
        
        $dataUser['password'] = (isset($data['password']) && !empty($data['password'])? Hash::make($data['password']): "" );
        if($dataUser['password'] == "" ){
            unset($dataUser['password']);
        }

        $user = User::find(request()->id);
        $user->update($dataUser);
        
        $perfil = Perfil::find(request()->id);
        $resp=$perfil->update($data);
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se ha actualizado el Perfil Correctamente.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'Ha ocurrido un error a la hora de actualizar el Perfil.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Editar Usuario Admi',json_encode(Session::get('login')));
        return redirect()->route('usuarios');
    }

    public function eliminar(Request $request)
    {
        $usuario=User::find($request->id);
        $usuario->estado=$request->estado;
        $resp=$usuario->save();
        //-- Mensje
        $message=array();
        if($resp){
            $message['mensaje'] = 'Se ha baneado correctamente el usuario.';
            Session::put('msj', $message);
        }else{
            $message['mensaje'] = 'Ha ocurrido un error a la hora de banear el Usuario.';
            Session::put('msj', $message);
        }
        LogController::storeLog('POST','Eliminar Usuario Admi',json_encode(Session::get('login')));
        return redirect()->route('usuarios',$usuario->id_usuario);
    }
}
