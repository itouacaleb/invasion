<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Retourne null pour empêcher la redirection
     * et laisser Laravel retourner une réponse JSON 401
     * sur les routes API.
     */
    protected function redirectTo(Request $request): ?string
    {
        // ✅ Pour les routes API, on ne redirige PAS
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        // Pour les routes web (si un jour tu en as), redirection classique
        return route('login');
    }
}