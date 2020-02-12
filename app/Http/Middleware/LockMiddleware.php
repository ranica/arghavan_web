<?php

namespace App\Http\Middleware;

use Closure;

class LockMiddleware
{
    protected $except_urls = [
        'lock_page',
        'unlock',
        'logout'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isLocked = \App\Http\Controllers\HomeController::isLocked ();
        $routeName = \Route::currentRouteName ();

        if ($isLocked &&
            ! in_array ($routeName, $this->except_urls))
        {
            return redirect('auth/lock');
        }

        return $next($request);
    }
}
