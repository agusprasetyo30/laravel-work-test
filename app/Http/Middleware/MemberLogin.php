<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has("user_login")) {
            return redirect()->route('member.index');
        } else if ($request->session()->get('user_login')['role'] != 'member' ) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
