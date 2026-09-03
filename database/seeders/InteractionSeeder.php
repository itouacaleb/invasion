<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InteractionSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les âmes
        $ames = DB::table('ames')->get()->keyBy('nom');

        // Vérifier que les âmes existent (noms exacts selon AmeSeeder)
        $requiredNames = ['Jean Kimbangu', 'Marie Loubaki', 'Marcelline Nkounkou', 'Grâce Okombi', 'Jonathan Itoua'];
        foreach ($requiredNames as $name) {
            if (!isset($ames[$name])) {
                dump("⚠️ Âme '$name' non trouvée, exécute AmeSeeder d'abord.");
                return;
            }
        }

        $interactions = [
            // Jean Kimbangu
            [
                'ame_id' => $ames['Jean Kimbangu']->id,
                'user_id' => 2,
                'type' => 'visite',
                'note' => 'Visite à domicile. Jean montre un vif intérêt pour l\'étude biblique.',
                'date_interaction' => Carbon::create(2024, 1, 22),
            ],
            [
                'ame_id' => $ames['Jean Kimbangu']->id,
                'user_id' => 4,
                'type' => 'etude_biblique',
                'note' => 'Étude de Jean 3:16. Bonne participation.',
                'date_interaction' => Carbon::create(2024, 1, 28),
            ],

            // Marcelline Nkounkou
            [
                'ame_id' => $ames['Marcelline Nkounkou']->id,
                'user_id' => 2,
                'type' => 'appel',
                'note' => 'Appel pour confirmer la visite de demain. Très réceptive.',
                'date_interaction' => Carbon::create(2024, 3, 4),
            ],
            [
                'ame_id' => $ames['Marcelline Nkounkou']->id,
                'user_id' => 5,
                'type' => 'priere',
                'note' => 'Séance de prière pour des problèmes familiaux.',
                'date_interaction' => Carbon::create(2024, 3, 10),
            ],

            // Grâce Okombi
            [
                'ame_id' => $ames['Grâce Okombi']->id,
                'user_id' => 6,
                'type' => 'visite',
                'note' => 'Première visite. Accueil chaleureux. Intéressée par une cellule de prière.',
                'date_interaction' => Carbon::create(2024, 4, 12),
            ],
            [
                'ame_id' => $ames['Grâce Okombi']->id,
                'user_id' => 7,
                'type' => 'etude_biblique',
                'note' => 'Étude sur la vie de David. Beaucoup de questions pertinentes.',
                'date_interaction' => Carbon::create(2024, 4, 18),
            ],

            // Marie Loubaki (remplace Didier Mboungou)
            [
                'ame_id' => $ames['Marie Loubaki']->id,
                'user_id' => 3,
                'type' => 'appel',
                'note' => 'Rappel pour l\'inviter à la réunion de jeunesse.',
                'date_interaction' => Carbon::create(2024, 3, 8),
            ],

            // Jonathan Itoua
            [
                'ame_id' => $ames['Jonathan Itoua']->id,
                'user_id' => 7,
                'type' => 'priere',
                'note' => 'Prière de délivrance. Jeune homme très ému.',
                'date_interaction' => Carbon::create(2024, 5, 15),
            ],
        ];

        DB::table('interactions')->insert($interactions);
        dump('✅ Interactions insérées : ' . count($interactions));
    }
}