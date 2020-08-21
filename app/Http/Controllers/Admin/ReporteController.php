<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class ReporteController extends Controller
{
    public function index()
    {
        
        return view('admin.reportes');
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
