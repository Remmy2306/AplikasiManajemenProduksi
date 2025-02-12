<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType1 = null, $userType2 = null)
    {
        if(Auth::check())
        {
            if(Auth::user() -> role == $userType1 || Auth::user() -> role == $userType2)
            {
                return $next ($request);
            }
            else
            {
                return redirect('/blok')->with('message', 'Anda tidak memiliki hak akses!');
            }
        }
        else 
        {
            return redirect('/login')->with('message', 'Anda belum login, silahkan login terlebih dahulu!');
        }
        return $next($request);
    }
}
