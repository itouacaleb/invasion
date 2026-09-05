<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcoursSpirituelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parcours = [
            [
                'nom' => 'Découverte de la Foi',
                'description' => 'Parcours initial pour les nouveaux convertis - bases du christianisme',
                'ordre' => 1,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Fondements Chrétiens',
                'description' => 'Approfondissement des doctrines essentielles de la foi',
                'ordre' => 2,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Disciples Actifs',
                'description' => 'Formation pour le service et l\'engagement dans l\'église',
                'ordre' => 3,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Leadership Spirituel',
                'description' => 'Préparation à responsabiliser d\'autres croyants',
                'ordre' => 4,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Ancien Parcours Alpha',
                'description' => 'Ancienne version du parcours découverte (désactivé)',
                'ordre' => 5,
                'est_actif' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'École du Dimanche',
                'description' => 'Parcours d\'enseignement biblique systématique',
                'ordre' => 6,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Vie de Prière',
                'description' => 'Approfondissement de la communion avec Dieu',
                'ordre' => 7,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // ✅ Vider la table avant d'insérer (évite les doublons)
        DB::table('parcours_spirituels')->truncate();
        
        // ✅ Insérer les données
        DB::table('parcours_spirituels')->insert($parcours);
    }
}