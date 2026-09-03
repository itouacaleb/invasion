<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EtapeValideeSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les âmes et les parcours
        $ames = DB::table('ames')->get()->keyBy('nom');
        $parcours = DB::table('parcours_spirituels')->get()->keyBy('nom');

        // Vérifier que les âmes nécessaires existent
        $requiredNames = ['Jean Kimbangu', 'Marcelline Nkounkou', 'Grâce Okombi', 'Jonathan Itoua'];
        foreach ($requiredNames as $name) {
            if (!isset($ames[$name])) {
                dump("⚠️ Âme '$name' non trouvée, exécute AmeSeeder d'abord.");
                return;
            }
        }

        // Vérifier que les parcours existent
        $requiredParcours = ['Découverte de la Foi', 'Fondements Chrétiens', 'École du Dimanche'];
        foreach ($requiredParcours as $nomParcours) {
            if (!isset($parcours[$nomParcours])) {
                dump("⚠️ Parcours '$nomParcours' non trouvé, exécute ParcoursSpirituelSeeder d'abord.");
                return;
            }
        }

        $etapes = [];

        // Jean Kimbangu - Découverte de la Foi
        $etapes[] = [
            'ame_id' => $ames['Jean Kimbangu']->id,
            'parcours_spirituel_id' => $parcours['Découverte de la Foi']->id,
            'valide_par' => 2,
            'date_validation' => Carbon::create(2024, 2, 15),
            'commentaires' => 'Très bonnes bases acquises. Prêt pour l\'étape suivante.',
        ];

        // Jean Kimbangu - Fondements Chrétiens
        $etapes[] = [
            'ame_id' => $ames['Jean Kimbangu']->id,
            'parcours_spirituel_id' => $parcours['Fondements Chrétiens']->id,
            'valide_par' => 4,
            'date_validation' => Carbon::create(2024, 3, 20),
            'commentaires' => 'Examen réussi avec 85%. Bonne compréhension des doctrines.',
        ];

        // Marcelline Nkounkou - Découverte de la Foi
        $etapes[] = [
            'ame_id' => $ames['Marcelline Nkounkou']->id,
            'parcours_spirituel_id' => $parcours['Découverte de la Foi']->id,
            'valide_par' => 5,
            'date_validation' => Carbon::create(2024, 3, 12),
            'commentaires' => 'Conversion sincère. À suivre de près.',
        ];

        // Grâce Okombi - Découverte de la Foi
        $etapes[] = [
            'ame_id' => $ames['Grâce Okombi']->id,
            'parcours_spirituel_id' => $parcours['Découverte de la Foi']->id,
            'valide_par' => 7,
            'date_validation' => Carbon::create(2024, 4, 22),
            'commentaires' => 'Baptême prévu le mois prochain.',
        ];

        // Grâce Okombi - École du Dimanche
        $etapes[] = [
            'ame_id' => $ames['Grâce Okombi']->id,
            'parcours_spirituel_id' => $parcours['École du Dimanche']->id,
            'valide_par' => 6,
            'date_validation' => Carbon::create(2024, 5, 10),
            'commentaires' => 'Assidue aux cours. Participation active.',
        ];

        // Jonathan Itoua - Découverte de la Foi (non validé)
        $etapes[] = [
            'ame_id' => $ames['Jonathan Itoua']->id,
            'parcours_spirituel_id' => $parcours['Découverte de la Foi']->id,
            'valide_par' => null,
            'date_validation' => null,
            'commentaires' => 'En cours de formation. Quelques difficultés à surmonter.',
        ];

        DB::table('etapes_validees')->insert($etapes);
        dump('✅ Étapes validées insérées : ' . count($etapes));
    }
}