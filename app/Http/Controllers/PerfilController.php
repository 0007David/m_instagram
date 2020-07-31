<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    
    public function index()
    {
        return view('perfil');
    }
    public function edit()
    {
        return view('perfil_edit');
    }
}
