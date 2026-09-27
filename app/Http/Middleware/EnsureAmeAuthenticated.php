<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAmeAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Utilisateur authentifié via Sanctum
        $user = $request->user();

        // ✅ Si c'est une Ame → OK
        if ($user instanceof \App\Models\Ame) {
            return $next($request);
        }

        // ❌ Sinon, accès refusé
        return response()->json([
            'status' => false,
            'message' => 'Accès réservé aux âmes authentifiées.',
        ], 401);
    }
}