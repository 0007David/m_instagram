<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Perfil;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LogController;

class EstadisticaController extends Controller
{
    public function index()
    {
        
        $usuario = Session::get('login');;
        $user = User::find($usuario['usuario_id']);
        $seguidores = $user->seguidores;
        $count_seguidores = $seguidores->count();
        $count_seguidores_m = 0;
        $count_seguidores_f = 0; 
        $estadisticaEdades =array( //less=menor great=mayor between=entre
            'Menor_17' =>array('count'=>0,'count_m'=>0,'count_f'=>0,'percent_m'=>0,'percent_f'=>0),
            '18_b_28' => array('count'=>0,'count_m'=>0,'count_f'=>0,'percent_m'=>0,'percent_f'=>0),
            '29_b_48' => array('count'=>0,'count_m'=>0,'count_f'=>0,'percent_m'=>0,'percent_f'=>0),
            '49_b_64' => array('count'=>0,'count_m'=>0,'count_f'=>0,'percent_m'=>0,'percent_f'=>0),
            'Mayor_65' => array('count'=>0,'count_m'=>0,'count_f'=>0,'percent_m'=>0,'percent_f'=>0),
        );
        foreach ($seguidores as $seguidor) {
            $edad = $seguidor->usuarioSeguidor->perfil->edad;
            switch ($edad) {
                    // -17,18-28,29-48,49-64,65+
                case $edad < 17:
                    $estadisticaEdades['Menor_17']['count'] +=1; 
                    if ($seguidor->usuarioSeguidor->perfil->genero == 'm') {
                        $count_seguidores_m++;
                        $estadisticaEdades['Menor_17']['count_m'] +=1; 
                    } else {
                        $count_seguidores_f++;
                        $estadisticaEdades['Menor_17']['count_f'] +=1; 
                    }
                    break;
                case ($edad > 17) && ($edad < 29):
                    $estadisticaEdades['18_b_28']['count'] +=1;
                    if ($seguidor->usuarioSeguidor->perfil->genero == 'm') {
                        $count_seguidores_m++;
                        $estadisticaEdades['18_b_28']['count_m'] +=1; 
                    } else {
                        $count_seguidores_f++;
                        $estadisticaEdades['18_b_28']['count_f'] +=1; 
                    }
                    break;
                case ($edad > 28) && ($edad < 49):
                    $estadisticaEdades['29_b_48']['count'] +=1;
                    if ($seguidor->usuarioSeguidor->perfil->genero == 'm') {
                        $count_seguidores_m++;
                        $estadisticaEdades['29_b_48']['count_m'] +=1;
                    } else {
                        $count_seguidores_f++;
                        $estadisticaEdades['29_b_48']['count_f'] +=1;
                    }
                    break;
                case ($edad > 48) && ($edad < 65):
                    $estadisticaEdades['49_b_64']['count'] +=1;
                    if ($seguidor->usuarioSeguidor->perfil->genero == 'm') {
                        $count_seguidores_m++;
                        $estadisticaEdades['49_b_64']['count_m'] +=1;
                    } else {
                        $count_seguidores_f++;
                        $estadisticaEdades['49_b_64']['count_f'] +=1;
                    }
                    break;
                default:
                    //mayor de 65
                    $estadisticaEdades['Mayor_65']['count'] +=1;
                    if ($seguidor->usuarioSeguidor->perfil->genero == 'm') {
                        $count_seguidores_m++;
                        $estadisticaEdades['Mayor_65']['count_m'] +=1;
                    } else {
                        $count_seguidores_f++;
                        $estadisticaEdades['Mayor_65']['count_f'] +=1;
                    }
                    break;
            }
            
        }
        $temp = $estadisticaEdades;
        foreach($temp as $key => $value){
            if($estadisticaEdades[$key]['count'] != 0){
                if($estadisticaEdades[$key]['count_m'] != 0){
                    $estadisticaEdades[$key]['percent_m'] = ($estadisticaEdades[$key]['count_m'] * 100) / $estadisticaEdades[$key]['count'];
                }else{//null
                    $estadisticaEdades[$key]['count_m'] = 0;
                }
                if($estadisticaEdades[$key]['count_f'] != 0 ){
                    $estadisticaEdades[$key]['percent_f'] = ($estadisticaEdades[$key]['count_f'] * 100) / $estadisticaEdades[$key]['count'];
                }else{//null
                    $estadisticaEdades[$key]['count_f'] = 0;
                }
            }
        }
        $percent_f = 0;
        $percent_m = 0;
        if( $count_seguidores != 0 ){
            if($count_seguidores_m != 0)
                $percent_m = ($count_seguidores_m * 100) / $count_seguidores;
            if($count_seguidores_f != 0)
                $percent_f = ($count_seguidores_f * 100) / $count_seguidores;
        }
        $estadisticaGenero = array(
            'parametros' => ["Masculino", "Femenino"],
            'porcentajes' => [$percent_m, $percent_f],
            'cantidades' => [$count_seguidores_m, $count_seguidores_f],
            'total' => $count_seguidores
        );
        $usuarios = Perfil::all();
        LogController::storeLog('GET','Vista Usuario Admi',json_encode(Session::get('login')));
        return view('admin.estadisticas')->with(compact('usuarios','estadisticaGenero','estadisticaEdades'));
    
    }

    public function editar()
    {

    }

    public function update()
    {
        
    }
    
}
