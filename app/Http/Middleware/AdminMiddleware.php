<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('is_admin') || session('is_admin') !== true) {
            abort(403, 'Akses hanya untuk admin');
        }

        return $next($request);
    }
}

