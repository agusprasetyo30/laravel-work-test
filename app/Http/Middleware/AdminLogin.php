<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has("user_login")) {
            return redirect()->route('admin.index');
        } else if ($request->session()->get('user_login')['role'] != 'admin' ) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
