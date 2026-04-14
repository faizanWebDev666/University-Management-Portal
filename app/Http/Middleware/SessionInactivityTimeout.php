<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionInactivityTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('id')) {
            // Get the last activity time from session
            $lastActivity = session()->get('last_activity', now()->timestamp);
            $now = now()->timestamp;
            
            // Check if session has timed out (using config session lifetime in seconds)
            $timeout = config('session.lifetime', 120) * 60;
            
            if ($now - $lastActivity > $timeout) {
                // Session expired due to inactivity
                session()->flush();
                return redirect('/')->with('timeout', 'Your session has expired due to inactivity. Please login again.');
            }
            
            // Update last activity time
            session()->put('last_activity', $now);
        }

        return $next($request);
    }
}
