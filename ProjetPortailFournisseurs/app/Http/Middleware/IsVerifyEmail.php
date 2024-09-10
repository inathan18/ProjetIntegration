<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::user()->is_email_verified){
            auth()->logout();
            return redirect()->route('connexion')
            ->with('message', 'Vous devez confirmer votre compte. Vous allez recevoir un courriel d\'activation. Veuillez vérifier vos courriels');
        }
        return $next($request);
    }
}
