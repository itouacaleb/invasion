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
    // ✅ NOUVEAUX contrôleurs (Âme)
    AmeAuthController,
    AmeParcoursController,
    MessageController,
    ContactController,
};
use Illuminate\Http\Request;

Route::prefix('v1')->group(function () {

    // ═══════════════════════════════════════════════════════════
    // 🔓 ROUTES PUBLIQUES
    // ═══════════════════════════════════════════════════════════

    // Auth User (encadreurs, évangélistes, admins)
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('reset-password', 'resetPassword');
    });

    // Zones publiques
    Route::prefix('zones')->controller(ZoneController::class)->group(function () {
        Route::get('/', 'indexPublic');
    });

    // ✅ Auth Âme (public) - login par téléphone + PIN
    Route::prefix('ame-auth')->controller(AmeAuthController::class)->group(function () {
        Route::post('check-phone', 'checkPhone');
        Route::post('login', 'login');
    });

    // ═══════════════════════════════════════════════════════════
    // 🔐 ROUTES USER (Sanctum) - encadreurs, évangélistes, admins
    // ═══════════════════════════════════════════════════════════
    Route::middleware('auth:sanctum')->group(function () {

        // Auth User
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

        // ═══════════════════════════════════════════════════════
        // ADMIN ROUTES
        // ═══════════════════════════════════════════════════════
        Route::prefix('admin')->group(function () {
            Route::get('dashboard', [AdminDashboardController::class, 'index']);
            Route::get('users/stats', [AdminDashboardController::class, 'usersStats']);
            Route::get('ames/stats', [AdminDashboardController::class, 'amesStats']);

            // ✅ Réinitialisation du PIN d'une âme
            Route::post('ames/{id}/reset-pin', [AmeController::class, 'resetPin']);
        });

        // ═══════════════════════════════════════════════════════
        // AMES ROUTES (côté encadreurs/admins)
        // ═══════════════════════════════════════════════════════
        Route::prefix('ames')->controller(AmeController::class)->group(function () {
            Route::get('/recentes', 'recentes');
            Route::get('/par-zone', 'parZone');
            Route::get('/mes-statistiques', 'mesStatistiques');

            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // CAMPAGNES
        // ═══════════════════════════════════════════════════════
        Route::prefix('campagnes')->controller(CampagneController::class)->group(function () {
            Route::get('/{id}/dates', 'getDates');
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // CARTES
        // ═══════════════════════════════════════════════════════
        Route::prefix('cartes')->group(function () {
            Route::get('ames-par-zone', [AmeController::class, 'cartesData']);
        });

        // ═══════════════════════════════════════════════════════
        // DASHBOARD
        // ═══════════════════════════════════════════════════════
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // ═══════════════════════════════════════════════════════
        // RAPPORTS
        // ═══════════════════════════════════════════════════════
        Route::prefix('rapports')->group(function () {
            Route::get('fidelisation', [StatistiqueController::class, 'fidelisation']);
            Route::get('baptemes', [StatistiqueController::class, 'baptemes']);
        });

        // ═══════════════════════════════════════════════════════
        // CELLULES
        // ═══════════════════════════════════════════════════════
        Route::prefix('cellules')->controller(CelluleController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // TACHES
        // ═══════════════════════════════════════════════════════
        Route::prefix('taches')->controller(TacheController::class)->group(function () {
            Route::get('/recentes', 'recentes');
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // INTERACTIONS
        // ═══════════════════════════════════════════════════════
        Route::prefix('interactions')->controller(InteractionController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // PARCOURS SPIRITUELS
        // ═══════════════════════════════════════════════════════
        Route::prefix('parcours-spirituels')->controller(ParcoursSpirituelController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // ETAPES VALIDEES
        // ═══════════════════════════════════════════════════════
        Route::prefix('etapes-validees')->controller(EtapeValideeController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // NOTIFICATIONS
        // ═══════════════════════════════════════════════════════
        Route::prefix('notifications')->controller(NotificationController::class)->group(function () {
            Route::post('mark-as-read', 'markAsRead');
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // STATISTIQUES
        // ═══════════════════════════════════════════════════════
        Route::prefix('statistiques')->controller(StatistiqueController::class)->group(function () {
            Route::get('dashboard', 'dashboard');
            Route::get('hebdomadaires', 'statsHebdomadaires');
            Route::get('mensuelles', 'statsMensuelles');
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // USERS
        // ═══════════════════════════════════════════════════════
        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // ZONES
        // ═══════════════════════════════════════════════════════
        Route::prefix('zones')->controller(ZoneController::class)->group(function () {
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        // ═══════════════════════════════════════════════════════
        // PARCOURS BIBLIQUE (côté user - vue de l'encadreur)
        // ═══════════════════════════════════════════════════════
        Route::prefix('parcours')->controller(ParcoursController::class)->group(function () {
            Route::get('/niveaux/{ameId}', 'niveaux');
            Route::get('/niveaux/{niveauId}/lecons/{ameId}', 'lecons');
            Route::get('/lecons/{leconId}/{ameId}', 'lecon');
            Route::post('/lecons/{leconId}/repondre', 'repondre');
            Route::get('/progression/{ameId}', 'progression');
        });
    });

    // ═══════════════════════════════════════════════════════════
    // 🔐 ROUTES ÂME (Sanctum + Middleware ame.auth)
    // ═══════════════════════════════════════════════════════════
    Route::middleware(['auth:sanctum', 'ame.auth'])->group(function () {

        // ─── Auth Âme (actions après connexion) ───
        Route::prefix('ame-auth')->controller(AmeAuthController::class)->group(function () {
            Route::get('me', 'me');
            Route::post('logout', 'logout');
            Route::post('set-pin', 'setPin');
        });

        // ─── Parcours Spirituel (côté âme) ───
        Route::prefix('ame/parcours')->controller(AmeParcoursController::class)->group(function () {
            Route::get('niveaux', 'niveaux');
            Route::get('niveaux/{niveauId}/lecons', 'lecons');
            Route::get('lecons/{leconId}', 'lecon');
            Route::post('lecons/{leconId}/repondre', 'repondre');
            Route::get('progression', 'progression');
        });

        // ─── Messages (côté âme) ───
        Route::prefix('ame/messages')->controller(MessageController::class)->group(function () {
            Route::get('conversations', 'conversations');
            Route::get('non-lus', 'nonLus');
            Route::post('envoyer', 'envoyer');
            Route::get('{userId}', 'messages');
        });

        // ─── Contact (responsables disponibles) ───
        Route::prefix('ame/contact')->controller(ContactController::class)->group(function () {
            Route::get('responsables', 'responsables');
            Route::get('responsables/{userId}', 'show');
            Route::get('non-lus-total', 'nonLusTotal');
        });
    });
});