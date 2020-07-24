<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('componentes.login');
    }

    public function home(){
        return view('home');
    }

    public function create(){
        
    }

}
