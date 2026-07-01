<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            !auth()->check() ||!in_array(auth()->user()->role, ['admin', 'super_admin'])
        ) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
