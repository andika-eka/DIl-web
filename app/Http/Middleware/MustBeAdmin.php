<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class MustBeAdmin extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($request)
    {
        if (! ($request->expectsJson() && auth()->user()?->tipe_pengguna != 1))  {
           abort(403);
        }
    }
}
