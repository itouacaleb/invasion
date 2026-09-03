<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistiqueSeeder extends Seeder
{
    public function run(): void
    {
        $campagne = DB::table('campagnes')->where('nom', 'like', 'Invasion%')->first();

        if (!$campagne) {
            dump('❌ Campagne Invasion introuvable, exécute CampagneSeeder d\'abord.');
            return;
        }

        DB::table('statistiques')->insert([
            'campagne_id' => $campagne->id,
            'total_ames' => 5,          // ✅ 5 âmes dans AmeSeeder
            'baptises' => 2,            // ✅ 2 baptisés (ex: Jean & Marcelline)
            'fidelises' => 2,           // ✅ 2 fidélisés (ex: Marie & Grâce)
            'nouvelles_ames' => 3,      // ✅ 3 nouvelles âmes (Première décision)
            'date_generation' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}