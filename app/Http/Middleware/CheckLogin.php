<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // dd(auth()->user()->status);
        $user_status = ['admin','customer'];
        if(!in_array(auth()->user()->status , $user_status) ){
            Auth::logout();
            return redirect()->route('login');
        }else{
            return $next($request);
        }
    }
}
