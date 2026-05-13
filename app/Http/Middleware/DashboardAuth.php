<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardAuth
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('auth_session')) {
            return redirect('/login')->with('error');
        }
        $auth = session('auth_session');
        if ($auth['expiry'] < time()) {
            session()->forget('auth_session');
            return redirect('/login')->with('error', 'Session expired, please login again');
        }
        return $next($request);
    }

}
