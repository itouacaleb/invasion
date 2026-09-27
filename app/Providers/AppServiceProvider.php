<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ✅ Enregistre les morph maps pour les relations polymorphiques
        Relation::morphMap([
            'ame' => \App\Models\Ame::class,
            'user' => \App\Models\User::class,
        ]);
    }
}