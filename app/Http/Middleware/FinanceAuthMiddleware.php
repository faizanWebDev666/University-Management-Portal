<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FinanceAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('type') !== 'finance') {
            return redirect('/')->with('error', 'Please log in as finance staff to access the finance dashboard.');
        }

        return $next($request);
    }
}
