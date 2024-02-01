<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareUserWithViews
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        View::share('user', $user);
        return $next($request);
    }
}