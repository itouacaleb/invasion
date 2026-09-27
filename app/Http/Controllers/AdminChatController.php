<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminChatController extends Controller
{
    /**
     * Récupère l'admin connecté.
     */
    private function adminConnecte(Request $request): ?User
    {
        $user = $request->user();
        return $user instanceof User ? $user : null;
    }

    /**
     * GET /api/v1/admin/chat/inbox
     * Boîte de réception de l'admin connecté
     */
    public function inbox(Request $request)
    {
        try {
            $admin = $this->adminConnecte($request);
            if (!$admin) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            // Conversations prises en charge par moi
            $mesConversations = Conversation::pourReferent($admin->id)
                ->with(['ame', 'dernierMessage'])
                ->recentes()
                ->get();

            // Conversations orphelines (à prendre)
            $orphanConversations = Conversation::orphelines()
                ->with(['ame', 'dernierMessage'])
                ->recentes()
                ->get();

            $formatter = function ($conv) use ($admin) {
                return [
                    'id' => $conv->id,
                    'ame' => [
                        'id' => $conv->ame->id,
                        'nom' => $conv->ame->nom,
                        'telephone' => $conv->ame->telephone,
                        'image_url' => $conv->ame->image_url,
                    ],
                    'dernier_message' => $conv->dernierMessage ? [
                        'contenu' => $conv->dernierMessage->contenu,
                        'date' => $conv->dernierMessage->created_at,
                        'de_moi' => $conv->dernierMessage->expediteur_type === 'user'
                            && $conv->dernierMessage->expediteur_id === $admin->id,
                    ] : null,
                    'non_lus' => $conv->messages_non_lus_user,
                    'est_prise_en_charge' => $conv->estPriseEnCharge(),
                    'pris_en_charge_par' => $conv->pris_en_charge_par,
                    'referent_nom' => $conv->referent->nom ?? null,
                    'dernier_message_at' => $conv->dernier_message_at,
                ];
            };

            return response()->json([
                'status' => true,
                'data' => [
                    'mes_conversations' => $mesConversations->map($formatter),
                    'a_prendre' => $orphanConversations->map($formatter),
                    'total_non_lus' => $mesConversations->sum('messages_non_lus_user'),
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
     * GET /api/v1/admin/chat/ames/{ameId}
     * Messages d'une conversation avec une âme
     */
    public function messages(Request $request, $ameId)
    {
        try {
            $admin = $this->adminConnecte($request);
            if (!$admin) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $ame = Ame::findOrFail($ameId);

            // Trouve la conversation active de l'âme
            $conversation = Conversation::where('ame_id', $ame->id)
                ->orderBy('dernier_message_at', 'desc')
                ->first();

            if (!$conversation) {
                return response()->json([
                    'status' => true,
                    'data' => [
                        'ame' => [
                            'id' => $ame->id,
                            'nom' => $ame->nom,
                            'telephone' => $ame->telephone,
                        ],
                        'messages' => [],
                        'est_prise_en_charge' => false,
                        'pris_en_charge_par' => null,
                        'je_suis_referent' => false,
                    ],
                ], 200);
            }

            $messages = $conversation->messages()
                ->with('expediteur')
                ->get()
                ->map(function ($msg) use ($admin) {
                    return [
                        'id' => $msg->id,
                        'contenu' => $msg->contenu,
                        'is_ame' => $msg->expediteur_type === 'ame',
                        'de_moi' => $msg->expediteur_type === 'user'
                            && $msg->expediteur_id === $admin->id,
                        'expediteur_nom' => $msg->nom_expediteur,
                        'created_at' => $msg->created_at->toIso8601String(),
                        'lu' => $msg->lu,
                    ];
                });

            // Si je suis le référent, je marque comme lus
            if ($conversation->estReferent($admin->id)) {
                Message::where('conversation_id', $conversation->id)
                    ->where('expediteur_type', 'ame')
                    ->where('lu', false)
                    ->update(['lu' => true, 'lu_at' => now()]);
                $conversation->marquerLusPour('user');
            }

            return response()->json([
                'status' => true,
                'data' => [
                    'ame' => [
                        'id' => $ame->id,
                        'nom' => $ame->nom,
                        'telephone' => $ame->telephone,
                    ],
                    'messages' => $messages,
                    'est_prise_en_charge' => $conversation->estPriseEnCharge(),
                    'pris_en_charge_par' => $conversation->pris_en_charge_par,
                    'referent' => $conversation->referent ? [
                        'id' => $conversation->referent->id,
                        'nom' => $conversation->referent->nom,
                    ] : null,
                    'je_suis_referent' => $conversation->estReferent($admin->id),
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
     * POST /api/v1/admin/chat/ames/{ameId}/prendre
     * Prend en charge une conversation orpheline
     */
    public function prendre(Request $request, $ameId)
    {
        try {
            $admin = $this->adminConnecte($request);
            if (!$admin) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $ame = Ame::findOrFail($ameId);

            $conversation = Conversation::where('ame_id', $ame->id)
                ->orderBy('dernier_message_at', 'desc')
                ->first();

            if (!$conversation) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucune conversation à prendre',
                ], 404);
            }

            if ($conversation->estPriseEnCharge()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cette conversation est déjà gérée par '
                        . ($conversation->referent->nom ?? 'un autre admin'),
                    'data' => [
                        'pris_en_charge_par' => $conversation->pris_en_charge_par,
                        'referent_nom' => $conversation->referent->nom ?? null,
                    ],
                ], 409);
            }

            $conversation->prendreEnCharge($admin->id);

            return response()->json([
                'status' => true,
                'message' => 'Conversation prise en charge',
                'data' => [
                    'conversation_id' => $conversation->id,
                    'pris_en_charge_par' => $admin->id,
                    'referent_nom' => $admin->nom,
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
     * POST /api/v1/admin/chat/ames/{ameId}/repondre
     * Répondre à une âme (uniquement si je suis référent)
     */
    public function repondre(Request $request, $ameId)
    {
        try {
            $admin = $this->adminConnecte($request);
            if (!$admin) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'contenu' => 'required|string|max:2000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $ame = Ame::findOrFail($ameId);

            $conversation = Conversation::where('ame_id', $ame->id)
                ->orderBy('dernier_message_at', 'desc')
                ->first();

            if (!$conversation) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucune conversation',
                ], 404);
            }

            // Vérification du référent
            if ($conversation->estPriseEnCharge()
                && !$conversation->estReferent($admin->id)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cette conversation est gérée par '
                        . ($conversation->referent->nom ?? 'un autre admin'),
                ], 403);
            }

            // Si pas encore prise, on la prend automatiquement
            if ($conversation->estOrpheline()) {
                $conversation->prendreEnCharge($admin->id);
            }

            $message = Message::create([
                'conversation_id' => $conversation->id,
                'expediteur_type' => 'user',
                'expediteur_id' => $admin->id,
                'contenu' => $request->contenu,
                'lu' => false,
            ]);

            $conversation->update(['dernier_message_at' => now()]);
            $conversation->incrementerNonLus('ame');

            return response()->json([
                'status' => true,
                'message' => 'Réponse envoyée',
                'data' => [
                    'id' => $message->id,
                    'contenu' => $message->contenu,
                    'created_at' => $message->created_at->toIso8601String(),
                ],
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * GET /api/v1/admin/chat/non-lus
     * Compteur global de l'admin
     */
    public function nonLus(Request $request)
    {
        try {
            $admin = $this->adminConnecte($request);
            if (!$admin) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $mesNonLus = Conversation::pourReferent($admin->id)
                ->sum('messages_non_lus_user');

            $orphanCount = Conversation::orphelines()->count();

            return response()->json([
                'status' => true,
                'data' => [
                    'mes_non_lus' => (int) $mesNonLus,
                    'a_prendre' => (int) $orphanCount,
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
}