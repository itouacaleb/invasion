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

class ParcoursController extends Controller
{
    /**
     * Liste tous les niveaux avec la progression de l'âme
     * GET /api/v1/parcours/niveaux/{ameId}
     */
    public function niveaux($ameId)
    {
        try {
            $ame = Ame::findOrFail($ameId);

            $niveaux = Niveau::where('is_actif', true)
                ->orderBy('ordre')
                ->get()
                ->map(function ($niveau) use ($ameId) {
                    $progression = ProgressionAme::where('ame_id', $ameId)
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
                        'est_debloque' => $this->estDebloque($niveau->ordre, $ameId),
                    ];
                });

            return response()->json([
                'status' => true,
                'data' => [
                    'ame' => [
                        'id' => $ame->id,
                        'nom' => $ame->nom,
                    ],
                    'niveaux' => $niveaux,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Vérifie si un niveau est débloqué pour une âme
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
     * Liste les leçons d'un niveau avec progression
     * GET /api/v1/parcours/niveaux/{niveauId}/lecons/{ameId}
     */
    public function lecons($niveauId, $ameId)
    {
        try {
            $niveau = Niveau::findOrFail($niveauId);

            if (!$this->estDebloque($niveau->ordre, $ameId)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ce niveau est verrouillé. Complétez d\'abord le niveau précédent.',
                ], 403);
            }

            $lecons = Lecon::where('niveau_id', $niveauId)
                ->orderBy('ordre')
                ->get()
                ->map(function ($lecon) use ($ameId) {
                    $totalQuestions = Question::where('lecon_id', $lecon->id)->count();
                    $bonnesReponses = ReponseAme::where('ame_id', $ameId)
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
                        'est_completee' => $totalQuestions > 0 && $bonnesReponses === $totalQuestions,
                    ];
                });

            return response()->json([
                'status' => true,
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
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Détails d'une leçon avec ses questions
     * GET /api/v1/parcours/lecons/{leconId}/{ameId}
     */
    public function lecon($leconId, $ameId)
    {
        try {
            $lecon = Lecon::with('questions')->findOrFail($leconId);

            $reponses = ReponseAme::where('ame_id', $ameId)
                ->where('lecon_id', $leconId)
                ->get()
                ->keyBy('question_id');

            $questions = $lecon->questions->map(function ($question) use ($reponses) {
                $reponse = $reponses->get($question->id);
                return [
                    'id' => $question->id,
                    'question' => $question->question,
                    'options' => $question->options,
                    'points' => $question->points,
                    'bonne_reponse' => $question->bonne_reponse, // ✅ AJOUTÉ
                    'deja_repondu' => $reponse !== null,
                    'reponse_donnee' => $reponse?->reponse_donnee,
                    'est_correcte' => $reponse?->est_correcte,
                    'explication' => $question->explication, // ✅ Toujours envoyé
                ];
            });

            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $lecon->id,
                    'titre' => $lecon->titre,
                    'contenu' => $lecon->contenu,
                    'versets_cles' => $lecon->versets_cles,
                    'duree_minutes' => $lecon->duree_minutes,
                    'questions' => $questions,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Soumettre les réponses à une leçon
     * POST /api/v1/parcours/lecons/{leconId}/repondre
     */
    public function repondre(Request $request, $leconId)
    {
        try {
            $request->validate([
                'ame_id' => 'required|exists:ames,id',
                'reponses' => 'required|array',
                'reponses.*.question_id' => 'required|exists:questions,id',
                'reponses.*.reponse' => 'required|integer',
            ]);

            $ameId = $request->ame_id;
            $lecon = Lecon::findOrFail($leconId);

            DB::beginTransaction();

            $scoreLecon = 0;
            $scoreMax = 0;
            $bonnesReponses = 0;

            foreach ($request->reponses as $rep) {
                $question = Question::find($rep['question_id']);
                $estCorrecte = $rep['reponse'] === $question->bonne_reponse;
                $points = $estCorrecte ? $question->points : 0;

                $scoreLecon += $points;
                $scoreMax += $question->points;
                if ($estCorrecte) $bonnesReponses++;

                ReponseAme::updateOrCreate(
                    [
                        'ame_id' => $ameId,
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
            }

            $pourcentageLecon = $scoreMax > 0 ? ($scoreLecon / $scoreMax) * 100 : 0;

            $this->mettreAJourProgression($ameId, $lecon->niveau_id);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Réponses enregistrées',
                'data' => [
                    'score_lecon' => round($pourcentageLecon, 1),
                    'bonnes_reponses' => $bonnesReponses,
                    'total_questions' => count($request->reponses),
                    'est_reussi' => $pourcentageLecon >= 80,
                ],
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Met à jour la progression d'un niveau
     */
    private function mettreAJourProgression($ameId, $niveauId)
    {
        $totalLecons = Lecon::where('niveau_id', $niveauId)->count();

        $leconsCompletees = 0;
        $lecons = Lecon::where('niveau_id', $niveauId)->get();

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

    /**
     * Progression globale de l'âme
     * GET /api/v1/parcours/progression/{ameId}
     */
    public function progression($ameId)
    {
        try {
            $ame = Ame::findOrFail($ameId);
            $totalNiveaux = Niveau::where('is_actif', true)->count();

            $progressions = ProgressionAme::where('ame_id', $ameId)->get();
            $niveauxCompletes = $progressions->where('statut', 'complete')->count();

            $pourcentageGlobal = $totalNiveaux > 0
                ? round(($niveauxCompletes / $totalNiveaux) * 100)
                : 0;

            return response()->json([
                'status' => true,
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
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ], 500);
        }
    }
}