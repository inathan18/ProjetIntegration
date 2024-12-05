<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('usager')->user();

        // Vérifie que l'utilisateur a un rôle autorisé
        if ($user && in_array($user->role, ['commis', 'responsable', 'administrateur'])) {
            return $next($request);
        }

        // Sinon, redirige vers une page d'accès refusé ou de connexion
        return redirect()->route('Fournisseurs.accueil')->withErrors(['Accès refusé.']);
    }
}
