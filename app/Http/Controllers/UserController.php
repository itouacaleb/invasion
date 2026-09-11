<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = User::with('zone');

            if ($request->has('role')) {
                $query->where('role', $request->role);
            }
            if ($request->has('zone_id')) {
                $query->where('zone_id', $request->zone_id);
            }
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
            // ✅ CORRECTION : Ajouter 'gagneur_d_ames' dans la liste des rôles
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'email' => 'nullable|email|unique:users,email',
                'telephone' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:evangeliste,encadreur,admin,gagneur_d_ames', // ✅ AJOUTÉ
                'zone_id' => 'nullable|exists:zones,id',
                'image' => 'nullable|string',
                'image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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

            // ✅ Gestion de l'image
            if ($request->hasFile('image_file')) {
                $path = $request->file('image_file')->store('images/users', 'public');
                $validated['image'] = $path;
            } elseif ($request->filled('image')) {
                $validated['image'] = $request->image;
            }

            unset($validated['image_file']);

            $user = User::create($validated);
            $user->load('zone');

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

            // ✅ CORRECTION : Ajouter 'gagneur_d_ames' dans la liste des rôles
            $validator = Validator::make($request->all(), [
                'nom' => 'sometimes|required|string|max:255',
                'email' => 'nullable|email|unique:users,email,'.$user->id,
                'telephone' => 'sometimes|required|string|max:20|unique:users,telephone,'.$user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'sometimes|required|in:evangeliste,encadreur,admin,gagneur_d_ames', // ✅ AJOUTÉ
                'zone_id' => 'nullable|exists:zones,id',
                'image' => 'nullable|string',
                'image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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

            // ✅ Gestion de l'image
            if ($request->hasFile('image_file')) {
                // Supprimer l'ancienne image si elle existe
                if ($user->image && !filter_var($user->image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($user->image);
                }
                $path = $request->file('image_file')->store('images/users', 'public');
                $validated['image'] = $path;
            } elseif ($request->filled('image')) {
                if ($user->image && !filter_var($user->image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($user->image);
                }
                $validated['image'] = $request->image;
            }

            unset($validated['image_file']);

            $user->update($validated);
            $user->load('zone');

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
            
            if (auth()->id() == $id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous ne pouvez pas supprimer votre propre compte',
                    'data' => [],
                ], 403);
            }
            
            // ✅ Supprimer l'image si elle existe
            if ($user->image && !filter_var($user->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($user->image);
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