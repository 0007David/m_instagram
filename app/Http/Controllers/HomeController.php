<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        // $usuarios = User::all();
        $usuario = Session::get('login');

        // dd($usuario);
        $user = User::find($usuario['usuario_id']);
    
        $posts = $user->post;

        $seguidores= User::consulta1($usuario['usuario_id']);
        return view('home')->with(compact('posts','usuario','seguidores'));
    }
}
