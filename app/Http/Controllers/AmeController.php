<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\Campagne;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AmeController extends Controller
{
    /**
     * Liste des âmes
     * 
     * Paramètres optionnels :
     * - mine=true : retourne uniquement les âmes de l'utilisateur connecté
     * - campagne_id : filtrer par campagne
     * - assigne_a : filtrer par encadreur
     * - cellule_id : filtrer par cellule
     * - sexe : filtrer par sexe (H/F)
     * - type_decision : filtrer par type de décision
     */
    public function index(Request $request)
    {
        try {
            $query = Ame::query();
            $user = auth()->user();

            // ✅ SOLUTION HYBRIDE :
            // - Si ?mine=true → uniquement les âmes de l'utilisateur
            // - Sinon → tous voient tout (sauf les encadreurs qui ne voient que les leurs)
            
            $showOnlyMine = $request->has('mine') && $request->mine === 'true';

            if ($showOnlyMine) {
                // Vue personnelle : mes âmes uniquement
                $query->where('assigne_a', $user->id);
            } elseif ($user->role === 'encadreur') {
                // Les encadreurs ne voient que leurs âmes assignées
                $query->where('assigne_a', $user->id);
            }
            // Les admins, gagneurs et évangélistes voient TOUT

            // Filtres optionnels
            if ($request->has('campagne_id')) {
                $query->where('campagne_id', $request->campagne_id);
            }
            if ($request->has('assigne_a')) {
                $query->where('assigne_a', $request->assigne_a);
            }
            if ($request->has('cellule_id')) {
                $query->where('cellule_id', $request->cellule_id);
            }
            if ($request->has('sexe')) {
                $query->where('sexe', $request->sexe);
            }
            if ($request->has('type_decision')) {
                $query->where('type_decision', $request->type_decision);
            }

            // Charger les relations
            $query->with(['campagne', 'encadreur', 'cellule.zone']);

            // Trier par date de création décroissante
            $query->orderBy('created_at', 'desc');

            $ames = $query->get();

            // ✅ Compter les âmes de l'utilisateur pour info
            $myAmesCount = Ame::where('assigne_a', $user->id)->count();
            $totalAmes = Ame::count();

            return response()->json([
                'status' => true,
                'message' => 'Liste des âmes récupérée avec succès',
                'data' => $ames,
                'meta' => [
                    'my_ames_count' => $myAmesCount,
                    'total_ames' => $totalAmes,
                    'show_only_mine' => $showOnlyMine,
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des âmes',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Créer une nouvelle âme
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'telephone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'sexe' => 'required|in:H,F',
                'age' => 'nullable|integer|min:0',
                'adresse' => 'nullable|string',
                'image' => 'nullable|string',
                'image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'suivi' => 'boolean',
                'derniere_interaction' => 'nullable|date',
                'date_conversion' => 'nullable|date',
                'campagne_id' => 'required|exists:campagnes,id',
                'type_decision' => 'nullable|string',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'assigne_a' => 'nullable|exists:users,id',
                'cellule_id' => 'nullable|exists:cellules,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $campagne = Campagne::find($request->campagne_id);

            if (!$campagne) {
                return response()->json([
                    'status' => false,
                    'message' => 'Campagne non trouvée',
                ], 404);
            }

            $dateConversion = $request->date_conversion
                ? Carbon::parse($request->date_conversion)
                : Carbon::now();

            if (!$campagne->isDateInPeriod($dateConversion)) {
                return response()->json([
                    'status' => false,
                    'message' => 'La date de conversion doit être dans la période de la campagne',
                    'errors' => [
                        'date_conversion' => [
                            'La date doit être entre ' .
                            $campagne->date_debut->format('d/m/Y') .
                            ' et ' .
                            ($campagne->date_fin ? $campagne->date_fin->format('d/m/Y') : 'indéfinie')
                        ]
                    ]
                ], 422);
            }

            $data = $request->all();
            $data['date_conversion'] = $dateConversion->toDateString();

            // ✅ Assigner automatiquement à l'utilisateur connecté
            if (!isset($data['assigne_a']) || $data['assigne_a'] === null) {
                $data['assigne_a'] = auth()->id();
            }

            // Gestion de l'image
            if ($request->hasFile('image_file')) {
                $path = $request->file('image_file')->store('images/ames', 'public');
                $data['image'] = $path;
            } elseif ($request->filled('image')) {
                $data['image'] = $request->image;
            }

            unset($data['image_file']);

            $ame = Ame::create($data);
            $ame->load(['campagne', 'encadreur', 'cellule.zone']);

            return response()->json([
                'status' => true,
                'message' => 'Âme créée avec succès',
                'data' => $ame,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de l\'âme',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Dernières âmes
     * 
     * Paramètres optionnels :
     * - limit : nombre d'âmes à retourner (défaut: 10)
     * - mine=true : retourne uniquement les âmes de l'utilisateur connecté
     */
    public function recentes(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);

            $query = Ame::with(['campagne', 'encadreur', 'cellule.zone'])
                ->orderBy('created_at', 'desc');

            $user = auth()->user();
            $showOnlyMine = $request->has('mine') && $request->mine === 'true';

            if ($showOnlyMine) {
                $query->where('assigne_a', $user->id);
            } elseif ($user->role === 'encadreur') {
                $query->where('assigne_a', $user->id);
            }

            $ames = $query->take($limit)->get();

            return response()->json([
                'status' => true,
                'message' => 'Dernières âmes récupérées avec succès',
                'data' => $ames,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des âmes récentes',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Afficher une âme spécifique
     */
    public function show($id)
    {
        try {
            $ame = Ame::findOrFail($id);

            $user = auth()->user();
            
            // ✅ Les encadreurs ne peuvent voir que leurs âmes
            // Les autres rôles peuvent voir toutes les âmes
            if ($user->role === 'encadreur' && $ame->assigne_a != $user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous n\'avez pas accès à cette âme',
                    'data' => [],
                ], 403);
            }

            $ame->load(['campagne', 'encadreur', 'cellule.zone', 'zone', 'interactions']);

            return response()->json([
                'status' => true,
                'message' => 'Âme récupérée avec succès',
                'data' => $ame,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Âme non trouvée',
                'error' => $e->getMessage(),
                'data' => [],
            ], 404);
        }
    }

    /**
     * Mettre à jour une âme
     */
    public function update(Request $request, $id)
    {
        try {
            $ame = Ame::findOrFail($id);

            $user = auth()->user();
            
            // ✅ Vérifier les permissions
            if ($user->role === 'encadreur' && $ame->assigne_a != $user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous ne pouvez pas modifier cette âme',
                    'data' => [],
                ], 403);
            }

            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'telephone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'sexe' => 'required|in:H,F',
                'age' => 'nullable|integer|min:0',
                'adresse' => 'nullable|string',
                'image' => 'nullable|string',
                'image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'date_conversion' => 'nullable|date',
                'campagne_id' => 'required|exists:campagnes,id',
                'type_decision' => 'nullable|string',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'assigne_a' => 'nullable|exists:users,id',
                'cellule_id' => 'nullable|exists:cellules,id',
                'suivi' => 'boolean',
                'derniere_interaction' => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $data = $validator->validated();

            // Vérifier la date de conversion si la campagne change
            if (isset($data['campagne_id']) && $data['campagne_id'] != $ame->campagne_id) {
                $campagne = Campagne::find($data['campagne_id']);
                if ($campagne) {
                    $dateConversion = isset($data['date_conversion'])
                        ? Carbon::parse($data['date_conversion'])
                        : Carbon::parse($ame->date_conversion);

                    if (!$campagne->isDateInPeriod($dateConversion)) {
                        return response()->json([
                            'status' => false,
                            'message' => 'La date de conversion doit être dans la période de la campagne',
                            'errors' => [
                                'date_conversion' => [
                                    'La date doit être entre ' .
                                    $campagne->date_debut->format('d/m/Y') .
                                    ' et ' .
                                    ($campagne->date_fin ? $campagne->date_fin->format('d/m/Y') : 'indéfinie')
                                ]
                            ]
                        ], 422);
                    }
                }
            }

            // Gestion de l'image
            if ($request->hasFile('image_file')) {
                if ($ame->image && !filter_var($ame->image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($ame->image);
                }
                $path = $request->file('image_file')->store('images/ames', 'public');
                $data['image'] = $path;
            } elseif ($request->filled('image')) {
                if ($ame->image && !filter_var($ame->image, FILTER_VALIDATE_URL) && !filter_var($request->image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($ame->image);
                }
                $data['image'] = $request->image;
            }

            unset($data['image_file']);

            $ame->update($data);
            $ame->load(['campagne', 'encadreur', 'cellule.zone']);

            return response()->json([
                'status' => true,
                'message' => 'Âme mise à jour avec succès',
                'data' => $ame,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour de l\'âme',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Supprimer une âme
     */
    public function destroy($id)
    {
        try {
            $ame = Ame::findOrFail($id);

            $user = auth()->user();
            
            // ✅ Vérifier les permissions
            if ($user->role === 'encadreur' && $ame->assigne_a != $user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous ne pouvez pas supprimer cette âme',
                    'data' => [],
                ], 403);
            }

            if ($ame->image && !filter_var($ame->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($ame->image);
            }

            $ame->delete();

            return response()->json([
                'status' => true,
                'message' => 'Âme supprimée avec succès',
                'data' => null,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression de l\'âme',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Récupérer les âmes par zone
     */
    public function parZone(Request $request)
    {
        try {
            $query = Ame::with(['zone', 'campagne', 'encadreur', 'cellule.zone']);

            $user = auth()->user();
            $showOnlyMine = $request->has('mine') && $request->mine === 'true';

            if ($showOnlyMine || $user->role === 'encadreur') {
                $query->where('assigne_a', $user->id);
            }

            if ($request->has('zone_id')) {
                $query->where('zone_id', $request->zone_id);
            }

            $ames = $query->get()->groupBy('zone_id');

            return response()->json([
                'status' => true,
                'message' => 'Âmes par zone récupérées avec succès',
                'data' => $ames,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des âmes par zone',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
        /**
     * Progressions de l'âme dans le parcours biblique
     */
    public function progressions()
    {
        return $this->hasMany(ProgressionAme::class);
    }

    /**
     * Réponses de l'âme aux questions
     */
    public function reponses()
    {
        return $this->hasMany(ReponseAme::class);
    }

    /**
     * ✅ NOUVELLE MÉTHODE : Statistiques personnelles de l'utilisateur
     */
    public function mesStatistiques(Request $request)
    {
        try {
            $user = auth()->user();
            
            $myAmes = Ame::where('assigne_a', $user->id)->count();
            $totalAmes = Ame::count();
            
            $myNouvellesAmes = Ame::where('assigne_a', $user->id)
                ->where('created_at', '>=', now()->subDays(7))
                ->count();
            
            $mySuivies = Ame::where('assigne_a', $user->id)
                ->where('suivi', true)
                ->count();

            $contribution = $totalAmes > 0 ? round(($myAmes / $totalAmes) * 100, 1) : 0;

            return response()->json([
                'status' => true,
                'message' => 'Mes statistiques récupérées avec succès',
                'data' => [
                    'mes_ames' => $myAmes,
                    'total_ames' => $totalAmes,
                    'mes_nouvelles_ames' => $myNouvellesAmes,
                    'mes_ames_suivies' => $mySuivies,
                    'ma_contribution_pourcentage' => $contribution,
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }
}