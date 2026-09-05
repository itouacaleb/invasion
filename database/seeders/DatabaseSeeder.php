<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ZoneSeeder::class,           // 1. Zones
            UserSeeder::class,           // 2. Utilisateurs
            CampagneSeeder::class,       // 3. Campagne
            CelluleSeeder::class,        // 4. Cellules
            AmeSeeder::class,            // 5. Âmes
            ParcoursSpirituelSeeder::class, // 6. Parcours spirituels
            StatistiqueSeeder::class,    // 7. Statistiques (après les âmes)
            InteractionSeeder::class,    // 8. Interactions
            EtapeValideeSeeder::class,   // 9. Étapes validées
            TacheSeeder::class,          // 10. Tâches (manquant !)
            NotificationSeeder::class,   // 11. Notifications
            RoleSeeder::class,           // 12. Rôles (optionnel)
        ]);
    }
}