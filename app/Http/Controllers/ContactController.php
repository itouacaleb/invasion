<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\User;
use App\Models\Conversation;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Récupère l'âme connectée.
     */
    private function ameConnectee(Request $request): ?Ame
    {
        $user = $request->user();
        return $user instanceof Ame ? $user : null;
    }

    /**
     * Liste des responsables que l'âme peut contacter.
     * GET /api/v1/ame/contact/responsables
     *
     * Inclut :
     * - Tous les admins
     * - Tous les évangélistes
     * - L'encadreur assigné à l'âme (s'il existe)
     */
    public function responsables(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            // ✅ Récupère les admins + évangélistes
            $responsables = User::whereIn('role', ['admin', 'evangeliste'])
                ->with('zone')
                ->orderByRaw("FIELD(role, 'admin', 'evangeliste')")
                ->orderBy('nom')
                ->get();

            // ✅ Ajoute l'encadreur assigné s'il n'est pas déjà dans la liste
            if ($ame->assigne_a) {
                $encadreur = User::with('zone')->find($ame->assigne_a);
                if ($encadreur && !$responsables->contains('id', $encadreur->id)) {
                    $responsables->prepend($encadreur);
                }
            }

            // ✅ Ajoute pour chaque responsable son nombre de messages non lus
            $responsablesFormates = $responsables->map(function ($user) use ($ame) {
                $conversation = Conversation::where('ame_id', $ame->id)
                    ->where('user_id', $user->id)
                    ->first();

                return [
                    'id' => $user->id,
                    'nom' => $user->nom,
                    'role' => $user->role,
                    'role_label' => $this->roleLabel($user->role),
                    'telephone' => $user->telephone,
                    'email' => $user->email,
                    'zone' => $user->zone ? $user->zone->nom : null,
                    'image_url' => $user->image_url ?? null,
                    'est_mon_encadreur' => $user->id === $ame->assigne_a,
                    'non_lus' => $conversation
                        ? $conversation->messages_non_lus_ame
                        : 0,
                    'a_conversation' => $conversation !== null,
                ];
            });

            return response()->json([
                'status' => true,
                'message' => 'Responsables récupérés',
                'data' => $responsablesFormates,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Détail d'un responsable.
     * GET /api/v1/ame/contact/responsables/{userId}
     */
    public function show(Request $request, $userId)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $user = User::with('zone')->findOrFail($userId);

            // ✅ Vérifie que l'user est bien un responsable
            if (!in_array($user->role, ['admin', 'evangeliste', 'encadreur'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cet utilisateur n\'est pas un responsable.',
                ], 403);
            }

            // ✅ Si c'est un encadreur, il doit être celui assigné à l'âme
            if ($user->role === 'encadreur' && $user->id !== $ame->assigne_a) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous ne pouvez pas contacter cet encadreur.',
                ], 403);
            }

            $conversation = Conversation::where('ame_id', $ame->id)
                ->where('user_id', $user->id)
                ->first();

            return response()->json([
                'status' => true,
                'message' => 'Responsable récupéré',
                'data' => [
                    'id' => $user->id,
                    'nom' => $user->nom,
                    'role' => $user->role,
                    'role_label' => $this->roleLabel($user->role),
                    'telephone' => $user->telephone,
                    'email' => $user->email,
                    'zone' => $user->zone ? [
                        'id' => $user->zone->id,
                        'nom' => $user->zone->nom,
                    ] : null,
                    'image_url' => $user->image_url ?? null,
                    'est_mon_encadreur' => $user->id === $ame->assigne_a,
                    'non_lus' => $conversation
                        ? $conversation->messages_non_lus_ame
                        : 0,
                    'a_conversation' => $conversation !== null,
                ],
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Responsable non trouvé',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Compteur global de messages non lus pour l'âme.
     * GET /api/v1/ame/contact/non-lus-total
     */
    public function nonLusTotal(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $total = Conversation::where('ame_id', $ame->id)
                ->sum('messages_non_lus_ame');

            return response()->json([
                'status' => true,
                'data' => [
                    'total' => (int) $total,
                ],
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Traduit le rôle technique en libellé français.
     */
    private function roleLabel(string $role): string
    {
        return match ($role) {
            'admin' => 'Administrateur',
            'evangeliste' => 'Évangéliste',
            'encadreur' => 'Encadreur',
            default => 'Responsable',
        };
    }
}