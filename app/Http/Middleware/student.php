<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class student
{
    public function handle(Request $request, Closure $next): Response
    {
        // if ( Auth::user()->money != 1 ){
        //     return redirect()->route("not_valid");
        // }
        return $next($request);
    }
}
