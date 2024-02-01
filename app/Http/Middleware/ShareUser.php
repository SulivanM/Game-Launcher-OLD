<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class ShareUser
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        View::share('user', $user);

        return $next($request);
    }
}