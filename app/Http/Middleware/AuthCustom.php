<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCustom
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('loginId')) {
            return redirect('/login')
                ->with('error', 'Please login first');
        }

        return $next($request);
    }
}
