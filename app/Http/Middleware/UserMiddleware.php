<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'user'){
            return $next($request);
        }

        // return back ka shi nay tae route mhr pal pyan yout mar
        return back();

        // abort 404 ka route ka shi pal mae ma shi tae pone san myo pya tr
        // abort(404);
    }
}
