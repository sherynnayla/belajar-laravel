<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //cek kalau di fitur auth ada history login, diperbolehkan akses
        if(Auth::check()) {
            return $next($request);
        } 
        //kalau gada history login bakal dibalikin ke halaman dengan pesan error
        return redirect()->route('login')->with('notAllowed','Silakan login terlebih dahulu!');
    }
}
