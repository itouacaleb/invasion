<?php

namespace App\Http\Controllers;

use App\Models\Statistique;
use App\Models\Tache;
use App\Models\Campagne;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Récupère toutes les données du dashboard en une seule requête
     * GET /api/v1/dashboard
     */
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            $userId = $user ? $user->id : null;

            // 1. Statistiques (dernière entrée)
            $statistique = Statistique::with('campagne')
                ->orderBy('date_generation', 'desc')
                ->first();

            // 2. Total des âmes depuis les statistiques
            $totalAmes = Statistique::sum('total_ames') ?? 0;

            // 3. Baptêmes depuis les statistiques
            $baptemes = Statistique::sum('baptises') ?? 0;

            // 4. Nouvelles âmes depuis les statistiques
            $nouvellesAmes = Statistique::sum('nouvelles_ames') ?? 0;

            // 5. Visites (interactions de type 'visite')
            $visites = Interaction::where('type', 'visite')->count();

            // 6. Tâches en cours (pour l'utilisateur connecté)
            $tachesEnCours = 0;
            $tachesRecentes = [];
            if ($userId) {
                $tachesEnCours = Tache::where('user_id', $userId)
                    ->where('statut', 'en_attente')
                    ->count();

                $tachesRecentes = Tache::with('ame')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get()
                    ->map(function ($tache) {
                        return [
                            'id' => $tache->id,
                            'titre' => $tache->titre,
                            'description' => $tache->description,
                            'statut' => $tache->statut,
                            'priorite' => $tache->priorite,
                            'echeance' => $tache->echeance,
                            'ame' => $tache->ame ? [
                                'id' => $tache->ame->id,
                                'nom' => $tache->ame->nom,
                            ] : null,
                        ];
                    });
            }

            // 7. Campagnes en cours
            $campagnes = Campagne::with(['zone', 'ames'])
                ->where(function ($query) {
                    $query->where('date_fin', '>=', now())
                        ->orWhereNull('date_fin');
                })
                ->get()
                ->map(function ($campagne) {
                    return [
                        'id' => $campagne->id,
                        'nom' => $campagne->nom,
                        'date_debut' => $campagne->date_debut,
                        'date_fin' => $campagne->date_fin,
                        'zone' => $campagne->zone ? [
                            'id' => $campagne->zone->id,
                            'nom' => $campagne->zone->nom,
                        ] : null,
                        'total_ames' => $campagne->ames->count(),
                    ];
                });

            // 8. Statistiques hebdomadaires (pour les graphiques)
            $hebdomadaires = $this->getStatsHebdomadaires();

            // 9. Statistiques mensuelles (pour les graphiques)
            $mensuelles = $this->getStatsMensuelles();

            return response()->json([
                'status' => true,
                'message' => 'Dashboard récupéré avec succès',
                'data' => [
                    'statistiques' => [
                        'total_ames' => $totalAmes,
                        'baptemes' => $baptemes,
                        'nouvelles_ames' => $nouvellesAmes,
                        'derniere_statistique' => $statistique,
                    ],
                    'visites' => $visites,
                    'taches' => [
                        'en_cours' => $tachesEnCours,
                        'recentes' => $tachesRecentes,
                    ],
                    'campagnes' => $campagnes,
                    'graphiques' => [
                        'hebdomadaires' => $hebdomadaires,
                        'mensuelles' => $mensuelles,
                    ],
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération du dashboard',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    /**
     * Statistiques hebdomadaires
     */
    private function getStatsHebdomadaires()
    {
        try {
            $stats = \DB::table('ames')
                ->select(
                    \DB::raw('WEEK(created_at, 1) as semaine'),
                    \DB::raw('COUNT(*) as nouvelles_ames'),
                    \DB::raw('SUM(CASE WHEN suivi = true THEN 1 ELSE 0 END) as ames_suivies')
                )
                ->whereYear('created_at', now()->year)
                ->groupBy('semaine')
                ->orderBy('semaine')
                ->get();

            return [
                'semaines' => $stats->pluck('semaine')->map(fn($s) => "S$s"),
                'nouvelles_ames' => $stats->pluck('nouvelles_ames'),
                'ames_suivies' => $stats->pluck('ames_suivies'),
            ];
        } catch (\Exception $e) {
            return ['semaines' => [], 'nouvelles_ames' => [], 'ames_suivies' => []];
        }
    }

    /**
     * Statistiques mensuelles
     */
    private function getStatsMensuelles()
    {
        try {
            $moisFr = [
                1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
                5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Aoû',
                9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
            ];

            $stats = \DB::table('ames')
                ->select(
                    \DB::raw('MONTH(created_at) as mois'),
                    \DB::raw('COUNT(*) as conversions')
                )
                ->whereYear('created_at', now()->year)
                ->groupBy('mois')
                ->orderBy('mois')
                ->get()
                ->keyBy('mois');

            $labels = [];
            $values = [];

            for ($m = 1; $m <= 12; $m++) {
                $labels[] = $moisFr[$m];
                $values[] = isset($stats[$m]) ? (int)$stats[$m]->conversions : 0;
            }

            return [
                'mois' => $labels,
                'conversions' => $values,
            ];
        } catch (\Exception $e) {
            return ['mois' => [], 'conversions' => []];
        }
    }
}