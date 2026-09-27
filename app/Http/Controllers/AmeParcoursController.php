<?php

namespace App\Http\Controllers;

use App\Models\Ame;
use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use App\Models\ProgressionAme;
use App\Models\ReponseAme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmeParcoursController extends Controller
{
    /**
     * Récupère l'âme connectée (à partir du token Sanctum).
     */
    private function ameConnectee(Request $request): ?Ame
    {
        $user = $request->user();
        return $user instanceof Ame ? $user : null;
    }

    /**
     * Liste tous les niveaux avec la progression de l'âme connectée.
     * GET /api/v1/ame/parcours/niveaux
     */
    public function niveaux(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $niveaux = Niveau::where('is_actif', true)
                ->orderBy('ordre')
                ->get()
                ->map(function ($niveau) use ($ame) {
                    $progression = ProgressionAme::where('ame_id', $ame->id)
                        ->where('niveau_id', $niveau->id)
                        ->first();

                    $totalLecons = Lecon::where('niveau_id', $niveau->id)->count();

                    return [
                        'id' => $niveau->id,
                        'nom' => $niveau->nom,
                        'description' => $niveau->description,
                        'ordre' => $niveau->ordre,
                        'icone' => $niveau->icone,
                        'couleur' => $niveau->couleur,
                        'total_lecons' => $totalLecons,
                        'statut' => $progression->statut ?? 'non_commence',
                        'lecons_completees' => $progression->lecons_completees ?? 0,
                        'score_total' => $progression->score_total ?? 0,
                        'score_requis' => $progression->score_requis ?? 80,
                        'date_debut' => $progression->date_debut ?? null,
                        'date_completion' => $progression->date_completion ?? null,
                        'est_debloque' => $this->estDebloque($niveau->ordre, $ame->id),
                    ];
                });

            // ✅ Statistiques globales
            $totalNiveaux = Niveau::where('is_actif', true)->count();
            $niveauxCompletes = ProgressionAme::where('ame_id', $ame->id)
                ->where('statut', 'complete')
                ->count();
            $pourcentageGlobal = $totalNiveaux > 0
                ? round(($niveauxCompletes / $totalNiveaux) * 100)
                : 0;

            return response()->json([
                'status' => true,
                'message' => 'Niveaux récupérés avec succès',
                'data' => [
                    'ame' => [
                        'id' => $ame->id,
                        'nom' => $ame->nom,
                    ],
                    'progression_globale' => [
                        'total_niveaux' => $totalNiveaux,
                        'niveaux_completes' => $niveauxCompletes,
                        'pourcentage' => $pourcentageGlobal,
                    ],
                    'niveaux' => $niveaux,
                ],
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des niveaux',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Liste les leçons d'un niveau.
     * GET /api/v1/ame/parcours/niveaux/{niveauId}/lecons
     */
    public function lecons(Request $request, $niveauId)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $niveau = Niveau::findOrFail($niveauId);

            if (!$this->estDebloque($niveau->ordre, $ame->id)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ce niveau est verrouillé. Complétez d\'abord le niveau précédent.',
                ], 403);
            }

            $lecons = Lecon::where('niveau_id', $niveauId)
                ->orderBy('ordre')
                ->get()
                ->map(function ($lecon) use ($ame) {
                    $totalQuestions = Question::where('lecon_id', $lecon->id)->count();
                    $bonnesReponses = ReponseAme::where('ame_id', $ame->id)
                        ->where('lecon_id', $lecon->id)
                        ->where('est_correcte', true)
                        ->count();

                    return [
                        'id' => $lecon->id,
                        'titre' => $lecon->titre,
                        'duree_minutes' => $lecon->duree_minutes,
                        'ordre' => $lecon->ordre,
                        'total_questions' => $totalQuestions,
                        'bonnes_reponses' => $bonnesReponses,
                        'est_completee' => $totalQuestions > 0
                            && $bonnesReponses === $totalQuestions,
                    ];
                });

            return response()->json([
                'status' => true,
                'message' => 'Leçons récupérées avec succès',
                'data' => [
                    'niveau' => [
                        'id' => $niveau->id,
                        'nom' => $niveau->nom,
                        'description' => $niveau->description,
                        'icone' => $niveau->icone,
                        'couleur' => $niveau->couleur,
                    ],
                    'lecons' => $lecons,
                ],
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des leçons',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Détails d'une leçon avec ses questions.
     * GET /api/v1/ame/parcours/lecons/{leconId}
     */
    public function lecon(Request $request, $leconId)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $lecon = Lecon::with('questions')->findOrFail($leconId);

            // ✅ Vérifie que le niveau est débloqué
            $niveau = Niveau::findOrFail($lecon->niveau_id);
            if (!$this->estDebloque($niveau->ordre, $ame->id)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ce niveau est verrouillé.',
                ], 403);
            }

            $reponses = ReponseAme::where('ame_id', $ame->id)
                ->where('lecon_id', $leconId)
                ->get()
                ->keyBy('question_id');

            $questions = $lecon->questions->map(function ($question) use ($reponses) {
                $reponse = $reponses->get($question->id);

                // ✅ On ne révèle PAS la bonne réponse tant que l'âme n'a pas répondu
                $dejaRepondu = $reponse !== null;

                return [
                    'id' => $question->id,
                    'question' => $question->question,
                    'options' => $question->options,
                    'points' => $question->points,
                    'deja_repondu' => $dejaRepondu,
                    'reponse_donnee' => $reponse?->reponse_donnee,
                    'est_correcte' => $reponse?->est_correcte,
                    // ✅ La bonne réponse n'est révélée qu'après avoir répondu
                    'bonne_reponse' => $dejaRepondu ? $question->bonne_reponse : null,
                    'explication' => $dejaRepondu ? $question->explication : null,
                ];
            });

            return response()->json([
                'status' => true,
                'message' => 'Leçon récupérée avec succès',
                'data' => [
                    'id' => $lecon->id,
                    'niveau_id' => $lecon->niveau_id,
                    'titre' => $lecon->titre,
                    'contenu' => $lecon->contenu,
                    'versets_cles' => $lecon->versets_cles,
                    'duree_minutes' => $lecon->duree_minutes,
                    'questions' => $questions,
                ],
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération de la leçon',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Soumet les réponses à une leçon.
     * POST /api/v1/ame/parcours/lecons/{leconId}/repondre
     */
    public function repondre(Request $request, $leconId)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'reponses' => 'required|array|min:1',
                'reponses.*.question_id' => 'required|exists:questions,id',
                'reponses.*.reponse' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $lecon = Lecon::findOrFail($leconId);

            // ✅ Vérifie que le niveau est débloqué
            $niveau = Niveau::findOrFail($lecon->niveau_id);
            if (!$this->estDebloque($niveau->ordre, $ame->id)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ce niveau est verrouillé.',
                ], 403);
            }

            DB::beginTransaction();

            $scoreLecon = 0;
            $scoreMax = 0;
            $bonnesReponses = 0;
            $details = [];

            foreach ($request->reponses as $rep) {
                $question = Question::where('id', $rep['question_id'])
                    ->where('lecon_id', $leconId)
                    ->first();

                if (!$question) {
                    continue; // Ignore les questions qui n'appartiennent pas à cette leçon
                }

                $estCorrecte = ((int) $rep['reponse']) === ((int) $question->bonne_reponse);
                $points = $estCorrecte ? $question->points : 0;

                $scoreLecon += $points;
                $scoreMax += $question->points;
                if ($estCorrecte) $bonnesReponses++;

                ReponseAme::updateOrCreate(
                    [
                        'ame_id' => $ame->id,
                        'question_id' => $question->id,
                    ],
                    [
                        'lecon_id' => $leconId,
                        'reponse_donnee' => $rep['reponse'],
                        'est_correcte' => $estCorrecte,
                        'points_obtenus' => $points,
                        'date_reponse' => now(),
                    ]
                );

                $details[] = [
                    'question_id' => $question->id,
                    'est_correcte' => $estCorrecte,
                    'bonne_reponse' => $question->bonne_reponse,
                    'explication' => $question->explication,
                ];
            }

            // ✅ Met à jour la progression du niveau
            $this->mettreAJourProgression($ame->id, $lecon->niveau_id);

            DB::commit();

            $pourcentageLecon = $scoreMax > 0 ? ($scoreLecon / $scoreMax) * 100 : 0;

            return response()->json([
                'status' => true,
                'message' => 'Réponses enregistrées',
                'data' => [
                    'score_lecon' => round($pourcentageLecon, 1),
                    'bonnes_reponses' => $bonnesReponses,
                    'total_questions' => count($request->reponses),
                    'est_reussi' => $pourcentageLecon >= 80,
                    'details' => $details,
                ],
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'enregistrement',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Progression globale de l'âme connectée.
     * GET /api/v1/ame/parcours/progression
     */
    public function progression(Request $request)
    {
        try {
            $ame = $this->ameConnectee($request);

            if (!$ame) {
                return response()->json([
                    'status' => false,
                    'message' => 'Non authentifié',
                ], 401);
            }

            $totalNiveaux = Niveau::where('is_actif', true)->count();

            $progressions = ProgressionAme::where('ame_id', $ame->id)
                ->with('niveau')
                ->get();

            $niveauxCompletes = $progressions->where('statut', 'complete')->count();

            $pourcentageGlobal = $totalNiveaux > 0
                ? round(($niveauxCompletes / $totalNiveaux) * 100)
                : 0;

            return response()->json([
                'status' => true,
                'message' => 'Progression récupérée',
                'data' => [
                    'ame' => [
                        'id' => $ame->id,
                        'nom' => $ame->nom,
                    ],
                    'total_niveaux' => $totalNiveaux,
                    'niveaux_completes' => $niveauxCompletes,
                    'pourcentage_global' => $pourcentageGlobal,
                    'progressions' => $progressions,
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

    // ============ MÉTHODES PRIVÉES ============

    /**
     * Vérifie si un niveau est débloqué pour une âme.
     */
    private function estDebloque($ordreNiveau, $ameId)
    {
        if ($ordreNiveau == 1) return true;

        $niveauPrecedent = Niveau::where('ordre', $ordreNiveau - 1)->first();
        if (!$niveauPrecedent) return false;

        $progression = ProgressionAme::where('ame_id', $ameId)
            ->where('niveau_id', $niveauPrecedent->id)
            ->first();

        return $progression && $progression->statut === 'complete';
    }

    /**
     * Met à jour la progression de l'âme pour un niveau.
     */
    private function mettreAJourProgression($ameId, $niveauId)
    {
        $totalLecons = Lecon::where('niveau_id', $niveauId)->count();
        $lecons = Lecon::where('niveau_id', $niveauId)->get();
        $leconsCompletees = 0;

        foreach ($lecons as $lecon) {
            $totalQuestions = Question::where('lecon_id', $lecon->id)->count();
            $bonnesReponses = ReponseAme::where('ame_id', $ameId)
                ->where('lecon_id', $lecon->id)
                ->where('est_correcte', true)
                ->count();

            if ($totalQuestions > 0 && $bonnesReponses === $totalQuestions) {
                $leconsCompletees++;
            }
        }

        $totalQuestionsNiveau = Question::whereIn('lecon_id', $lecons->pluck('id'))->count();
        $bonnesReponsesNiveau = ReponseAme::where('ame_id', $ameId)
            ->whereIn('lecon_id', $lecons->pluck('id'))
            ->where('est_correcte', true)
            ->count();

        $scoreTotal = $totalQuestionsNiveau > 0
            ? round(($bonnesReponsesNiveau / $totalQuestionsNiveau) * 100)
            : 0;

        $statut = 'non_commence';
        if ($leconsCompletees > 0) {
            $statut = 'en_cours';
        }
        if ($leconsCompletees === $totalLecons && $totalLecons > 0) {
            $statut = $scoreTotal >= 80 ? 'complete' : 'echoue';
        }

        $progression = ProgressionAme::firstOrNew([
            'ame_id' => $ameId,
            'niveau_id' => $niveauId,
        ]);

        if (!$progression->exists) {
            $progression->date_debut = now();
        }

        $progression->statut = $statut;
        $progression->lecons_completees = $leconsCompletees;
        $progression->score_total = $scoreTotal;

        if ($statut === 'complete' && !$progression->date_completion) {
            $progression->date_completion = now();
        }

        $progression->save();
    }
}   