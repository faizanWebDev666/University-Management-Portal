<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddlewere
{
   public function handle(Request $request, Closure $next)
    {
        if (session('type') !== 'admin') {
            return redirect()->route('Admin.signin')->with('error', 'Please log in as admin.');
        }

        return $next($request);
    }
}
