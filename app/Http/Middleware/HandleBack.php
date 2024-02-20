<?php

namespace App\Http\Middleware;

use App\Models\Degree;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $id): Response
    {
        /*$degree_before = Degree::where('students_id', Auth::user()->id)
            ->where('exams_id', $id)
            ->exists();

        if( $degree_before ){

            return redirect()->route('student_exams')->with('error', 'تم حل الإمتحان من قبل');

        }*/
        // I'm not raly understand the coe but
        // the function of the code to prevent the back method
        $response =  $next($request);
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 26 Jul 1907 05:00:00 GMT');
        //return $next($request);
    }
}
