<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    // LogController::storeLog('GET','home','user['.json_encode($usuario) .']');
    public static function storeLog($tipo, $vista, $who)
    {
        $usuario = Session::get('login');
        $fileName = $usuario['nombre_usuario'].'.log';
        date_default_timezone_set('America/La_Paz');
        // ::) date[2020-08-10 -10:0392.99] "GET / HTTP/1.1" - "Home" - user[{user_id: id,ip: ip,view:home,}]" ::(
        if (Storage::disk('local')->exists($fileName)) {
            $content = '::) date['. date('Y-m-d H:i:s') . '] ' . $tipo . ' / HTTP/1.1 ' . 'view['.$vista . '] - user['. $who .'] ::(';
            Storage::append('mini_instagram.log', $content);
        } else {
            $content = '::) date['. date('Y-m-d H:i:s') . '] ' . $tipo . ' / HTTP/1.1 ' . 'view['.$vista . '] - user['. $who .'] ::(';
            Storage::disk('local')->put($fileName, $content);
        }
    }

    public function contadorVistas(Request $request)
    {
        $step = array();
        if(is_null(Session::get('count_view'))){         
            $views = array();
            Session::put('count_view', $views);
        }
        $views = Session::get('count_view'); $step['medio_view'] = $views;
        $ruta = $request->json('vista');
        $step['param_vista'] = $views;
        if( isset($views[$ruta])){
            $counter = $views[$ruta];
            $counter++;
            $views[$ruta] = $counter;
            Session::forget('count_view');
            Session::put('count_view', $views);
        }else{
            $counter = $request->json('counter');
            $counter++;
            $views[$ruta] = $counter;
            Session::forget('count_view');
            Session::put('count_view', $views);
        }
        
        return response()->json(array('exito'=>true,'views'=>$views, 'counter'=>$views[$ruta]));
    }
}
