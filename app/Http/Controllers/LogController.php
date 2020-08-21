<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    public static function storeLog($tipo, $accion, $tabla, $quien, $descripcion)
    {
        date_default_timezone_set('America/La_Paz');
        $date = date("D M d, Y h:i:sa", time());
        if (Storage::disk('local')->exists('mini_instagram.log')) {
            $content = '::) [ ' . $date . ' ] "' . $tipo . ' / HTTP/1.1" - "' . $accion . '" - "' . $tabla . '" - "' . $quien . '" - "' . $descripcion . '" ::(';
            // Storage::disk('local')->put('mini_instagram.log', $content);
            Storage::append('mini_instagram.log', $content);
        } else {
            $fileName = "mini_instagram.log";
            $content = '::) [ ' . $date . ' ] "' . $tipo . ' / HTTP/1.1" - "' . $accion . '" - "' . $tabla . '" - "' . $quien . '" - "' . $descripcion . '" ::(';
            Storage::disk('local')->put($fileName, $content);
        }
        // LogController::storeLog('GET','obetner','Employee',$quien,$descripcion);
        // LogController::storeLog('POST','almacenar','Patient',$quien,$descripcion);
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
