<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsAttorney
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect()->route('home');
        }
        if (Auth::user()->role == 3) {
            return redirect()->route('login')->with('error', "You don't have attorney access.");
        }

        return $next($request);
    }
}
