<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //return $next($request);
        $response = $next($request);
        //If the status is not approved redirect to login
        if (Auth::check() && Auth::user()->state != 1) {
            Auth::logout();
            return redirect('/login')->with('messageError', 'Tu cuenta no se encuentra habilitada');
        }
        return $response;
    }
}
