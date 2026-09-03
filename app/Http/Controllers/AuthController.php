<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Enregistrement
     */
    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [

                'nom' => 'required|string|max:255',

                'telephone' => 'required|string|max:20|unique:users',

                'email' => 'nullable|email|max:255|unique:users',

                'password' => 'required|string|min:8',

                'role' => 'required|in:evangeliste,encadreur,admin',

                'zone_id' => 'nullable|exists:zones,id',

            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::create([

                'nom' => $request->nom,

                'telephone' => $request->telephone,

                'email' => $request->email,

                'password' => Hash::make($request->password),

                'role' => $request->role,

                'zone_id' => $request->zone_id,

            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur enregistré avec succès',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'enregistrement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Connexion
     */
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [

                'telephone' => 'required|string',

                'password' => 'required|string',

            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors()
                ], 422);
            }

            if (!Auth::attempt([
                'telephone' => $request->telephone,
                'password' => $request->password
            ])) {

                return response()->json([
                    'status' => false,
                    'message' => 'Numéro de téléphone ou mot de passe incorrect.'
                ], 401);
            }

            $user = User::where('telephone', $request->telephone)->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Connexion réussie',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la connexion',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Réinitialisation du mot de passe
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'telephone' => 'required|exists:users,telephone',

            'new_password' => 'required|string|min:8|confirmed',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            $user = User::where('telephone', $request->telephone)->first();

            $user->password = Hash::make($request->new_password);

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Mot de passe mis à jour avec succès.'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        try {

            $request->user()->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Déconnexion réussie'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la déconnexion',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}