<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'Admin') {
            return $next($request);
        }

        // Redirigir al dashboard con mensaje de error
        return redirect('/dashboard')->with('error', 'You do not have administrator privileges!');
    }
}
