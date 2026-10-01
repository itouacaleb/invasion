<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParcoursSpirituelController extends Controller
{
    // ═══════════════════════════════════════════════════════════
    // 📚 NIVEAUX (parcours)
    // ═══════════════════════════════════════════════════════════

    /**
     * Liste tous les niveaux
     * GET /api/v1/parcours-spirituels
     */
    public function index(Request $request)
    {
        try {
            $query = Niveau::query();

            if ($request->has('actifs') && $request->actifs === 'true') {
                $query->where('is_actif', true);
            }

            $niveaux = $query->orderBy('ordre')->get()
                ->map(function ($niveau) {
                    return [
                        'id' => $niveau->id,
                        'nom' => $niveau->nom,
                        'description' => $niveau->description,
                        'ordre' => $niveau->ordre,
                        'icone' => $niveau->icone,
                        'couleur' => $niveau->couleur,
                        'is_actif' => $niveau->is_actif,
                        'total_lecons' => Lecon::where('niveau_id', $niveau->id)->count(),
                        'created_at' => $niveau->created_at,
                    ];
                });

            return response()->json([
                'status' => true,
                'message' => 'Niveaux récupérés avec succès',
                'data' => $niveaux,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Créer un niveau
     * POST /api/v1/parcours-spirituels
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255|unique:niveaux,nom',
                'description' => 'nullable|string',
                'ordre' => 'required|integer|min:1',
                'icone' => 'nullable|string|max:10',
                'couleur' => 'nullable|string|max:20',
                'is_actif' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $niveau = Niveau::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'ordre' => $request->ordre,
                'icone' => $request->icone ?? '📖',
                'couleur' => $request->couleur ?? '#2E7D32',
                'is_actif' => $request->is_actif ?? true,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Niveau créé avec succès',
                'data' => $niveau,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Détails d'un niveau avec ses leçons
     * GET /api/v1/parcours-spirituels/{id}
     */
    public function show($id)
    {
        try {
            $niveau = Niveau::with(['lecons.questions'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Niveau récupéré avec succès',
                'data' => $niveau,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Niveau introuvable',
                'error' => $e->getMessage(),
                'data' => [],
            ], 404);
        }
    }

    /**
     * Modifier un niveau
     * PUT /api/v1/parcours-spirituels/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            $niveau = Niveau::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nom' => 'sometimes|required|string|max:255|unique:niveaux,nom,' . $id,
                'description' => 'nullable|string',
                'ordre' => 'sometimes|required|integer|min:1',
                'icone' => 'nullable|string|max:10',
                'couleur' => 'nullable|string|max:20',
                'is_actif' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $niveau->update($validator->validated());

            return response()->json([
                'status' => true,
                'message' => 'Niveau mis à jour avec succès',
                'data' => $niveau->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Supprimer un niveau
     * DELETE /api/v1/parcours-spirituels/{id}
     */
    public function destroy($id)
    {
        try {
            $niveau = Niveau::findOrFail($id);
            $niveau->delete();

            return response()->json([
                'status' => true,
                'message' => 'Niveau supprimé avec succès',
                'data' => null,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    // ═══════════════════════════════════════════════════════════
    // 📖 LEÇONS
    // ═══════════════════════════════════════════════════════════

    /**
     * Liste des leçons d'un niveau
     * GET /api/v1/parcours-spirituels/{parcoursId}/lecons
     */
    public function lecons($parcoursId)
    {
        try {
            Niveau::findOrFail($parcoursId);

            $lecons = Lecon::where('niveau_id', $parcoursId)
                ->orderBy('ordre')
                ->get()
                ->map(function ($lecon) {
                    return [
                        'id' => $lecon->id,
                        'niveau_id' => $lecon->niveau_id,
                        'titre' => $lecon->titre,
                        'contenu' => $lecon->contenu,
                        'versets_cles' => $lecon->versets_cles,
                        'ordre' => $lecon->ordre,
                        'duree_minutes' => $lecon->duree_minutes,
                        'total_questions' => Question::where('lecon_id', $lecon->id)->count(),
                    ];
                });

            return response()->json([
                'status' => true,
                'message' => 'Leçons récupérées avec succès',
                'data' => $lecons,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Créer une leçon
     * POST /api/v1/parcours-spirituels/lecons
     */
    public function storeLecon(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'parcours_spirituel_id' => 'required|exists:niveaux,id',
                'titre' => 'required|string|max:255',
                'contenu' => 'required|string',
                'verset_cle' => 'nullable|string',
                'versets_cles' => 'nullable|string',
                'ordre' => 'required|integer|min:1',
                'duree_minutes' => 'nullable|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $lecon = Lecon::create([
                'niveau_id' => $request->parcours_spirituel_id,
                'titre' => $request->titre,
                'contenu' => $request->contenu,
                'versets_cles' => $request->verset_cle ?? $request->versets_cles,
                'ordre' => $request->ordre,
                'duree_minutes' => $request->duree_minutes ?? 10,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Leçon créée avec succès',
                'data' => $lecon,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Modifier une leçon
     * PUT /api/v1/parcours-spirituels/lecons/{id}
     */
    public function updateLecon(Request $request, $id)
    {
        try {
            $lecon = Lecon::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'titre' => 'sometimes|required|string|max:255',
                'contenu' => 'sometimes|required|string',
                'verset_cle' => 'nullable|string',
                'versets_cles' => 'nullable|string',
                'ordre' => 'sometimes|required|integer|min:1',
                'duree_minutes' => 'nullable|integer|min:1',
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
            if (isset($data['verset_cle'])) {
                $data['versets_cles'] = $data['verset_cle'];
                unset($data['verset_cle']);
            }

            $lecon->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Leçon mise à jour avec succès',
                'data' => $lecon->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Supprimer une leçon
     * DELETE /api/v1/parcours-spirituels/lecons/{id}
     */
    public function destroyLecon($id)
    {
        try {
            $lecon = Lecon::findOrFail($id);
            $lecon->delete();

            return response()->json([
                'status' => true,
                'message' => 'Leçon supprimée avec succès',
                'data' => null,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    // ═══════════════════════════════════════════════════════════
    // ❓ QUESTIONS
    // ═══════════════════════════════════════════════════════════

    /**
     * Liste des questions d'une leçon
     * GET /api/v1/parcours-spirituels/lecons/{leconId}/questions
     */
    public function questions($leconId)
    {
        try {
            Lecon::findOrFail($leconId);

            $questions = Question::where('lecon_id', $leconId)
                ->orderBy('id')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Questions récupérées avec succès',
                'data' => $questions,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Créer une question
     * POST /api/v1/parcours-spirituels/questions
     */
    public function storeQuestion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lecon_id' => 'required|exists:lecons,id',
                'question' => 'required|string',
                'options' => 'required|array|min:2',
                'options.*' => 'required|string',
                'bonne_reponse' => 'required|integer|min:0',
                'explication' => 'nullable|string',
                'points' => 'nullable|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $optionsCount = count($request->options);
            if ($request->bonne_reponse >= $optionsCount) {
                return response()->json([
                    'status' => false,
                    'message' => 'L\'index de la bonne réponse est invalide',
                    'data' => [],
                ], 422);
            }

            $question = Question::create([
                'lecon_id' => $request->lecon_id,
                'question' => $request->question,
                'options' => $request->options,
                'bonne_reponse' => $request->bonne_reponse,
                'explication' => $request->explication,
                'points' => $request->points ?? 1,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Question créée avec succès',
                'data' => $question,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Modifier une question
     * PUT /api/v1/parcours-spirituels/questions/{id}
     */
    public function updateQuestion(Request $request, $id)
    {
        try {
            $question = Question::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'question' => 'sometimes|required|string',
                'options' => 'sometimes|required|array|min:2',
                'options.*' => 'required|string',
                'bonne_reponse' => 'sometimes|required|integer|min:0',
                'explication' => 'nullable|string',
                'points' => 'nullable|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                    'data' => [],
                ], 422);
            }

            $question->update($validator->validated());

            return response()->json([
                'status' => true,
                'message' => 'Question mise à jour avec succès',
                'data' => $question->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    /**
     * Supprimer une question
     * DELETE /api/v1/parcours-spirituels/questions/{id}
     */
    public function destroyQuestion($id)
    {
        try {
            $question = Question::findOrFail($id);
            $question->delete();

            return response()->json([
                'status' => true,
                'message' => 'Question supprimée avec succès',
                'data' => null,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression',
                'error' => $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }
}