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
    // ✅ Contrôleurs Âme
    AmeAuthController,
    AmeParcoursController,
    MessageController,
    ContactController,
    // ✅ Chat Admin
    AdminChatController,
    PublicController
};
use Illuminate\Http\Request;

Route::prefix('v1')->group(function () {

    // ═══════════════════════════════════════════════════════════
    // 🔓 ROUTES PUBLIQUES
    // ═══════════════════════════════════════════════════════════

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('reset-password', 'resetPassword');
    });

    Route::prefix('zones')->controller(ZoneController::class)->group(function () {
        Route::get('/', 'indexPublic');
    });

    Route::prefix('ame-auth')->controller(AmeAuthController::class)->group(function () {
        Route::post('check-phone', 'checkPhone');
        Route::post('login', 'login');
    });
        // ✅ Routes publiques (visiteur, sans authentification)
    Route::prefix('public')->controller(PublicController::class)->group(function () {
        Route::get('eglise', 'eglise');
        Route::post('inscription', 'inscription');
    });

    // ═══════════════════════════════════════════════════════════
    // 🔐 ROUTES USER (Sanctum)
    // ═══════════════════════════════════════════════════════════
    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('auth')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });

        Route::get('user', function (Request $request) {
            return response()->json([
                'status' => true,
                'message' => 'Utilisateur connecté récupéré avec succès',
                'data' => $request->user()
            ]);
        });

        // ═══════════════════════════════════════════════════════
        // 💬 ADMIN CHAT
        // ═══════════════════════════════════════════════════════
        Route::prefix('admin/chat')->controller(AdminChatController::class)->group(function () {
            Route::get('inbox', 'inbox');
            Route::get('non-lus', 'nonLus');
            Route::get('ames/{ameId}', 'messages');
            Route::post('ames/{ameId}/prendre', 'prendre');
            Route::post('ames/{ameId}/repondre', 'repondre');
        });

        // ═══════════════════════════════════════════════════════
        // ADMIN
        // ═══════════════════════════════════════════════════════
        Route::prefix('admin')->group(function () {
            Route::get('dashboard', [AdminDashboardController::class, 'index']);
            Route::get('users/stats', [AdminDashboardController::class, 'usersStats']);
            Route::get('ames/stats', [AdminDashboardController::class, 'amesStats']);
            Route::post('ames/{id}/reset-pin', [AmeController::class, 'resetPin']);
        });

        // ═══════════════════════════════════════════════════════
        // AMES
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
    Route::put('/{id}/password', 'changeUserPassword');
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
        // PARCOURS BIBLIQUE (vue encadreur)
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
    // 🔐 ROUTES ÂME (Sanctum + ame.auth)
    // ═══════════════════════════════════════════════════════════
    Route::middleware(['auth:sanctum', 'ame.auth'])->group(function () {

        // ─── Auth Âme ───
        Route::prefix('ame-auth')->controller(AmeAuthController::class)->group(function () {
            Route::get('me', 'me');
            Route::post('logout', 'logout');
            Route::post('set-pin', 'setPin');
        });

        // ─── Parcours Spirituel ───
        Route::prefix('ame/parcours')->controller(AmeParcoursController::class)->group(function () {
            Route::get('niveaux', 'niveaux');
            Route::get('niveaux/{niveauId}/lecons', 'lecons');
            Route::get('lecons/{leconId}', 'lecon');
            Route::post('lecons/{leconId}/repondre', 'repondre');
            Route::get('progression', 'progression');
        });

        // ─── Chat Admin (broadcast intelligent) ───
        Route::prefix('ame/chat')->controller(MessageController::class)->group(function () {
            Route::get('admin', 'chatAdmin');
            Route::post('admin/envoyer', 'envoyerChatAdmin');
            Route::get('non-lus', 'nonLus');
        });

        // ─── Contact (liste des responsables) ───
        Route::prefix('ame/contact')->controller(ContactController::class)->group(function () {
            Route::get('responsables', 'responsables');
            Route::get('responsables/{userId}', 'show');
            Route::get('non-lus-total', 'nonLusTotal');
        });
    });
});