<?php

namespace App\Http\Middleware;

use Auth;

use Closure;
use Illuminate\Http\Request;

class usuarios_sistema_facturacion_master
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
        if (Auth::user()->role == 'A_FACTURACION') {
            return $next($request);
        } else {
            return redirect()->route('home_facturacion');
        }
    }
}
