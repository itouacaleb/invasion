<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
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
     * Liste des conversations de l'âme connectée.
     * GET /api/v1/ame/messages/conversations
     */
    public function conversations(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $conversations = Conversation::pourAme($ame->id)
                ->with(['user', 'dernierMessage'])
                ->recentes()
                ->get()
                ->map(function ($conv) {
                    return [
                        'id' => $conv->id,
                        'user' => [
                            'id' => $conv->user->id,
                            'nom' => $conv->user->nom,
                            'role' => $conv->user->role,
                            'image_url' => $conv->user->image_url ?? null,
                        ],
                        'dernier_message' => $conv->dernierMessage ? [
                            'contenu' => $conv->dernierMessage->contenu,
                            'date' => $conv->dernierMessage->created_at,
                            'de_moi' => $conv->dernierMessage->expediteur_type === 'ame',
                        ] : null,
                        'non_lus' => $conv->messages_non_lus_ame,
                        'dernier_message_at' => $conv->dernier_message_at,
                    ];
                });

            return response()->json([
                'status' => true,
                'message' => 'Conversations récupérées',
                'data' => $conversations,
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
     * Messages d'une conversation avec un responsable précis.
     * GET /api/v1/ame/messages/{userId}
     */
    public function messages(Request $request, $userId)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            // ✅ Vérifie que le user existe
            $user = User::findOrFail($userId);

            // ✅ Récupère ou crée la conversation
            $conversation = Conversation::trouverOuCreer($ame->id, $user->id);

            // ✅ Récupère les messages
            $messages = $conversation->messages()
                ->with('expediteur')
                ->get()
                ->map(function ($msg) use ($ame) {
                    return [
                        'id' => $msg->id,
                        'contenu' => $msg->contenu,
                        'date' => $msg->created_at,
                        'de_moi' => $msg->expediteur_type === 'ame'
                            && $msg->expediteur_id === $ame->id,
                        'expediteur_nom' => $msg->nom_expediteur,
                        'lu' => $msg->lu,
                    ];
                });

            // ✅ Marque les messages reçus comme lus
            Message::where('conversation_id', $conversation->id)
                ->where('expediteur_type', 'user')
                ->where('lu', false)
                ->update([
                    'lu' => true,
                    'lu_at' => now(),
                ]);

            // ✅ Réinitialise le compteur non lus côté âme
            $conversation->marquerLusPour('ame');

            return response()->json([
                'status' => true,
                'message' => 'Messages récupérés',
                'data' => [
                    'conversation_id' => $conversation->id,
                    'user' => [
                        'id' => $user->id,
                        'nom' => $user->nom,
                        'role' => $user->role,
                        'image_url' => $user->image_url ?? null,
                    ],
                    'messages' => $messages,
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
     * Envoie un message à un responsable.
     * POST /api/v1/ame/messages/envoyer
     */
    public function envoyer(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'contenu' => 'required|string|max:2000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user = User::findOrFail($request->user_id);

            // ✅ Récupère ou crée la conversation
            $conversation = Conversation::trouverOuCreer($ame->id, $user->id);

            // ✅ Crée le message
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'expediteur_type' => 'ame',
                'expediteur_id' => $ame->id,
                'contenu' => $request->contenu,
                'lu' => false,
            ]);

            // ✅ Met à jour la conversation
            $conversation->update([
                'dernier_message_at' => now(),
            ]);

            // ✅ Incrémente le compteur non lus côté user
            $conversation->incrementerNonLus('user');

            return response()->json([
                'status' => true,
                'message' => 'Message envoyé',
                'data' => [
                    'id' => $message->id,
                    'contenu' => $message->contenu,
                    'date' => $message->created_at,
                    'de_moi' => true,
                ],
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'envoi',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Compteur de messages non lus (pour l'icône "notification").
     * GET /api/v1/ame/messages/non-lus
     */
    public function nonLus(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $total = Conversation::pourAme($ame->id)
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
}