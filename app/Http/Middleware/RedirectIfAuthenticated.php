<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && !empty(Auth::user()->email_verified_at)) {
            $url = url()->previous();
            $url = preg_replace("/\/(login|register|logout)$/sD", "/home", $url);
            strpos($url, RouteServiceProvider::HOME) !== false ?: $url = route('public.index');
            return redirect($url);
        }

        return $next($request);
    }
}
