<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserBanned
{
    public function handle($request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et si user_banned est égal à 1
        if (Auth::check() && Auth::user()->user_banned === 1) {
            // Redirige l'utilisateur vers le site interdit
            return redirect('https://banned.switchcompagnie.eu');
        }

        return $next($request);
    }
}