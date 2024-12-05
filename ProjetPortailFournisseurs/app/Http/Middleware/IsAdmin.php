<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur connecté a le rôle administrateur
        if (Auth::guard('usager')->check() && Auth::guard('usager')->user()->role === 'administrateur') {
            return $next($request);
        }

        // Sinon, redirige vers une page de refus d'accès ou la page de connexion
        return redirect()->route('Usagers.connexion')->withErrors(['Accès refusé.']);
    }
}
