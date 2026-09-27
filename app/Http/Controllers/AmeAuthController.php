<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AmeAuthController extends Controller
{
    /**
     * Vérifie si un numéro de téléphone est lié à une âme.
     * POST /api/v1/ame-auth/check-phone
     */
    public function checkPhone(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'telephone' => 'required|string|max:20',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $ame = Ame::where('telephone', $request->telephone)->first();

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Numéro non reconnu. Contactez votre encadreur.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Numéro reconnu',
                'data' => [
                    'ame_id' => $ame->id,
                    'nom' => $ame->nom,
                    'telephone' => $ame->telephone,
                    'pin_modifie' => $ame->pin_modifie,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la vérification',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Connexion de l'âme (téléphone + PIN).
     * POST /api/v1/ame-auth/login
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'telephone' => 'required|string|max:20',
                'pin' => 'required|string|min:4|max:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $ame = Ame::where('telephone', $request->telephone)->first();

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Numéro ou code incorrect.',
                ], 401);
            }

            // ✅ Vérifie que l'âme a bien un PIN défini
            if (!$ame->password) {
                return response()->json([
                    'status' => false,
                    'message' => 'Compte non configuré. Contactez votre encadreur.',
                ], 403);
            }

            // ✅ Vérifie le PIN
            if (!Hash::check($request->pin, $ame->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Numéro ou code incorrect.',
                ], 401);
            }

            // ✅ Supprime les anciens tokens (une seule session à la fois)
            $ame->tokens()->delete();

            // ✅ Crée un nouveau token Sanctum
            $token = $ame->createToken('ame_token')->plainTextToken;

            // ✅ Met à jour la dernière connexion
            $ame->update(['derniere_connexion' => now()]);

            return response()->json([
                'status' => true,
                'message' => 'Connexion réussie',
                'data' => [
                    'id' => $ame->id,
                    'nom' => $ame->nom,
                    'telephone' => $ame->telephone,
                    'email' => $ame->email,
                    'sexe' => $ame->sexe,
                    'age' => $ame->age,
                    'adresse' => $ame->adresse,
                    'image_url' => $ame->image_url,
                    'pin_modifie' => (bool) $ame->pin_modifie,
                    'campagne_id' => $ame->campagne_id,
                    'zone_id' => $ame->zone_id,
                ],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la connexion',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Infos de l'âme connectée.
     * GET /api/v1/ame-auth/me
     */
    public function me(Request $request)
    {
        try {
            $ame = $request->user();

            if (!$ame instanceof Ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $ame->load(['campagne', 'zone', 'cellule', 'encadreur']);

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur récupéré',
                'data' => $ame,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Déconnexion.
     * POST /api/v1/ame-auth/logout
     */
    public function logout(Request $request)
    {
        try {
            $ame = $request->user();

            if ($ame instanceof Ame) {
                $ame->tokens()->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Déconnexion réussie',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la déconnexion',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Définit ou change le PIN de l'âme.
     * POST /api/v1/ame-auth/set-pin
     */
    public function setPin(Request $request)
    {
        try {
            $ame = $request->user();

            if (!$ame instanceof Ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'ancien_pin' => 'required|string|min:4|max:10',
                'nouveau_pin' => 'required|string|min:4|max:10|different:ancien_pin',
                'nouveau_pin_confirmation' => 'required|same:nouveau_pin',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // ✅ Vérifie l'ancien PIN
            if (!Hash::check($request->ancien_pin, $ame->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ancien code incorrect.',
                ], 401);
            }

            // ✅ Hash le nouveau PIN
            $ame->update([
                'password' => Hash::make($request->nouveau_pin),
                'pin_modifie' => true,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Code mis à jour avec succès',
                'data' => [
                    'pin_modifie' => true,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors du changement de code',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}