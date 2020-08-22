<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Perfil;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    public function index()
    {
        $perfiles = Perfil::all();
        return view('admin.logaccess')->with(compact('perfiles'));
    }

    public function verLog($name)
    {
        $perfil = Perfil::findByUserName($name);
        // $contents = Storage::get($perfil->nombre_usuario . '.log');
        $contents = File::get(storage_path('app\\' . $perfil->nombre_usuario . '.log'));
        $arrayLines = $this->getDatos($contents);
        $len = count($arrayLines);
        $objs = $this->getObjetos($arrayLines);
        $user = $objs[0]['user'];
        // dd(array('perfil' => $perfil, 'file' => $contents, 'arr' => $this->getDatos($contents), 'obj'=>$this->getObjetos($arrayLines) ));

        return view('admin.logaccessuser')->with(compact('perfil', 'arrayLines', 'len','objs'));
    }

    public function getDatos($contents)
    {
        $lines = array();
        $separator = "\r\n";
        $line = strtok($contents, $separator);
        while ($line !== false) {
            $lines[] = $line . "<br>";
            $line = strtok($separator);
        }
        return $lines;
    }
    // ::) date[2020-08-21 20:10:49] POST / HTTP/1.1 view[Autenticado Login Usuario] - user[{"usuario_id":5,"usuario_email":"lucas@gmail.com", "ip_address":"127.0.0.1"}] ::(
    public function getObjetos($arrayLines){
        $salida = array();
        foreach($arrayLines as $line){
            //date
            $posIni = strpos($line,'date[')+5;
            $posFin = strpos($line,']');
            $date = substr($line,$posIni,$posFin-$posIni);

            // view[ ] -
            $posIni = strpos($line,'view[')+5;
            $posFin = strpos($line,'] -');
            $view = substr($line,$posIni,$posFin-$posIni);

            // user[
            $posIni = strpos($line,'user[')+5;
            $posFin = strpos($line,'}]')+1;
            $usuario = substr($line,$posIni,$posFin-$posIni);
            $salida[] = array(
                'fecha' => $date,
                'view' => $view,
                'user' => json_decode($usuario),
            );
        }
        return $salida;

        
    }
}
