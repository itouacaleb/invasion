<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ames', function (Blueprint $table) {
            // ✅ Authentification (PIN hashé)
            $table->string('password')->nullable()->after('telephone');
            
            // ✅ Indique si l'âme a changé son PIN (00000 par défaut)
            $table->boolean('pin_modifie')->default(false)->after('password');
            
            // ✅ Dernière connexion
            $table->timestamp('derniere_connexion')->nullable()->after('pin_modifie');
            
            // ✅ Remember token pour Sanctum
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::table('ames', function (Blueprint $table) {
            $table->dropColumn([
                'password',
                'pin_modifie',
                'derniere_connexion',
                'remember_token',
            ]);
        });
    }
};