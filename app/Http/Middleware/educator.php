<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class educator
{
    public function handle(Request $request, Closure $next): Response
    {
        dd(Auth::user());

        if (! Auth::user() || Auth::user()->code != '0000'){
            abort(404);
        }

        return $next($request);
    }
}
