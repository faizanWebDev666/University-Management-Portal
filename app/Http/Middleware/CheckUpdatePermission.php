<?php

namespace App\Http\Middleware;

use App\Models\StudentUpdateRequest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUpdatePermission
{
   public function handle(Request $request, Closure $next)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->back()->with('error', 'Please login first.');
        }

        $approved = StudentUpdateRequest::where('branch_user_id', $userId)
            ->where('status', 'approved')
            ->exists();

        if (!$approved) {
            return redirect()->back()->with('error', 'You do not have permission. Request admin first.');
        }

        return $next($request);
    }
}
