<?php

namespace App\Http\Middleware;

use Auth;

use Closure;
use Illuminate\Http\Request;

class usuarios_sistema_facturacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        if (Auth::user()->role == 'DIRECTIVO') {
            return $next($request);
        }
        if (Auth::user()->role == 'SISTEMAS') {
            return $next($request);
        }
        if (Auth::user()->role == 'A_FACTURACION') {
            return $next($request);
        }
         if (Auth::user()->role == 'CONTABILIDAD') {
            return $next($request);
        }
         else {
            return redirect()->route('home');
        }
    }
}
