<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\Campagne;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    /**
     * POST /api/v1/public/inscription
     * Reçoit une demande d'inscription depuis l'app publique.
     * Crée une âme en attente de validation par un encadreur.
     */
    public function inscription(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'telephone' => 'required|string|max:20',
                'sexe' => 'required|in:H,F',
                'age' => 'nullable|integer|min:5|max:120',
                'adresse' => 'nullable|string|max:255',
                'comment_connu' => 'nullable|string|max:500',
                'type_decision' => 'nullable|string|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Vérifie que le numéro n'existe pas déjà
            $existe = Ame::where('telephone', $request->telephone)->exists();
            if ($existe) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ce numéro est déjà enregistré. Contactez un responsable.',
                ], 409);
            }

            // Campagne par défaut (la plus récente active)
            $campagne = Campagne::orderBy('date_debut', 'desc')->first();
            if (!$campagne) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucune campagne active. Contactez un responsable.',
                ], 503);
            }

            // Crée l'âme en attente
            $ame = Ame::create([
                'nom' => $request->nom,
                'telephone' => $request->telephone,
                'sexe' => $request->sexe,
                'age' => $request->age,
                'adresse' => $request->adresse,
                'type_decision' => $request->type_decision ?? 'Nouveau converti',
                'campagne_id' => $campagne->id,
                'date_conversion' => now()->toDateString(),
                'password' => Hash::make('00000'),
                'pin_modifie' => false,
                'suivi' => false,
                'assigne_a' => null,
            ]);

            // Log du comment
            if ($request->filled('comment_connu')) {
                \Log::info("Nouvelle inscription : {$ame->nom} ({$ame->telephone}) — Comment connu : {$request->comment_connu}");
            }

            // Notifie tous les admins (si tu as un système de notifications)
            $admins = User::whereIn('role', ['admin', 'evangeliste'])->get();
            // Tu peux décommenter quand tu auras les notifs en place
            // foreach ($admins as $admin) {
            //     Notification::create([...]);
            // }

            return response()->json([
                'status' => true,
                'message' => 'Votre demande a été envoyée. Un responsable vous contactera bientôt. Que Dieu vous bénisse !',
                'data' => [
                    'id' => $ame->id,
                    'nom' => $ame->nom,
                ],
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'inscription',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * GET /api/v1/public/eglise
     * Retourne les infos publiques de l'église.
     */
    public function eglise()
    {
        return response()->json([
            'status' => true,
            'data' => [
                'nom' => 'La Maison de Solutions',
                'slogan' => 'Pour les Nations',
                'description' => 'Une église où chaque âme trouve sa solution en Jésus-Christ.',
                'adresse' => '81 Rue Ewo / Avenue Reine Ngalefourou - Ouenzé',
                'ville' => 'Brazzaville, République du Congo',
                'telephone' => '+242 06 635 36 62',
                'whatsapp' => '+242 06 635 36 62',
                'email' => 'contact@maisondesolutions.com',
                'pasteur_principal' => 'Pasteur Principal',
                'facebook' => 'https://facebook.com/maisondesolutions',
                'youtube' => 'https://youtube.com/@maisondesolutions',
            ],
        ], 200);
    }
}