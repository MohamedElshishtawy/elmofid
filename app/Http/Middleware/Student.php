<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (  Auth::user()->code == '0000' || ! in_array(Auth::user()->groups->class, [1,2,3])  )
        {

            Auth::logout();

            to_route('login');

        }


        return $next($request);
    }
}
