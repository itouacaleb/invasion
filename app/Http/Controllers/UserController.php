<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = User::with('zone');

            // Ajout des filtres
            if ($request->has('role')) {
                $query->where('role', $request->role);
            }
            if ($request->has('zone_id')) {
                $query->where('zone_id', $request->zone_id);
            }
            // ✅ AJOUT : Recherche par nom, téléphone ou email
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'LIKE', "%{$search}%")
                      ->orWhere('telephone', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            $users = $query->get();

            return response()->json([
                'status' => true,
                'message' => 'Liste des utilisateurs récupérée avec succès',
                'data' => $users,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des utilisateurs',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'email' => 'nullable|email|unique:users,email',
                'telephone' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:evangeliste,encadreur,admin',
                'zone_id' => 'nullable|exists:zones,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $validated = $validator->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur créé avec succès',
                'data' => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::with('zone')->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur récupéré avec succès',
                'data' => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non trouvé',
                'error' => $e->getMessage(),
                'data' => [],
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nom' => 'sometimes|required|string|max:255',
                'email' => 'nullable|email|unique:users,email,'.$user->id,
                'telephone' => 'sometimes|required|string|max:20|unique:users,telephone,'.$user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'sometimes|required|in:evangeliste,encadreur,admin',
                'zone_id' => 'nullable|exists:zones,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $validated = $validator->validated();
            if (isset($validated['password']) && !empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur mis à jour avec succès',
                'data' => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour de l\'utilisateur',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // ✅ Empêcher la suppression de son propre compte
            if (auth()->id() == $id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous ne pouvez pas supprimer votre propre compte',
                    'data' => [],
                ], 403);
            }
            
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur supprimé avec succès',
                'data' => null,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression de l\'utilisateur',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }
}