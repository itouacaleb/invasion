<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    AmeController,
    CampagneController,
    CelluleController,
    InteractionController,
    ParcoursSpirituelController,
    EtapeValideeController,
    NotificationController,
    StatistiqueController,
    UserController,
    ZoneController,
    TacheController,
    DashboardController,
    AdminDashboardController,
    ParcoursController,
};
use Illuminate\Http\Request;

Route::prefix('v1')->group(function () {
    // Authentification (routes publiques)
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('reset-password', 'resetPassword');
    });

    // Zones accessibles publiquement (pour l'inscription)
    Route::prefix('zones')->controller(ZoneController::class)->group(function () {
        Route::get('/', 'indexPublic');
    });

    // Routes protégées par Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        // Authentification
        Route::prefix('auth')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });

        // Utilisateur courant
        Route::get('user', function (Request $request) {
            return response()->json([
                'status' => true,
                'message' => 'Utilisateur connecté récupéré avec succès',
                'data' => $request->user()
            ]);
        });

        // ========== ADMIN ROUTES ==========
        Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
            Route::get('dashboard', [AdminDashboardController::class, 'index']);
            Route::get('users/stats', [AdminDashboardController::class, 'usersStats']);
            Route::get('ames/stats', [AdminDashboardController::class, 'amesStats']);
        });
        // ========== FIN ADMIN ROUTES ==========

        // ========== AMES ROUTES ==========
        Route::prefix('ames')->controller(AmeController::class)->group(function () {
            // ✅ Routes SPÉCIFIQUES d'abord (avant /{id})
            Route::get('/recentes', 'recentes');
            Route::get('/par-zone', 'parZone');
            Route::get('/mes-statistiques', 'mesStatistiques');

            // Routes CRUD
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
        // ========== FIN AMES ROUTES ==========

        // ========== CAMPAGNES ROUTES ==========
        Route::prefix('campagnes')->controller(CampagneController::class)->group(function () {
            // ✅ Routes SPÉCIFIQUES d'abord
            Route::get('/{id}/dates', 'getDates');

            // Routes CRUD
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
        // ========== FIN CAMPAGNES ROUTES ==========

        // ========== CARTES ROUTES ==========
        Route::prefix('cartes')->group(function () {
            Route::get('ames-par-zone', [AmeController::class, 'cartesData']);
        });

        // ========== DASHBOARD ROUTES ==========
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // ========== RAPPORTS ROUTES ==========
        Route::prefix('rapports')->group(function () {
            Route::get('fidelisation', [StatistiqueController::class, 'fidelisation']);
            Route::get('baptemes', [StatistiqueController::class, 'baptemes']);
        });

        // ========== CELLULES ROUTES ==========
        Route::prefix('cellules')->controller(CelluleController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== TACHES ROUTES ==========
        Route::prefix('taches')->controller(TacheController::class)->group(function () {
            // ✅ Routes SPÉCIFIQUES d'abord
            Route::get('/recentes', 'recentes');

            // Routes CRUD
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== INTERACTIONS ROUTES ==========
        Route::prefix('interactions')->controller(InteractionController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== PARCOURS SPIRITUELS ROUTES ==========
        Route::prefix('parcours-spirituels')->controller(ParcoursSpirituelController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== ETAPES VALIDEES ROUTES ==========
        Route::prefix('etapes-validees')->controller(EtapeValideeController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== NOTIFICATIONS ROUTES ==========
        Route::prefix('notifications')->controller(NotificationController::class)->group(function () {
            // ✅ Routes SPÉCIFIQUES d'abord
            Route::post('mark-as-read', 'markAsRead');

            // Routes CRUD
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== STATISTIQUES ROUTES ==========
        Route::prefix('statistiques')->controller(StatistiqueController::class)->group(function () {
            // ✅ Routes SPÉCIFIQUES d'abord
            Route::get('hebdomadaires', 'statsHebdomadaires');
            Route::get('mensuelles', 'statsMensuelles');

            // Routes CRUD
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== USERS ROUTES ==========
        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== ZONES ROUTES ==========
        Route::prefix('zones')->controller(ZoneController::class)->group(function () {
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ========== PARCOURS BIBLIQUE ROUTES ==========
        Route::prefix('parcours')->controller(ParcoursController::class)->group(function () {
            Route::get('/niveaux/{ameId}', 'niveaux');
            Route::get('/niveaux/{niveauId}/lecons/{ameId}', 'lecons');
            Route::get('/lecons/{leconId}/{ameId}', 'lecon');
            Route::post('/lecons/{leconId}/repondre', 'repondre');
            Route::get('/progression/{ameId}', 'progression');
        });
        // ========== FIN PARCOURS BIBLIQUE ROUTES ==========
    });
});