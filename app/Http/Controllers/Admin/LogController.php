<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Perfil;
use App\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        $perfiles = Perfil::all();
        return view('admin.logaccess')->with(compact('perfiles'));
    }
}
