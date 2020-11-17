<?php

namespace App\Http\Middleware;

use Closure;

class CheckAlumni
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
        if (!student()) {
            return redirect('tracer-study/login');
        }
        
        return $next($request);
    }
}
