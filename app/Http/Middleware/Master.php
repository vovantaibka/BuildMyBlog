<?php

namespace App\Http\Middleware;

use Closure;

class Master
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->email !== 'admin@gmail.com') {
            auth()->logout();

            return redirect()->route('login');
        }

        return $next($request);
    }
}
