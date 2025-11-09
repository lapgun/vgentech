<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', __('Please login to continue.'));
        }

        // Check if user has ADMIN role
        if (!auth()->user()->isAdmin()) {
            abort(403, __('You do not have permission to access this page. Only Admin can access Dashboard.'));
        }

        return $next($request);
    }
}
