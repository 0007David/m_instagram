<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;
class ReporteController extends Controller
{
    public function index()
    {
        LogController::storeLog('GET','Vista Reporte Admi',json_encode(Session::get('login')));
        return view('admin.reportes');

    }
    
}
