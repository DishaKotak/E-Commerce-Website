<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthCustom
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('loginId')) {
            return redirect('/login')->with('error', 'Please login first');
        }
        
        return $next($request);
    }
}