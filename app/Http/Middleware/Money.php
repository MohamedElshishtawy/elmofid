<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Money
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Make refresh to the cache
        $money = \App\Models\Student::where('id', Auth::user()->id)->first()['money'];

        // Get the current route name
        $currentRoute = $request->route()->getName();


       /* if ($money == 0) {
            return redirect()->route('not_valid'); // Redirect to not_valid page
        }*/

        // Allow access to other pages if money is 1
        if ($money == 1 && $currentRoute == 'not_valid') {

            return redirect()->route('index'); // Redirect to not_valid page

        }

        if ($money == 0){

            return  redirect()->route('not_valid');

        }

        return $next($request);
    }
}
