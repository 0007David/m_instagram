<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiniInstagram
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

        if( $usuario['rol'] != 1 ){
            return redirect('home');
        }else if( $request->path() == "/" ){
            return redirect('home');
        }
        return $next($request);
    }
}
