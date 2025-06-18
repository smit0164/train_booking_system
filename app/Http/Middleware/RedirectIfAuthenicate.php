<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenicate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$guards): Response
    {
       $guards=empty($guards) ? [null] : $guards;
       foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect based on guard
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($guard === 'user') {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
