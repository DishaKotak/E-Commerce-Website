<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('auth_session')) {
            return redirect('/login')
                ->with('error', 'Please login first');
        }

        $auth = session('auth_session');

        if ($auth['expiry'] < time()) {

            session()->forget('auth_session');

            return redirect('/login')
                ->with('error', 'Session expired, please login again');
        }

        return $next($request);
    }
}
