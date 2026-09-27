<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    private function ameConnectee(Request $request): ?Ame
    {
        $user = $request->user();
        return $user instanceof Ame ? $user : null;
    }

    // ═══════════════════════════════════════════════════════════
    // 💬 CHAT ADMIN (broadcast intelligent)
    // ═══════════════════════════════════════════════════════════

    /**
     * GET /api/v1/ame/chat/admin
     */
    public function chatAdmin(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);
            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            // ✅ FIX : on retire "messages.expediteur" (relation morphTo mal eager-loadée)
            $conversation = Conversation::where('ame_id', $ame->id)
                ->orderBy('dernier_message_at', 'desc')
                ->with(['referent', 'messages'])
                ->first();

            if (!$conversation) {
                return response()->json([
                    'status' => true,
                    'data' => [
                        'messages' => [],
                        'referent' => null,
                        'non_lus' => 0,
                        'est_prise_en_charge' => false,
                    ],
                ], 200);
            }

            $messages = $conversation->messages->map(function ($msg) use ($ame) {
                return [
                    'id' => $msg->id,
                    'contenu' => $msg->contenu,
                    'is_ame' => $msg->expediteur_type === 'ame'
                        && $msg->expediteur_id === $ame->id,
                    'expediteur_nom' => $msg->expediteur_type === 'ame'
                        ? null
                        : $msg->nom_expediteur,   // ✅ le getter fait le lookup
                    'created_at' => $msg->created_at->toIso8601String(),
                ];
            });

            // Marque tous les messages reçus comme lus
            Message::where('conversation_id', $conversation->id)
                ->where('expediteur_type', 'user')
                ->where('lu', false)
                ->update(['lu' => true, 'lu_at' => now()]);

            $conversation->marquerLusPour('ame');

            $referent = $conversation->referent;

            return response()->json([
                'status' => true,
                'data' => [
                    'messages' => $messages,
                    'referent' => $referent ? [
                        'id' => $referent->id,
                        'nom' => $referent->nom,
                        'role' => $referent->role,
                    ] : null,
                    'non_lus' => 0,
                    'est_prise_en_charge' => $conversation->estPriseEnCharge(),
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
     * POST /api/v1/ame/chat/admin/envoyer
     */
    public function envoyerChatAdmin(Request $request)
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
                'contenu' => 'required|string|max:2000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $conversationActive = Conversation::conversationActiveAme($ame->id);

            if ($conversationActive) {
                $message = Message::create([
                    'conversation_id' => $conversationActive->id,
                    'expediteur_type' => 'ame',
                    'expediteur_id' => $ame->id,
                    'contenu' => $request->contenu,
                    'lu' => false,
                ]);

                $conversationActive->update(['dernier_message_at' => now()]);
                $conversationActive->incrementerNonLus('user');

                return response()->json([
                    'status' => true,
                    'message' => 'Message envoyé au référent',
                    'data' => [
                        'id' => $message->id,
                        'contenu' => $message->contenu,
                        'is_ame' => true,
                        'broadcast' => false,
                        'referent_nom' => $conversationActive->referent->nom ?? null,
                        'created_at' => $message->created_at->toIso8601String(),
                    ],
                ], 201);
            }

            $admins = User::whereIn('role', ['admin', 'evangeliste'])->get();

            if ($admins->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucun admin disponible pour le moment',
                ], 503);
            }

            $broadcastGroupId = (string) Str::uuid();
            $messagePrincipal = null;

            foreach ($admins as $admin) {
                $conversation = Conversation::firstOrCreate(
                    ['ame_id' => $ame->id, 'user_id' => $admin->id],
                    [
                        'dernier_message_at' => now(),
                        'pris_en_charge_par' => null,
                    ]
                );

                $message = Message::create([
                    'conversation_id' => $conversation->id,
                    'expediteur_type' => 'ame',
                    'expediteur_id' => $ame->id,
                    'broadcast_group_id' => $broadcastGroupId,
                    'contenu' => $request->contenu,
                    'lu' => false,
                ]);

                $conversation->update(['dernier_message_at' => now()]);
                $conversation->incrementerNonLus('user');

                if (!$messagePrincipal) {
                    $messagePrincipal = $message;
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Message diffusé à ' . $admins->count() . ' admin(s)',
                'data' => [
                    'id' => $messagePrincipal->id,
                    'contenu' => $messagePrincipal->contenu,
                    'is_ame' => true,
                    'broadcast' => true,
                    'broadcast_group_id' => $broadcastGroupId,
                    'admins_count' => $admins->count(),
                    'referent_nom' => null,
                    'created_at' => $messagePrincipal->created_at->toIso8601String(),
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
     * GET /api/v1/ame/chat/non-lus
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

            $total = Conversation::pourAme($ame->id)->sum('messages_non_lus_ame');

            return response()->json([
                'status' => true,
                'data' => ['total' => (int) $total],
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