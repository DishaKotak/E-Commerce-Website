<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_session')) {
            return redirect('/admin-login')
                ->with('error', 'Please login as admin');
        }

        if (session('admin_session.role') !== 'admin') {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}
