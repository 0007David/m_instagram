<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthMiniInstagram
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario = Session::get('login');
        
        
        /**
         * Si esta Logueado 
         */
        if( $request->path() !="counterViews" && $request->path() !="buscar" && $request->path() != "buscarby"){
            if( is_null($usuario) ){

                return redirect('login');
    
            }else if( $request->path() == "/" ){
                return redirect('home');
            }
        }
       
        return $next($request);
    }
}
