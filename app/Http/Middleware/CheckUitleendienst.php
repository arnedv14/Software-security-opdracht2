<?php

namespace App\Http\Middleware;

use Closure;

class CheckUitleendienst
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
        if(auth()->user()->role != 'Uitleendienst' && auth()->user()->role != 'Admin'){
            Return redirect('home');
        }

        return $next($request);
    }
}
