<?php

namespace Database\Seeders;

use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ParcoursSeeder extends Seeder
{
    public function run(): void
    {
        // ═══════════════════════════════════════════════
        // NIVEAU 1 : LE SALUT
        // ═══════════════════════════════════════════════
        $niveau1 = Niveau::create([
            'nom' => 'Le Salut',
            'description' => 'Comprendre le don du salut en Jésus-Christ',
            'ordre' => 1,
            'icone' => '❤️',
            'couleur' => '#E65100',
            'is_actif' => true,
        ]);

        // Leçon 1.1
        $lecon1_1 = Lecon::create([
            'niveau_id' => $niveau1->id,
            'titre' => 'Qu\'est-ce que le salut ?',
            'contenu' => "Le **salut** est un don gratuit de Dieu offert à toute l'humanité.\n\n" .
                "📖 **Verset clé** : Jean 3:16\n" .
                "« Car Dieu a tant aimé le monde qu'Il a donné Son Fils unique, afin que quiconque croit en Lui ne périsse point, mais qu'il ait la vie éternelle. »\n\n" .
                "💡 **À retenir** :\n" .
                "- Le salut ne s'achète pas, il se reçoit par la foi\n" .
                "- C'est un cadeau de Dieu, pas un salaire\n" .
                "- Il est disponible pour tous ceux qui croient\n\n" .
                "🙏 **Prière** : « Seigneur, je Te remercie pour le don du salut. Je crois que Jésus est mort et ressuscité pour moi. Amen. »",
            'versets_cles' => 'Jean 3:16, Romains 6:23, Éphésiens 2:8-9',
            'ordre' => 1,
            'duree_minutes' => 10,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Le salut est un don de Dieu. Vrai ou Faux ?',
            'options' => ['Vrai', 'Faux'],
            'bonne_reponse' => 0,
            'explication' => 'Oui ! Le salut est un don gratuit de Dieu. On ne peut pas le mériter par nos œuvres.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Selon Jean 3:16, pourquoi Dieu a-t-Il donné Son Fils ?',
            'options' => [
                'Parce que nous le méritions',
                'Parce qu\'Il nous aime',
                'Pour nous punir',
                'Par obligation'
            ],
            'bonne_reponse' => 1,
            'explication' => 'Dieu nous aime d\'un amour inconditionnel. C\'est par amour qu\'Il a donné Jésus.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Comment reçoit-on le salut ?',
            'options' => [
                'Par nos bonnes œuvres',
                'Par la foi en Jésus-Christ',
                'Par l\'argent',
                'Par le baptême uniquement'
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le salut se reçoit par la foi en Jésus-Christ, c\'est un don gratuit.',
            'points' => 1,
        ]);

        // Leçon 1.2
        $lecon1_2 = Lecon::create([
            'niveau_id' => $niveau1->id,
            'titre' => 'Comment être sauvé ?',
            'contenu' => "Pour être sauvé, il faut :\n\n" .
                "1️⃣ **Reconnaître** que nous sommes pécheurs\n" .
                "« Car tous ont péché et sont privés de la gloire de Dieu » (Romains 3:23)\n\n" .
                "2️⃣ **Croire** en Jésus-Christ\n" .
                "« Crois au Seigneur Jésus, et tu seras sauvé » (Actes 16:31)\n\n" .
                "3️⃣ **Confesser** de sa bouche\n" .
                "« Si tu confesses de ta bouche le Seigneur Jésus, et si tu crois dans ton cœur... tu seras sauvé » (Romains 10:9)\n\n" .
                "🙏 **Prière de salut** : « Seigneur Jésus, je reconnais que je suis pécheur. Je crois que Tu es mort et ressuscité pour moi. Je T'ouvre mon cœur. Sois mon Seigneur et Sauveur. Amen. »",
            'versets_cles' => 'Romains 3:23, Actes 16:31, Romains 10:9',
            'ordre' => 2,
            'duree_minutes' => 12,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'Que faut-il reconnaître pour être sauvé ?',
            'options' => [
                'Que nous sommes parfaits',
                'Que nous sommes pécheurs',
                'Que nous sommes riches',
                'Que nous sommes forts'
            ],
            'bonne_reponse' => 1,
            'explication' => 'Nous devons d\'abord reconnaître que nous sommes pécheurs et avons besoin d\'un Sauveur.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'Selon Romains 10:9, que faut-il confesser de sa bouche ?',
            'options' => [
                'Nos péchés seulement',
                'Que Jésus est Seigneur',
                'Nos bonnes actions',
                'Nos prières'
            ],
            'bonne_reponse' => 1,
            'explication' => 'Nous devons confesser de notre bouche que Jésus est Seigneur.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════
        // NIVEAU 2 : LE BAPTÊME
        // ═══════════════════════════════════════════════
        $niveau2 = Niveau::create([
            'nom' => 'Le Baptême',
            'description' => 'Comprendre et se préparer au baptême',
            'ordre' => 2,
            'icone' => '💧',
            'couleur' => '#0288D1',
            'is_actif' => true,
        ]);

        $lecon2_1 = Lecon::create([
            'niveau_id' => $niveau2->id,
            'titre' => 'Pourquoi se faire baptiser ?',
            'contenu' => "Le **baptême** est un acte d'obéissance à Jésus-Christ.\n\n" .
                "📖 **Verset clé** : Matthieu 28:19\n" .
                "« Allez, faites de toutes les nations des disciples, les baptisant au nom du Père, du Fils et du Saint-Esprit. »\n\n" .
                "💡 **Le baptême symbolise** :\n" .
                "- Notre mort avec Christ (immersion dans l'eau)\n" .
                "- Notre résurrection avec Lui (sortie de l'eau)\n" .
                "- Une nouvelle vie en Christ\n\n" .
                "⚠️ **Important** : Le baptême ne sauve pas, mais il est un acte d'obéissance qui suit le salut.",
            'versets_cles' => 'Matthieu 28:19, Actes 2:38, Romains 6:4',
            'ordre' => 1,
            'duree_minutes' => 10,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Le baptême est un commandement de Jésus. Vrai ou Faux ?',
            'options' => ['Vrai', 'Faux'],
            'bonne_reponse' => 0,
            'explication' => 'Oui, Jésus a commandé à Ses disciples de baptiser les nouveaux croyants.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Que symbolise le baptême par immersion ?',
            'options' => [
                'Notre richesse spirituelle',
                'Notre mort et résurrection avec Christ',
                'Notre intelligence',
                'Notre force physique'
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le baptême symbolise notre mort avec Christ et notre résurrection avec Lui pour une nouvelle vie.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════
        // NIVEAU 3 : LA PRIÈRE
        // ═══════════════════════════════════════════════
        $niveau3 = Niveau::create([
            'nom' => 'La Prière',
            'description' => 'Apprendre à communiquer avec Dieu',
            'ordre' => 3,
            'icone' => '🙏',
            'couleur' => '#7B1FA2',
            'is_actif' => true,
        ]);

        $lecon3_1 = Lecon::create([
            'niveau_id' => $niveau3->id,
            'titre' => 'Comment prier ?',
            'contenu' => "La **prière** est une conversation avec Dieu.\n\n" .
                "📖 **Verset clé** : Matthieu 6:9-13 (Le Notre Père)\n\n" .
                "💡 **Structure de la prière** :\n" .
                "1. **Adoration** : Louer Dieu pour qui Il est\n" .
                "2. **Confession** : Reconnaître nos péchés\n" .
                "3. **Action de grâce** : Remercier Dieu\n" .
                "4. **Supplication** : Présenter nos demandes\n" .
                "5. **Intercession** : Prier pour les autres\n\n" .
                "⏰ **Conseil** : Priez chaque jour, à un moment calme, avec un cœur sincère.",
            'versets_cles' => 'Matthieu 6:9-13, Philippiens 4:6-7, 1 Thessaloniciens 5:17',
            'ordre' => 1,
            'duree_minutes' => 12,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'La prière est une conversation avec Dieu. Vrai ou Faux ?',
            'options' => ['Vrai', 'Faux'],
            'bonne_reponse' => 0,
            'explication' => 'Oui, la prière est une communication personnelle avec Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'Que veut dire "intercession" dans la prière ?',
            'options' => [
                'Prier pour soi-même',
                'Prier pour les autres',
                'Chanter des louanges',
                'Lire la Bible'
            ],
            'bonne_reponse' => 1,
            'explication' => 'L\'intercession consiste à prier pour les autres personnes.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════
        // NIVEAU 4 : LA FOI
        // ═══════════════════════════════════════════════
        $niveau4 = Niveau::create([
            'nom' => 'La Foi',
            'description' => 'Grandir dans la foi et la confiance en Dieu',
            'ordre' => 4,
            'icone' => '🌱',
            'couleur' => '#2E7D32',
            'is_actif' => true,
        ]);

        $lecon4_1 = Lecon::create([
            'niveau_id' => $niveau4->id,
            'titre' => 'Qu\'est-ce que la foi ?',
            'contenu' => "La **foi** est la certitude des choses qu'on espère.\n\n" .
                "📖 **Verset clé** : Hébreux 11:1\n" .
                "« Or la foi est une ferme assurance des choses qu'on espère, une démonstration de celles qu'on ne voit pas. »\n\n" .
                "💡 **La foi se développe par** :\n" .
                "- L'écoute de la Parole de Dieu (Romains 10:17)\n" .
                "- La prière\n" .
                "- L'obéissance à Dieu\n" .
                "- Les épreuves (qui fortifient la foi)\n\n" .
                "🌱 **La foi grandit** avec le temps et l'expérience de Dieu.",
            'versets_cles' => 'Hébreux 11:1, Romains 10:17, Marc 11:22-24',
            'ordre' => 1,
            'duree_minutes' => 10,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Selon Hébreux 11:1, la foi est la certitude des choses...',
            'options' => [
                'qu\'on voit',
                'qu\'on espère',
                'qu\'on touche',
                'qu\'on achète'
            ],
            'bonne_reponse' => 1,
            'explication' => 'La foi est la certitude des choses qu\'on espère et la preuve de celles qu\'on ne voit pas.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Comment la foi se développe-t-elle selon Romains 10:17 ?',
            'options' => [
                'Par la richesse',
                'Par l\'écoute de la Parole de Dieu',
                'Par le jeûne uniquement',
                'Par les bonnes œuvres'
            ],
            'bonne_reponse' => 1,
            'explication' => 'La foi vient de ce qu\'on entend, et ce qu\'on entend vient de la Parole de Dieu.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════
        // NIVEAU 5 : LE SAINT-ESPRIT
        // ═══════════════════════════════════════════════
        $niveau5 = Niveau::create([
            'nom' => 'Le Saint-Esprit',
            'description' => 'Découvrir la puissance du Saint-Esprit',
            'ordre' => 5,
            'icone' => '🔥',
            'couleur' => '#C2185B',
            'is_actif' => true,
        ]);

        $lecon5_1 = Lecon::create([
            'niveau_id' => $niveau5->id,
            'titre' => 'Qui est le Saint-Esprit ?',
            'contenu' => "Le **Saint-Esprit** est la troisième personne de la Trinité.\n\n" .
                "📖 **Verset clé** : Jean 14:26\n" .
                "« Mais le Consolateur, l'Esprit-Saint, que le Père enverra en mon nom, vous enseignera toutes choses. »\n\n" .
                "💡 **Le Saint-Esprit** :\n" .
                "- Nous console\n" .
                "- Nous enseigne\n" .
                "- Nous guide dans la vérité\n" .
                "- Nous donne des dons spirituels\n" .
                "- Produit en nous le fruit de l'Esprit\n\n" .
                "🔥 **Le baptême du Saint-Esprit** est une expérience qui nous remplit de Sa puissance.",
            'versets_cles' => 'Jean 14:26, Actes 2:38, Galates 5:22-23',
            'ordre' => 1,
            'duree_minutes' => 12,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Le Saint-Esprit est la troisième personne de la Trinité. Vrai ou Faux ?',
            'options' => ['Vrai', 'Faux'],
            'bonne_reponse' => 0,
            'explication' => 'Oui, le Saint-Esprit est Dieu, la troisième personne de la Trinité.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Selon Jean 14:26, que fait le Saint-Esprit ?',
            'options' => [
                'Il dort',
                'Il nous enseigne toutes choses',
                'Il nous punit',
                'Il nous ignore'
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le Saint-Esprit nous enseigne toutes choses et nous rappelle les paroles de Jésus.',
            'points' => 1,
        ]);

        $this->command->info('✅ Parcours créé avec succès !');
        $this->command->info('   - 5 niveaux');
        $this->command->info('   - ' . Lecon::count() . ' leçons');
        $this->command->info('   - ' . Question::count() . ' questions');
    }
}