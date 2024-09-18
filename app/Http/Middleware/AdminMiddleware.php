<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // dr ka login win htr yin login route and register route ko close lite tr
        // ae twat auth.php mhr lae nae nae pyin htr tal
        if(Auth::user()){
            // login win p yin thwr mae a chay a nay moh Auth:user() ko use tr
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
                if($request->route()->getName() == 'login' || $request->route()->getName() == 'register'){
                    return back();
                }
                return $next($request);
            }
            return back();
        }else{
            return $next($request);
        }
    }
}
