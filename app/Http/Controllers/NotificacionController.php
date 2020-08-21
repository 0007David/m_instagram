<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificacionController extends Controller
{
    
    public function deleteNotificacion(){
        $notificacion = array();
        if(Session::has('msj')){
            $notificacion = Session::get('msj');
            Session::forget('msj');
        }
        return response()->json(array('status'=>true,'notify'=>$notificacion));
    }
}
