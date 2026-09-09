<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ame;
use App\Models\Campagne;
use App\Models\Interaction;
use App\Models\Statistique;
use App\Models\Tache;
use App\Models\Zone;
use App\Models\Cellule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Dashboard Admin - Vue globale de l'application
     * GET /api/v1/admin/dashboard
     */
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            
            if ($user->role !== 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Accès non autorisé. Vous devez être administrateur.',
                ], 403);
            }

            // ========== 1. STATISTIQUES GLOBALES ==========
            $stats = [
                'total_ames' => Ame::count(),
                'total_users' => User::count(),
                'total_campagnes' => Campagne::count(),
                'total_interactions' => Interaction::count(),
                'total_taches' => Tache::count(),
                'total_zones' => Zone::count(),
                'total_cellules' => Cellule::count(),
            ];

            // ========== 2. STATISTIQUES DES ÂMES ==========
            $amesStats = [
                'baptises' => Ame::where('type_decision', 'Première décision')->count(),
                'fidelises' => Ame::where('suivi', true)->count(),
                'nouvelles_ames' => Ame::where('created_at', '>=', now()->subDays(7))->count(),
                'par_type' => [
                    'premiere_decision' => Ame::where('type_decision', 'Première décision')->count(),
                    'redication' => Ame::where('type_decision', 'Rédication')->count(),
                    'renouvellement' => Ame::where('type_decision', 'Renouvellement')->count(),
                    'reflexion' => Ame::where('type_decision', 'En réflexion')->count(),
                ],
                'par_sexe' => [
                    'hommes' => Ame::where('sexe', 'H')->count(),
                    'femmes' => Ame::where('sexe', 'F')->count(),
                ],
            ];

            // ========== 3. STATISTIQUES DES UTILISATEURS ==========
            $usersStats = [
                'admins' => User::where('role', 'admin')->count(),
                'encadreurs' => User::where('role', 'encadreur')->count(),
                'evangelistes' => User::where('role', 'evangeliste')->count(),
            ];

            // ========== 4. DERNIÈRES ÂMES AJOUTÉES ==========
            $dernieresAmes = Ame::with(['campagne', 'encadreur', 'cellule'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($ame) {
                    return [
                        'id' => $ame->id,
                        'nom' => $ame->nom,
                        'telephone' => $ame->telephone,
                        'type_decision' => $ame->type_decision,
                        'suivi' => $ame->suivi,
                        'created_at' => $ame->created_at,
                        'campagne' => $ame->campagne ? $ame->campagne->nom : null,
                        'encadreur' => $ame->encadreur ? $ame->encadreur->nom : null,
                    ];
                });

            // ========== 5. DERNIERS UTILISATEURS ==========
            $derniersUsers = User::orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'nom' => $user->nom,
                        'email' => $user->email,
                        'telephone' => $user->telephone,
                        'role' => $user->role,
                        'created_at' => $user->created_at,
                    ];
                });

            // ========== 6. CAMPAGNES EN COURS ==========
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
                        'zone' => $campagne->zone ? $campagne->zone->nom : null,
                        'total_ames' => $campagne->ames->count(),
                        'progression' => $campagne->date_fin ? 
                            round((now()->diffInDays($campagne->date_debut) / $campagne->date_fin->diffInDays($campagne->date_debut)) * 100, 0) : 
                            0,
                    ];
                });

            // ========== 7. ÉVOLUTION MENSUELLE (12 derniers mois) ==========
            $mois = [];
            $conversions = [];
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $mois[] = $date->format('M');
                $conversions[] = Ame::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
            }

            // ========== 8. RÉPARTITION PAR ZONE ==========
            $zones = Zone::select('zones.id', 'zones.nom')
                ->withCount('users as total_users')
                ->withCount('ames as total_ames')
                ->get()
                ->map(function ($zone) {
                    return [
                        'id' => $zone->id,
                        'nom' => $zone->nom,
                        'total_ames' => $zone->total_ames ?? 0,
                        'total_users' => $zone->total_users ?? 0,
                    ];
                });

            // ========== 9. DERNIÈRES INTERACTIONS ==========
            $dernieresInteractions = Interaction::with(['ame', 'user'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($interaction) {
                    return [
                        'id' => $interaction->id,
                        'type' => $interaction->type,
                        'note' => $interaction->note,
                        'date_interaction' => $interaction->date_interaction,
                        'ame' => $interaction->ame ? $interaction->ame->nom : null,
                        'user' => $interaction->user ? $interaction->user->nom : null,
                    ];
                });

            // ========== 10. STATISTIQUES DES TÂCHES ==========
            $tachesStats = [
                'en_attente' => Tache::where('statut', 'en_attente')->count(),
                'terminees' => Tache::where('statut', 'terminee')->count(),
                'annulees' => Tache::where('statut', 'annulee')->count(),
                'par_priorite' => [
                    'basse' => Tache::where('priorite', 'basse')->count(),
                    'normale' => Tache::where('priorite', 'normale')->count(),
                    'haute' => Tache::where('priorite', 'haute')->count(),
                ],
            ];

            // ========== 11. STATISTIQUES DERNIÈRE STATISTIQUE ==========
            $derniereStatistique = Statistique::with('campagne')
                ->orderBy('date_generation', 'desc')
                ->first();

            return response()->json([
                'status' => true,
                'message' => 'Dashboard admin récupéré avec succès',
                'data' => [
                    'stats' => $stats,
                    'ames_stats' => $amesStats,
                    'users_stats' => $usersStats,
                    'dernieres_ames' => $dernieresAmes,
                    'derniers_users' => $derniersUsers,
                    'campagnes' => $campagnes,
                    'evolution' => [
                        'mois' => $mois,
                        'conversions' => $conversions,
                    ],
                    'zones' => $zones,
                    'dernieres_interactions' => $dernieresInteractions,
                    'taches_stats' => $tachesStats,
                    'derniere_statistique' => $derniereStatistique,
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
     * Statistiques des utilisateurs par zone
     * GET /api/v1/admin/users/stats
     */
    public function usersStats(Request $request)
    {
        try {
            $user = Auth::user();
            
            if ($user->role !== 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Accès non autorisé',
                ], 403);
            }

            $stats = [
                'total' => User::count(),
                'par_role' => [
                    'admin' => User::where('role', 'admin')->count(),
                    'encadreur' => User::where('role', 'encadreur')->count(),
                    'evangeliste' => User::where('role', 'evangeliste')->count(),
                ],
                'par_zone' => Zone::withCount('users')
                    ->get()
                    ->map(function ($zone) {
                        return [
                            'zone' => $zone->nom,
                            'total' => $zone->users_count,
                        ];
                    }),
            ];

            return response()->json([
                'status' => true,
                'message' => 'Statistiques utilisateurs récupérées',
                'data' => $stats,
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
     * Statistiques des âmes par zone
     * GET /api/v1/admin/ames/stats
     */
    public function amesStats(Request $request)
    {
        try {
            $user = Auth::user();
            
            if ($user->role !== 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Accès non autorisé',
                ], 403);
            }

            $stats = [
                'total' => Ame::count(),
                'par_type' => [
                    'premiere_decision' => Ame::where('type_decision', 'Première décision')->count(),
                    'redication' => Ame::where('type_decision', 'Rédication')->count(),
                    'renouvellement' => Ame::where('type_decision', 'Renouvellement')->count(),
                    'reflexion' => Ame::where('type_decision', 'En réflexion')->count(),
                ],
                'par_sexe' => [
                    'hommes' => Ame::where('sexe', 'H')->count(),
                    'femmes' => Ame::where('sexe', 'F')->count(),
                ],
                'par_zone' => Zone::withCount('ames')
                    ->get()
                    ->map(function ($zone) {
                        return [
                            'zone' => $zone->nom,
                            'total' => $zone->ames_count,
                        ];
                    }),
            ];

            return response()->json([
                'status' => true,
                'message' => 'Statistiques des âmes récupérées',
                'data' => $stats,
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}