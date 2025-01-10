<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin based on email
        if (Auth::check() && Auth::user()->email === 'admin@admin.com') {
            return $next($request);
        }

        // If not admin, redirect to home or another page with an error message
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
