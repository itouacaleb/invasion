<?php

namespace Database\Seeders;

use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use Illuminate\Database\Seeder;

class Niveaux5_6_SpirituelSeeder extends Seeder
{
    public function run(): void
    {
        // ═══════════════════════════════════════════════════════════
        // NIVEAU 5 : LE SAINT-ESPRIT
        // ═══════════════════════════════════════════════════════════
        $niveau5 = Niveau::create([
            'nom' => 'Le Saint-Esprit',
            'description' => 'Découvrir la personne et la puissance du Saint-Esprit',
            'ordre' => 5,
            'icone' => '🔥',
            'couleur' => '#C2185B',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 5.1 — Qui est le Saint-Esprit ?
        // ═══════════════════════════════════════════════════════════
        $lecon5_1 = Lecon::create([
            'niveau_id' => $niveau5->id,
            'titre' => 'Qui est le Saint-Esprit ?',
            'contenu' => "**Le Saint-Esprit n'est pas une force, c'est une Personne.**\n\n" .
                "Beaucoup de chrétiens ont une fausse image du Saint-Esprit. Ils pensent qu'Il est une force impersonnelle, une énergie, ou un sentiment. Mais la Bible nous révèle que le Saint-Esprit est une **Personne divine** : la troisième personne de la Trinité.\n\n" .
                "📖 **Les preuves que le Saint-Esprit est une Personne :**\n\n" .
                "1️⃣ **Il a une intelligence** — Il connaît les pensées de Dieu\n" .
                "📖 **1 Corinthiens 2:10-11** — « Dieu nous les a révélées par l'Esprit. Car l'Esprit sonde tout, même les profondeurs de Dieu. »\n\n" .
                "2️⃣ **Il a une volonté** — Il décide et distribue les dons\n" .
                "📖 **1 Corinthiens 12:11** — « Un seul et même Esprit opère toutes ces choses, les distribuant à chacun en particulier comme Il veut. »\n\n" .
                "3️⃣ **Il a des émotions** — Il peut être attristé\n" .
                "📖 **Éphésiens 4:30** — « N'attristez pas le Saint-Esprit de Dieu, par lequel vous avez été scellés pour le jour de la rédemption. »\n\n" .
                "4️⃣ **Il parle**\n" .
                "📖 **Actes 13:2** — « Pendant qu'ils servaient le Seigneur dans leur ministère et qu'ils jeûnaient, le Saint-Esprit dit : Mettez-moi à part Barnabas et Saul pour l'œuvre à laquelle Je les ai appelés. »\n\n" .
                "5️⃣ **Il enseigne**\n" .
                "📖 **Jean 14:26** — « Mais le Consolateur, l'Esprit-Saint, que le Père enverra en Mon nom, vous enseignera toutes choses, et vous rappellera tout ce que Je vous ai dit. »\n\n" .
                "6️⃣ **Il conduit**\n" .
                "📖 **Romains 8:14** — « Car tous ceux qui sont conduits par l'Esprit de Dieu sont fils de Dieu. »\n\n" .
                "📖 **Les symboles du Saint-Esprit :**\n\n" .
                "• **Le vent** — Il est invisible mais puissant (Jean 3:8)\n" .
                "• **Le feu** — Il purifie et embrase (Actes 2:3)\n" .
                "• **La colombe** — Il est doux et pacifique (Matthieu 3:16)\n" .
                "• **L'eau** — Il désaltère et purifie (Jean 7:37-39)\n" .
                "• **L'huile** — Il oint et consacre (1 Samuel 16:13)\n" .
                "• **Le sceau** — Il marque notre appartenance à Dieu (Éphésiens 1:13)\n\n" .
                "📖 **Le rôle du Saint-Esprit :**\n\n" .
                "• **Il convainc de péché** — Il nous montre nos fautes (Jean 16:8)\n" .
                "• **Il régénère** — Il nous fait naître de nouveau (Tite 3:5)\n" .
                "• **Il habite en nous** — Il fait de notre corps Son temple (1 Corinthiens 6:19)\n" .
                "• **Il enseigne** — Il nous révèle la vérité (Jean 14:26)\n" .
                "• **Il console** — Il est le Consolateur (Jean 14:16)\n" .
                "• **Il fortifie** — Il affermit notre foi (Éphésiens 3:16)\n" .
                "• **Il guide** — Il nous dirige dans la volonté de Dieu (Romains 8:14)\n" .
                "• **Il produit du fruit** — Il transforme notre caractère (Galates 5:22-23)\n" .
                "• **Il donne des dons** — Il équipe pour le service (1 Corinthiens 12)\n\n" .
                "💡 **À retenir** : Le Saint-Esprit est Dieu. Il est une Personne qui veut avoir une relation avec toi. Il t'aime, Il te guide, Il t'enseigne, Il te console.\n\n" .
                "⚠️ **Important** : Ne parle pas du Saint-Esprit comme d'une force. Parle-Lui comme à une Personne. Écoute-Le, honore-Le, obéis-Lui.\n\n" .
                "📖 **2 Corinthiens 13:13** — « Que la grâce du Seigneur Jésus-Christ, l'amour de Dieu, et la communion du Saint-Esprit, soient avec vous tous ! »\n\n" .
                "🙏 **Prière** : « Saint-Esprit, je Te reconnais comme la troisième personne de la Trinité. Je Te remercie d\'habiter en moi. Parle-moi, enseigne-moi, console-moi, guide-moi. Je veux avoir une communion profonde avec Toi. Amen. »",
            'versets_cles' => '1 Corinthiens 2:10-11, Jean 14:26, Romains 8:14, Actes 13:2, 2 Corinthiens 13:13',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Le Saint-Esprit est :',
            'options' => [
                'Une force impersonnelle',
                'Une Personne divine, la troisième de la Trinité',
                'Un ange',
                'Un sentiment',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le Saint-Esprit n\'est pas une force, mais une Personne divine. Il a une intelligence, une volonté, des émotions, Il parle, enseigne et conduit.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Que fait le Saint-Esprit selon Jean 14:26 ?',
            'options' => [
                'Il dort',
                'Il enseigne toutes choses et rappelle les paroles de Jésus',
                'Il nous punit',
                'Il nous ignore',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit que le Saint-Esprit nous enseignera toutes choses et nous rappellera tout ce que Jésus a dit.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Selon Éphésiens 4:30, que pouvons-nous faire au Saint-Esprit ?',
            'options' => [
                'Le rendre triste',
                'Le commander',
                'Le vendre',
                'L\'ignorer',
            ],
            'bonne_reponse' => 0,
            'explication' => 'Le Saint-Esprit a des émotions. Nous pouvons L\'attrister par notre désobéissance, notre péché, ou notre endurcissement.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Qui est conduit par l\'Esprit de Dieu selon Romains 8:14 ?',
            'options' => [
                'Les anges',
                'Les fils de Dieu',
                'Les rois',
                'Les prophètes uniquement',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Tous ceux qui sont conduits par l\'Esprit de Dieu sont fils de Dieu. Le Saint-Esprit nous guide dans la volonté de Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_1->id,
            'question' => 'Quel symbole représente la purification par le Saint-Esprit ?',
            'options' => [
                'La pierre',
                'Le feu',
                'Le sable',
                'Le métal',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le feu est un symbole du Saint-Esprit car Il purifie, embrase, et consume ce qui n\'est pas bon en nous.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 5.2 — Le baptême du Saint-Esprit
        // ═══════════════════════════════════════════════════════════
        $lecon5_2 = Lecon::create([
            'niveau_id' => $niveau5->id,
            'titre' => 'Le baptême du Saint-Esprit',
            'contenu' => "**Le baptême du Saint-Esprit est une expérience de puissance.**\n\n" .
                "Le baptême du Saint-Esprit est une expérience distincte de la nouvelle naissance et du baptême d'eau. C'est une **effusion** de la puissance du Saint-Esprit qui équipe le croyant pour témoigner et servir Dieu.\n\n" .
                "📖 **Les exemples bibliques :**\n\n" .
                "1️⃣ **Le jour de la Pentecôte**\n" .
                "📖 **Actes 2:1-4** — « Le jour de la Pentecôte, ils étaient tous ensemble dans le même lieu. Tout à coup, il vint du ciel un bruit comme celui d'un vent impétueux... Et ils furent tous remplis du Saint-Esprit, et se mirent à parler en d'autres langues, selon que l'Esprit leur donnait de s'exprimer. »\n\n" .
                "2️⃣ **Les Samaritains**\n" .
                "📖 **Actes 8:14-17** — Les Samaritains avaient cru et avaient été baptisés d'eau, mais ils n'avaient pas encore reçu le Saint-Esprit. Pierre et Jean vinrent prier pour eux, et ils reçurent le Saint-Esprit.\n\n" .
                "3️⃣ **Corneille et sa maison**\n" .
                "📖 **Actes 10:44-46** — « Comme Pierre parlait encore, le Saint-Esprit descendit sur tous ceux qui écoutaient la parole... Car ils les entendaient parler en langues et glorifier Dieu. »\n\n" .
                "4️⃣ **Les disciples d'Éphèse**\n" .
                "📖 **Actes 19:1-6** — Paul demanda à des disciples : « Avez-vous reçu le Saint-Esprit quand vous avez cru ? » Ils répondirent : « Nous n'avons pas même entendu dire qu'il y ait un Saint-Esprit. » Après avoir été baptisés au nom de Jésus, Paul leur imposa les mains, et ils reçurent le Saint-Esprit.\n\n" .
                "📖 **Ce que le baptême du Saint-Esprit apporte :**\n\n" .
                "• **Puissance pour témoigner** — Actes 1:8\n" .
                "• **Dons spirituels** — 1 Corinthiens 12:4-11\n" .
                "• **Audace** — Les disciples timides devinrent intrépides\n" .
                "• **Joie** — Une joie profonde du Seigneur\n" .
                "• **Intimité avec Dieu** — Une communion plus profonde\n" .
                "• **Direction** — Une sensibilité à la voix de Dieu\n\n" .
                "📖 **Comment recevoir le baptême du Saint-Esprit ?**\n\n" .
                "1. **Croire** — Croire que c'est pour toi, aujourd'hui\n" .
                "2. **Demander** — Prier et demander à Dieu de te remplir\n" .
                "3. **Se repentir** — Rejeter tout péché\n" .
                "4. **Persévérer** — Continuer à demander jusqu'à le recevoir\n" .
                "5. **Croire par la foi** — Croire que Dieu t'a exaucé même si tu ne ressens rien tout de suite\n\n" .
                "📖 **Luc 11:13** — « Si donc, méchants comme vous êtes, vous savez donner de bonnes choses à vos enfants, à combien plus forte raison le Père céleste donnera-t-Il le Saint-Esprit à ceux qui Le lui demandent. »\n\n" .
                "📖 **Actes 1:8** — « Mais vous recevrez une puissance, le Saint-Esprit survenant sur vous, et vous serez Mes témoins à Jérusalem, dans toute la Judée, dans la Samarie, et jusqu'aux extrémités de la terre. »\n\n" .
                "💡 **À retenir** : Le baptême du Saint-Esprit n'est pas une option, c'est un **don** que Dieu veut donner à chaque croyant. Il te donne la puissance pour vivre une vie chrétienne victorieuse et pour témoigner avec audace.\n\n" .
                "⚠️ **Important** : Le baptême du Saint-Esprit n'est pas un signe de supériorité spirituelle. C'est un don pour servir. Plus tu as de puissance, plus tu es appelé à l'humilité.\n\n" .
                "🙏 **Prière** : « Père céleste, je Te demande de me remplir de Ton Saint-Esprit. Je crois que Tu veux me donner cette puissance. Je reçois par la foi. Remplis-moi, équipe-moi, et fais de moi un témoin puissant de Ton amour. Amen. »",
            'versets_cles' => 'Actes 1:8, Actes 2:1-4, Actes 8:14-17, Luc 11:13, Actes 19:1-6',
            'ordre' => 2,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon5_2->id,
            'question' => 'Selon Actes 1:8, que recevons-nous quand le Saint-Esprit vient sur nous ?',
            'options' => [
                'Des richesses',
                'Une puissance pour témoigner',
                'Une position élevée',
                'Une sagesse humaine',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le Saint-Esprit nous donne la puissance pour être témoins de Jésus partout où nous allons.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_2->id,
            'question' => 'Que s\'est-il passé le jour de la Pentecôte ?',
            'options' => [
                'Les disciples ont été baptisés d\'eau',
                'Les disciples ont été remplis du Saint-Esprit et ont parlé en langues',
                'Les disciples ont jeûné',
                'Les disciples ont été emprisonnés',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le jour de la Pentecôte, les disciples furent remplis du Saint-Esprit et se mirent à parler en d\'autres langues.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_2->id,
            'question' => 'Selon Luc 11:13, à qui Dieu donnera-t-Il le Saint-Esprit ?',
            'options' => [
                'Uniquement aux prophètes',
                'À ceux qui Le Lui demandent',
                'Uniquement aux pasteurs',
                'Uniquement aux apôtres',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus nous assure que le Père céleste donnera le Saint-Esprit à ceux qui Le Lui demandent.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_2->id,
            'question' => 'Le baptême du Saint-Esprit est :',
            'options' => [
                'Un signe de supériorité',
                'Un don pour servir avec puissance',
                'Réservé aux apôtres',
                'Optionnel',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le baptême du Saint-Esprit n\'est pas un signe de supériorité, mais un don pour servir Dieu avec puissance et témoigner avec audace.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_2->id,
            'question' => 'Dans Actes 19:1-6, qu\'ont répondu les disciples d\'Éphèse à Paul ?',
            'options' => [
                'Nous avons reçu le Saint-Esprit',
                'Nous n\'avons pas même entendu dire qu\'il y ait un Saint-Esprit',
                'Nous ne connaissons pas Jésus',
                'Nous sommes des apôtres',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les disciples d\'Éphèse avaient cru mais n\'avaient jamais entendu parler du Saint-Esprit. Paul les baptisa et pria pour eux, et ils reçurent le Saint-Esprit.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 5.3 — Les dons du Saint-Esprit
        // ═══════════════════════════════════════════════════════════
        $lecon5_3 = Lecon::create([
            'niveau_id' => $niveau5->id,
            'titre' => 'Les dons du Saint-Esprit',
            'contenu' => "**Le Saint-Esprit distribue des dons pour édifier l'Église.**\n\n" .
                "Quand nous recevons le Saint-Esprit, Il ne vient pas les mains vides. Il apporte avec Lui des **dons spirituels** (appelés aussi charismes). Ces dons sont donnés pour **édifier l'Église**, pas pour notre gloire personnelle.\n\n" .
                "📖 **1 Corinthiens 12:4-11** — « Il y a diversité de dons, mais le même Esprit ; diversité de ministères, mais le même Seigneur ; diversité d'opérations, mais le même Dieu qui opère tout en tous. Or, à chacun la manifestation de l'Esprit est donnée pour l'utilité commune. En effet, à l'un est donnée par l'Esprit une parole de sagesse ; à un autre, une parole de connaissance, selon le même Esprit ; à un autre, la foi, par le même Esprit ; à un autre, le don des guérisons, par le même Esprit ; à un autre, le don d'opérer des miracles ; à un autre, la prophétie ; à un autre, le discernement des esprits ; à un autre, la diversité des langues ; à un autre, l'interprétation des langues. Un seul et même Esprit opère toutes ces choses, les distribuant à chacun en particulier comme Il veut. »\n\n" .
                "📖 **Les 9 dons du Saint-Esprit (1 Corinthiens 12:8-10) :**\n\n" .
                "1️⃣ **Parole de sagesse** — Révélation de la sagesse divine pour une situation\n" .
                "2️⃣ **Parole de connaissance** — Révélation de faits cachés ou futurs\n" .
                "3️⃣ **Foi** — Une foi extraordinaire pour des situations impossibles\n" .
                "4️⃣ **Guérisons** — Guérir les malades au nom de Jésus\n" .
                "5️⃣ **Miracles** — Opérer des prodiges par la puissance de Dieu\n" .
                "6️⃣ **Prophétie** — Parler de la part de Dieu pour édifier, exhorter, consoler\n" .
                "7️⃣ **Discernement des esprits** — Distinguer entre le vrai et le faux, entre Dieu et Satan\n" .
                "8️⃣ **Diversité des langues** — Parler en d'autres langues par l'Esprit\n" .
                "9️⃣ **Interprétation des langues** — Traduire le message donné en langues\n\n" .
                "📖 **D'autres dons mentionnés ailleurs :**\n\n" .
                "• **Enseignement** (Romains 12:7)\n" .
                "• **Exhortation** (Romains 12:8)\n" .
                "• **Service** (Romains 12:7)\n" .
                "• **Donner** (Romains 12:8)\n" .
                "• **Direction** (Romains 12:8)\n" .
                "• **Miséricorde** (Romains 12:8)\n" .
                "• **Évangélisation** (Éphésiens 4:11)\n" .
                "• **Pasteur** (Éphésiens 4:11)\n\n" .
                "📖 **Les principes des dons spirituels :**\n\n" .
                "1. **Chaque croyant a au moins un don** (1 Pierre 4:10)\n" .
                "2. **Les dons sont pour l'édification de l'Église** (1 Corinthiens 14:12)\n" .
                "3. **Les dons sont donnés par la volonté du Saint-Esprit** (1 Corinthiens 12:11)\n" .
                "4. **Nous devons désirer les dons** (1 Corinthiens 14:1)\n" .
                "5. **L'amour est plus important que les dons** (1 Corinthiens 13)\n\n" .
                "💡 **À retenir** : Les dons spirituels ne sont pas pour nous glorifier, mais pour servir Dieu et édifier les autres. Cherche à découvrir ton don et utilise-le pour la gloire de Dieu.\n\n" .
                "⚠️ **Attention** : Les dons sans l'amour ne valent rien. Paul dit que même si nous avons tous les dons mais sans amour, nous ne sommes rien (1 Corinthiens 13:1-3).\n\n" .
                "🙏 **Prière** : « Saint-Esprit, je Te remercie pour les dons que Tu veux me donner. Aide-moi à découvrir mes dons spirituels et à les utiliser pour édifier l\'Église et glorifier Dieu. Que l\'amour soit au centre de tout. Amen. »",
            'versets_cles' => '1 Corinthiens 12:4-11, 1 Corinthiens 13:1-3, 1 Pierre 4:10, Romains 12:6-8',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon5_3->id,
            'question' => 'Pourquoi les dons spirituels sont-ils donnés selon 1 Corinthiens 12:7 ?',
            'options' => [
                'Pour notre gloire personnelle',
                'Pour l\'utilité commune, édifier l\'Église',
                'Pour devenir riche',
                'Pour nous vanter',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les dons spirituels sont donnés pour l\'utilité commune, c\'est-à-dire pour édifier l\'Église et servir les autres.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_3->id,
            'question' => 'Combien de dons sont mentionnés dans 1 Corinthiens 12:8-10 ?',
            'options' => [
                '3',
                '5',
                '9',
                '12',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Paul mentionne 9 dons spirituels dans 1 Corinthiens 12:8-10 : sagesse, connaissance, foi, guérisons, miracles, prophétie, discernement, langues, interprétation.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_3->id,
            'question' => 'Quel don permet de distinguer entre le vrai et le faux ?',
            'options' => [
                'La prophétie',
                'Le discernement des esprits',
                'Les miracles',
                'Les langues',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le discernement des esprits permet de distinguer entre ce qui vient de Dieu, de Satan, ou de la chair.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_3->id,
            'question' => 'Selon 1 Pierre 4:10, combien de dons chaque croyant a-t-il ?',
            'options' => [
                'Aucun',
                'Au moins un',
                'Tous',
                'Seulement les apôtres en ont',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Chaque croyant a reçu au moins un don spirituel. Nous sommes tous appelés à le mettre au service des autres.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_3->id,
            'question' => 'Qu\'est-ce qui est plus important que les dons selon 1 Corinthiens 13 ?',
            'options' => [
                'La richesse',
                'L\'amour',
                'La sagesse',
                'La prophétie',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit que même si nous avons tous les dons mais sans amour, nous ne sommes rien. L\'amour est le fondement de tout.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 5.4 — Le fruit du Saint-Esprit
        // ═══════════════════════════════════════════════════════════
        $lecon5_4 = Lecon::create([
            'niveau_id' => $niveau5->id,
            'titre' => 'Le fruit du Saint-Esprit',
            'contenu' => "**Le fruit du Saint-Esprit est le caractère de Christ formé en nous.**\n\n" .
                "Les dons du Saint-Esprit sont des capacités qu'Il nous donne. Mais le **fruit** du Saint-Esprit est le **caractère** que le Saint-Esprit produit en nous lorsque nous Lui obéissons. Le fruit n'est pas quelque chose que nous faisons, mais quelque chose que nous **devenons**.\n\n" .
                "📖 **Galates 5:22-23** — « Mais le fruit de l'Esprit, c'est l'amour, la joie, la paix, la patience, la bonté, la bénignité, la fidélité, la douceur, la tempérance ; la loi n'est pas contre ces choses. »\n\n" .
                "📖 **Les 9 aspects du fruit de l'Esprit :**\n\n" .
                "1️⃣ **L'amour** (*agapè*) — L'amour inconditionnel de Dieu, qui aime même les ennemis\n" .
                "📖 **1 Corinthiens 13:4-8** — L'amour est patient, il est plein de bonté ; il n'est point envieux ; il ne se vante point...\n\n" .
                "2️⃣ **La joie** — Une joie profonde et constante, indépendante des circonstances\n" .
                "📖 **Philippiens 4:4** — « Réjouissez-vous toujours dans le Seigneur ; je le répète, réjouissez-vous. »\n\n" .
                "3️⃣ **La paix** — La tranquillité intérieure qui vient de Dieu\n" .
                "📖 **Philippiens 4:7** — « Et la paix de Dieu, qui surpasse toute intelligence, gardera vos cœurs et vos pensées en Jésus-Christ. »\n\n" .
                "4️⃣ **La patience** — La capacité de supporter avec calme\n" .
                "📖 **Jacques 1:3-4** — « L'épreuve de votre foi produit la patience. Mais il faut que la patience accomplisse parfaitement son œuvre. »\n\n" .
                "5️⃣ **La bonté** — La bienveillance active envers les autres\n" .
                "📖 **Éphésiens 4:32** — « Soyez bons les uns envers les autres, compatissants, vous pardonnant réciproquement, comme Dieu vous a pardonné en Christ. »\n\n" .
                "6️⃣ **La bénignité** — La gentillesse, la douceur morale\n" .
                "📖 **Colossiens 3:12** — « Revêtez-vous donc, comme des élus de Dieu, saints et bien-aimés, d'entrailles de miséricorde, de bonté, d'humilité, de douceur et de patience. »\n\n" .
                "7️⃣ **La fidélité** — La loyauté, la constance, la fiabilité\n" .
                "📖 **1 Corinthiens 4:2** — « Du reste, ce qu'on demande des dispensateurs, c'est que chacun soit trouvé fidèle. »\n\n" .
                "8️⃣ **La douceur** — L'humilité, la maîtrise de soi dans les relations\n" .
                "📖 **Matthieu 5:5** — « Heureux les débonnaires, car ils hériteront la terre ! »\n\n" .
                "9️⃣ **La tempérance** — La maîtrise de soi, le self-control\n" .
                "📖 **1 Corinthiens 9:25** — « Tous ceux qui combattent s'abstiennent de tout. Ils le font pour obtenir une couronne corruptible ; mais nous, faisons-le pour une couronne incorruptible. »\n\n" .
                "📖 **Comment le fruit se développe-t-il ?**\n\n" .
                "Le fruit n'apparaît pas instantanément. Il se développe progressivement, quand nous demeurons en Christ.\n\n" .
                "📖 **Jean 15:5** — « Je suis le cep, vous êtes les sarments. Celui qui demeure en Moi et en qui Je demeure porte beaucoup de fruit, car sans Moi vous ne pouvez rien faire. »\n\n" .
                "Pour porter du fruit, il faut :\n" .
                "• **Demeurer en Christ** — Une relation intime quotidienne\n" .
                "• **Obéir au Saint-Esprit** — Suivre Ses directions\n" .
                "• **Être patient** — Le fruit mûrit avec le temps\n" .
                "• **Accepter la taille** — Dieu enlève ce qui empêche le fruit\n\n" .
                "💡 **À retenir** : Les dons sont pour **servir**, le fruit est pour **être**. Dieu se préoccupe plus de ton caractère que de tes capacités. Le fruit du Saint-Esprit est la preuve que tu es vraiment rempli de Lui.\n\n" .
                "⚠️ **Important** : Un chrétien peut avoir des dons mais peu de fruit. Mais Dieu veut que nous portions du fruit pour Sa gloire.\n\n" .
                "📖 **Jean 15:8** — « Si vous portez beaucoup de fruit, c'est ainsi que Mon Père sera glorifié, et que vous serez Mes disciples. »\n\n" .
                "🙏 **Prière** : « Saint-Esprit, produis en moi Ton fruit. Je veux être rempli d\'amour, de joie, de paix, de patience, de bonté, de bénignité, de fidélité, de douceur et de tempérance. Transforme mon caractère pour refléter Christ. Amen. »",
            'versets_cles' => 'Galates 5:22-23, Jean 15:5, Jean 15:8, Philippiens 4:4, Philippiens 4:7',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon5_4->id,
            'question' => 'Combien d\'aspects compte le fruit du Saint-Esprit ?',
            'options' => [
                '3',
                '5',
                '9',
                '12',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Le fruit du Saint-Esprit compte 9 aspects : amour, joie, paix, patience, bonté, bénignité, fidélité, douceur, tempérance.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_4->id,
            'question' => 'Quelle est la différence entre les dons et le fruit du Saint-Esprit ?',
            'options' => [
                'Aucune différence',
                'Les dons sont pour servir, le fruit est pour être (caractère)',
                'Les dons sont plus importants',
                'Le fruit est réservé aux pasteurs',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les dons sont des capacités pour servir, tandis que le fruit est le caractère de Christ formé en nous. Dieu se préoccupe plus de notre caractère.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_4->id,
            'question' => 'Selon Jean 15:5, comment portons-nous beaucoup de fruit ?',
            'options' => [
                'En faisant beaucoup d\'œuvres',
                'En demeurant en Christ',
                'En priant beaucoup',
                'En jeûnant',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Celui qui demeure en Moi et en qui Je demeure porte beaucoup de fruit, car sans Moi vous ne pouvez rien faire. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_4->id,
            'question' => 'Quel aspect du fruit de l\'Esprit est décrit dans 1 Corinthiens 13:4-8 ?',
            'options' => [
                'La joie',
                'L\'amour',
                'La paix',
                'La patience',
            ],
            'bonne_reponse' => 1,
            'explication' => '1 Corinthiens 13:4-8 décrit magnifiquement l\'amour : il est patient, plein de bonté, ne s\'irrite pas, etc.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon5_4->id,
            'question' => 'Selon Jean 15:8, que se passe-t-il si nous portons beaucoup de fruit ?',
            'options' => [
                'Nous devenons célèbres',
                'Le Père est glorifié',
                'Nous devenons riches',
                'Nous sommes exaucés',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Si vous portez beaucoup de fruit, c\'est ainsi que Mon Père sera glorifié, et que vous serez Mes disciples. »',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // NIVEAU 6 : LA VIE CHRÉTIENNE
        // ═══════════════════════════════════════════════════════════
        $niveau6 = Niveau::create([
            'nom' => 'La Vie chrétienne',
            'description' => 'Vivre une vie qui honore Dieu au quotidien',
            'ordre' => 6,
            'icone' => '✝️',
            'couleur' => '#00897B',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 6.1 — L'amour du prochain
        // ═══════════════════════════════════════════════════════════
        $lecon6_1 = Lecon::create([
            'niveau_id' => $niveau6->id,
            'titre' => 'L\'amour du prochain',
            'contenu' => "**Aimer son prochain, c'est le commandement le plus important après l'amour de Dieu.**\n\n" .
                "Quand un pharisien demanda à Jésus quel était le plus grand commandement de la loi, Jésus répondit par deux commandements : aimer Dieu de tout son cœur, et aimer son prochain comme soi-même. Toute la loi et les prophètes dépendent de ces deux commandements.\n\n" .
                "📖 **Matthieu 22:36-40** — « Maître, quel est le plus grand commandement de la loi ? Jésus lui répondit : Tu aimeras le Seigneur, ton Dieu, de tout ton cœur, de toute ton âme, et de toute ta pensée. C'est le premier et le plus grand commandement. Et voici le second, qui lui est semblable : Tu aimeras ton prochain comme toi-même. De ces deux commandements dépendent toute la loi et les prophètes. »\n\n" .
                "📖 **Qui est mon prochain ?**\n\n" .
                "Jésus a répondu à cette question par la **parabole du bon Samaritain** (Luc 10:25-37). Un homme fut attaqué par des brigands et laissé à moitié mort. Un prêtre et un lévite passèrent sans s'arrêter. Mais un Samaritain (considéré comme un ennemi par les Juifs) s'arrêta, pansa ses blessures, le conduisit à une auberge et paya pour lui.\n\n" .
                "📖 **Luc 10:36-37** — « Lequel de ces trois te semble avoir été le prochain de celui qui était tombé au milieu des brigands ? C'est celui qui a exercé la miséricorde envers lui, répondit le docteur de la loi. Et Jésus lui dit : Va, et toi, fais de même. »\n\n" .
                "Le prochain, c'est **toute personne que Dieu place sur notre chemin**, quelle que soit son origine, sa religion, sa couleur de peau, ou son statut social.\n\n" .
                "📖 **Comment aimer son prochain ?**\n\n" .
                "1️⃣ **Avec un amour sincère**\n" .
                "📖 **Romains 12:9-10** — « Que la charité soit sans hypocrisie. Ayez le mal en horreur, attachez-vous fortement au bien. Par amour fraternel, soyez pleins d'affection les uns pour les autres. »\n\n" .
                "2️⃣ **En actes et en vérité**\n" .
                "📖 **1 Jean 3:18** — « Petits enfants, n'aimons pas en paroles et avec la langue, mais en actions et avec vérité. »\n\n" .
                "3️⃣ **En pardonnant**\n" .
                "📖 **Colossiens 3:13** — « Supportez-vous les uns les autres, et, si l'un a sujet de se plaindre de l'autre, pardonnez-vous réciproquement. De même que Christ vous a pardonné, pardonnez-vous aussi. »\n\n" .
                "4️⃣ **En servant**\n" .
                "📖 **Galates 5:13** — « Frères, vous avez été appelés à la liberté, seulement ne faites pas de cette liberté un prétexte de vivre selon la chair ; mais rendez-vous, par amour, serviteurs les uns des autres. »\n\n" .
                "5️⃣ **En portant les fardeaux**\n" .
                "📖 **Galates 6:2** — « Portez les fardeaux les uns des autres, et vous accomplirez ainsi la loi de Christ. »\n\n" .
                "6️⃣ **Même envers nos ennemis**\n" .
                "📖 **Matthieu 5:44** — « Mais moi, Je vous dis : Aimez vos ennemis, bénissez ceux qui vous maudissent, priez pour ceux qui vous maltraitent et qui vous persécutent. »\n\n" .
                "💡 **À retenir** : Aimer son prochain n'est pas un sentiment vague. C'est une **décision** qui se traduit par des **actions concrètes**. C'est voir les besoins des autres et y répondre avec amour.\n\n" .
                "⚠️ **L'amour est la marque du disciple** : Jésus a dit : « À ceci tous connaîtront que vous êtes Mes disciples, si vous avez de l'amour les uns pour les autres. » (Jean 13:35)\n\n" .
                "🙏 **Prière** : « Seigneur, apprends-moi à aimer mon prochain comme Toi Tu m\'aimes. Donne-moi un cœur compatissant, des mains serviables, et un amour sincère qui se traduit en actions. Que ma vie reflète Ton amour à ceux qui m\'entourent. Amen. »",
            'versets_cles' => 'Matthieu 22:36-40, Luc 10:25-37, Romains 12:9-10, 1 Jean 3:18, Jean 13:35',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon6_1->id,
            'question' => 'Quel est le second plus grand commandement selon Jésus ?',
            'options' => [
                'Jeûner régulièrement',
                'Aimer son prochain comme soi-même',
                'Aller à l\'église',
                'Lire la Bible',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Tu aimeras ton prochain comme toi-même. » C\'est le second commandement, semblable au premier.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_1->id,
            'question' => 'Dans la parabole du bon Samaritain, qui s\'est arrêté pour aider l\'homme blessé ?',
            'options' => [
                'Le prêtre',
                'Le lévite',
                'Le Samaritain',
                'Un Romain',
            ],
            'bonne_reponse' => 2,
            'explication' => 'C\'est un Samaritain — considéré comme un ennemi par les Juifs — qui s\'est arrêté, a pansé les blessures, et a payé pour l\'homme blessé.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_1->id,
            'question' => 'Selon 1 Jean 3:18, comment devons-nous aimer ?',
            'options' => [
                'En paroles seulement',
                'En actions et en vérité',
                'En pensée',
                'En secret',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jean nous dit : « N\'aimons pas en paroles et avec la langue, mais en actions et avec vérité. » L\'amour doit être concret.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_1->id,
            'question' => 'À quoi reconnaîtra-t-on que nous sommes disciples de Jésus selon Jean 13:35 ?',
            'options' => [
                'À nos miracles',
                'À notre amour les uns pour les autres',
                'À nos prières',
                'À nos dons',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « À ceci tous connaîtront que vous êtes Mes disciples, si vous avez de l\'amour les uns pour les autres. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_1->id,
            'question' => 'Qui est notre prochain ?',
            'options' => [
                'Uniquement nos voisins',
                'Uniquement les croyants',
                'Toute personne que Dieu place sur notre chemin',
                'Uniquement notre famille',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Le prochain, c\'est toute personne que Dieu place sur notre chemin, quelle que soit son origine, sa religion, ou son statut.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 6.2 — Le pardon
        // ═══════════════════════════════════════════════════════════
        $lecon6_2 = Lecon::create([
            'niveau_id' => $niveau6->id,
            'titre' => 'Le pardon',
            'contenu' => "**Le pardon est au cœur de l'Évangile.**\n\n" .
                "Nous avons été pardonnés d'une dette immense par Dieu. En retour, Il nous appelle à pardonner aux autres. Le pardon n'est pas une option pour le chrétien : c'est un **commandement** et une **marque de notre nouvelle nature**.\n\n" .
                "📖 **Matthieu 6:14-15** — « Si vous pardonnez aux hommes leurs offenses, votre Père céleste vous pardonnera aussi ; mais si vous ne pardonnez pas aux hommes, votre Père ne vous pardonnera pas non plus vos offenses. »\n\n" .
                "📖 **La parabole du serviteur impitoyable (Matthieu 18:21-35) :**\n\n" .
                "Un roi voulut régler ses comptes avec ses serviteurs. Un serviteur lui devait une somme énorme (dix mille talents, environ 20 ans de salaire). Comme il ne pouvait pas payer, le roi ordonna qu'il soit vendu avec sa famille. Le serviteur supplia : « Aie patience envers moi, et je te paierai tout. » Le roi, ému, le laissa aller et **lui remit sa dette**.\n\n" .
                "Mais ce serviteur trouva un compagnon qui lui devait une somme minime (cent deniers, environ 3 mois de salaire). Il le saisit et l'étranglait en disant : « Paie ce que tu me dois ! » Le compagnon supplia, mais il refusa et le fit jeter en prison. Quand le roi l'apprit, il fut indigné : « Méchant serviteur, je t'avais remis toute cette dette, parce que tu m'avais supplié. Ne devais-tu pas aussi avoir pitié de ton compagnon, comme j'ai eu pitié de toi ? »\n\n" .
                "📖 **Matthieu 18:35** — « C'est ainsi que Mon Père céleste vous traitera, si chacun de vous ne pardonne à son frère de tout son cœur. »\n\n" .
                "📖 **Pourquoi devons-nous pardonner ?**\n\n" .
                "1️⃣ **Parce que Dieu nous a pardonnés** — Nous avons été pardonnés d'une dette infinie\n" .
                "📖 **Éphésiens 4:32** — « Soyez bons les uns envers les autres, compatissants, vous pardonnant réciproquement, comme Dieu vous a pardonné en Christ. »\n\n" .
                "2️⃣ **Parce que le pardon libère** — Le manque de pardon nous enferme dans l'amertume\n" .
                "📖 **Hébreux 12:15** — « Veillez à ce que personne ne se prive de la grâce de Dieu ; à ce qu'aucune racine d'amertume ne pousse et ne cause du trouble. »\n\n" .
                "3️⃣ **Parce que le pardon restaure les relations**\n" .
                "Le pardon ouvre la voie à la réconciliation.\n\n" .
                "4️⃣ **Parce que le pardon est un commandement**\n" .
                "Jésus nous commande de pardonner, non pas 7 fois, mais 70 fois 7 fois (Matthieu 18:22), c'est-à-dire sans limite.\n\n" .
                "📖 **Ce que le pardon N'EST PAS :**\n\n" .
                "❌ Ce n'est pas oublier — On peut se souvenir sans souffrir\n" .
                "❌ Ce n'est pas excuser — Pardonner n'excuse pas le mal\n" .
                "❌ Ce n'est pas faire comme si rien ne s'était passé\n" .
                "❌ Ce n'est pas forcément reprendre la relation d'avant\n\n" .
                "📖 **Ce que le pardon EST :**\n\n" .
                "✅ **Une décision** — On choisit de pardonner, même sans le sentir\n" .
                "✅ **Un renoncement** — On renonce à se venger\n" .
                "✅ **Un lâcher-prise** — On remet la personne à Dieu\n" .
                "✅ **Un acte de foi** — On fait confiance à Dieu pour la justice\n\n" .
                "📖 **Comment pardonner ?**\n\n" .
                "1. **Reconnaître la blessure** — Ne pas minimiser la douleur\n" .
                "2. **Décider de pardonner** — Un acte de volonté, pas d'émotion\n" .
                "3. **Prier pour la personne** — Demander à Dieu de la bénir\n" .
                "4. **Renoncer à la vengeance** — Laisser Dieu exercer la justice\n" .
                "5. **Répéter si nécessaire** — Le pardon peut devoir être renouvelé\n\n" .
                "💡 **À retenir** : Le pardon n'est pas facile, mais c'est possible avec la grâce de Dieu. Le pardon libère celui qui pardonne encore plus que celui qui est pardonné.\n\n" .
                "⚠️ **Le pardon n'excuse pas la violence** : Si tu es victime d'abus, mets-toi en sécurité et cherche de l'aide. Le pardon peut coexister avec des limites saines.\n\n" .
                "🙏 **Prière** : « Seigneur, je Te remercie de m\'avoir pardonné une dette immense. Aide-moi à pardonner à ceux qui m\'ont blessé. Je décide de renoncer à l\'amertume et à la vengeance. Bénis ceux qui m\'ont offensé, et libère mon cœur. Amen. »",
            'versets_cles' => 'Matthieu 6:14-15, Matthieu 18:21-35, Éphésiens 4:32, Hébreux 12:15',
            'ordre' => 2,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon6_2->id,
            'question' => 'Selon Matthieu 6:15, que se passe-t-il si nous ne pardonnons pas ?',
            'options' => [
                'Rien',
                'Notre Père céleste ne nous pardonne pas non plus',
                'Nous perdons notre salut',
                'Nous allons en enfer',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus dit : « Si vous ne pardonnez pas aux hommes, votre Père ne vous pardonnera pas non plus vos offenses. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_2->id,
            'question' => 'Dans la parabole du serviteur impitoyable, que devait le premier serviteur au roi ?',
            'options' => [
                'Une petite somme',
                'Une somme énorme (dix mille talents)',
                'Rien',
                'Un cheval',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le premier serviteur devait dix mille talents — une somme énorme équivalant à environ 20 ans de salaire.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_2->id,
            'question' => 'Combien de fois Jésus a-t-Il dit de pardonner ?',
            'options' => [
                '3 fois',
                '7 fois',
                '70 fois 7 fois (sans limite)',
                '100 fois',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jésus a dit à Pierre de pardonner non pas 7 fois, mais 70 fois 7 fois. Cela signifie un pardon sans limite.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_2->id,
            'question' => 'Le pardon signifie :',
            'options' => [
                'Oublier complètement',
                'Excuser le mal',
                'Renoncer à la vengeance et remettre à Dieu',
                'Faire comme si rien ne s\'était passé',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Le pardon est un renoncement à la vengeance, un acte de foi qui remet la personne et la situation entre les mains de Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_2->id,
            'question' => 'Que devons-nous éviter selon Hébreux 12:15 ?',
            'options' => [
                'La joie',
                'La racine d\'amertume',
                'La prière',
                'Le pardon',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Hébreux 12:15 nous avertit qu\'une racine d\'amertume peut pousser et causer du trouble. Nous devons pardonner pour éviter l\'amertume.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 6.3 — Le témoignage
        // ═══════════════════════════════════════════════════════════
        $lecon6_3 = Lecon::create([
            'niveau_id' => $niveau6->id,
            'titre' => 'Le témoignage',
            'contenu' => "**Chaque chrétien est appelé à témoigner de Jésus.**\n\n" .
                "Avant de monter au ciel, Jésus a donné une mission claire à Ses disciples : être Ses **témoins**. Cette mission n'était pas réservée aux apôtres. Elle est pour **chaque chrétien** de tous les temps.\n\n" .
                "📖 **Actes 1:8** — « Mais vous recevrez une puissance, le Saint-Esprit survenant sur vous, et vous serez Mes témoins à Jérusalem, dans toute la Judée, dans la Samarie, et jusqu'aux extrémités de la terre. »\n\n" .
                "📖 **Pourquoi témoigner ?**\n\n" .
                "1️⃣ **Parce que c'est un commandement**\n" .
                "📖 **Matthieu 28:19-20** — « Allez, faites de toutes les nations des disciples, les baptisant au nom du Père, du Fils et du Saint-Esprit, et enseignez-leur à observer tout ce que Je vous ai prescrit. »\n\n" .
                "2️⃣ **Parce que les gens ont besoin de Jésus**\n" .
                "📖 **Romains 10:14** — « Comment donc invoqueront-ils Celui en qui ils n'ont pas cru ? Et comment croiront-ils en Celui dont ils n'ont pas entendu parler ? »\n\n" .
                "3️⃣ **Parce que le temps est court**\n" .
                "Jésus revient bientôt. Nous devons témoigner tant qu'il est encore temps.\n\n" .
                "📖 **Comment témoigner ?**\n\n" .
                "1️⃣ **Par sa vie** — Vivre d'une manière qui honore Dieu\n" .
                "📖 **Matthieu 5:16** — « Que votre lumière luise ainsi devant les hommes, afin qu'ils voient vos bonnes œuvres, et qu'ils glorifient votre Père qui est dans les cieux. »\n\n" .
                "2️⃣ **Par ses paroles** — Parler de ce que Jésus a fait pour nous\n" .
                "📖 **1 Pierre 3:15** — « Soyez toujours prêts à vous défendre, avec douceur et respect, devant quiconque vous demande raison de l'espérance qui est en vous. »\n\n" .
                "3️⃣ **Avec sagesse** — Adapté à chaque personne\n" .
                "📖 **Colossiens 4:5-6** — « Conduisez-vous avec sagesse envers ceux du dehors, et rachetez le temps. Que votre parole soit toujours accompagnée de grâce, assaisonnée de sel, afin que vous sachiez comment il faut répondre à chacun. »\n\n" .
                "4️⃣ **Avec puissance** — Dans la prière et la dépendance du Saint-Esprit\n" .
                "Les disciples ont attendu la puissance du Saint-Esprit avant de témoigner (Actes 1:8).\n\n" .
                "📖 **Les composantes d'un témoignage personnel :**\n\n" .
                "• **Ma vie avant Christ** — Comment j'étais sans Lui\n" .
                "• **Comment j'ai rencontré Christ** — Quand, où, comment je suis devenu chrétien\n" .
                "• **Ma vie après Christ** — Ce que Jésus a changé dans ma vie\n\n" .
                "📖 **Les obstacles au témoignage :**\n\n" .
                "• **La peur du rejet** — 2 Timothée 1:7 : Dieu nous a donné un Esprit de force et d'amour\n" .
                "• **Le manque de connaissance** — On peut témoigner de ce qu'on a vécu, même sans être théologien\n" .
                "• **La honte** — Romains 1:16 : Nous n'avons pas honte de l'Évangile, car il est la puissance de Dieu\n" .
                "• **La paresse** — Nous devons racheter le temps (Éphésiens 5:16)\n\n" .
                "📖 **Comment surmonter ces obstacles ?**\n\n" .
                "1. **Prier** — Demander à Dieu des occasions et de l'audace\n" .
                "2. **Être rempli du Saint-Esprit** — Il nous donnera la puissance et les mots\n" .
                "3. **Préparer son témoignage** — Savoir quoi dire en 2-3 minutes\n" .
                "4. **Commencer petit** — Témoigner à un ami, un collègue, un voisin\n" .
                "5. **Persévérer** — Ne pas se décourager si les gens rejettent\n\n" .
                "💡 **À retenir** : Témoigner, ce n'est pas forcer les gens à croire. C'est simplement **partager** ce que Jésus a fait pour nous, avec amour et respect. C'est Dieu qui convainc, pas nous.\n\n" .
                "⚠️ **Important** : Le témoignage le plus efficace est un **témoignage vécu**. Les gens voient d'abord notre vie avant d'écouter nos paroles.\n\n" .
                "📖 **1 Thessaloniciens 2:8** — « Nous aurions voulu, dans notre vive affection pour vous, non seulement vous donner l'Évangile de Dieu, mais encore notre propre vie, tant vous nous étiez devenus chers. »\n\n" .
                "🙏 **Prière** : « Seigneur, fais de moi un témoin courageux de Ton amour. Donne-moi des occasions de partager l\'Évangile. Remplis-moi de Ton Saint-Esprit, pour que je témoigne avec puissance, amour et sagesse. Que ma vie reflète Christ à ceux qui m\'entourent. Amen. »",
            'versets_cles' => 'Actes 1:8, Matthieu 28:19-20, Matthieu 5:16, 1 Pierre 3:15, Romains 1:16',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon6_3->id,
            'question' => 'À qui Jésus a-t-Il donné la mission de témoigner ?',
            'options' => [
                'Uniquement aux apôtres',
                'Uniquement aux pasteurs',
                'À tous les disciples, à chaque chrétien',
                'Uniquement aux prophètes',
            ],
            'bonne_reponse' => 2,
            'explication' => 'La mission de témoigner est pour TOUS les disciples de Jésus, à chaque chrétien, de tous les temps et de tous les lieux.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_3->id,
            'question' => 'Selon Actes 1:8, qu\'est-ce qui nous rend capables de témoigner ?',
            'options' => [
                'Notre intelligence',
                'La puissance du Saint-Esprit',
                'Notre richesse',
                'Notre position',
            ],
            'bonne_reponse' => 1,
            'explication' => 'C\'est la puissance du Saint-Esprit qui nous rend capables de témoigner avec efficacité.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_3->id,
            'question' => 'Selon Matthieu 5:16, comment devons-nous témoigner ?',
            'options' => [
                'Uniquement par nos paroles',
                'Par nos bonnes œuvres qui glorifient Dieu',
                'En criant',
                'En jugeant les autres',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus dit : « Que votre lumière luise ainsi devant les hommes, afin qu\'ils voient vos bonnes œuvres, et qu\'ils glorifient votre Père qui est dans les cieux. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_3->id,
            'question' => 'Selon 1 Pierre 3:15, comment devons-nous répondre à ceux qui nous interrogent ?',
            'options' => [
                'Avec colère',
                'Avec douceur et respect',
                'En ignorant',
                'En se moquant',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Pierre nous dit : « Soyez toujours prêts à vous défendre, avec douceur et respect, devant quiconque vous demande raison de l\'espérance qui est en vous. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_3->id,
            'question' => 'Pourquoi ne devons-nous pas avoir honte de l\'Évangile selon Romains 1:16 ?',
            'options' => [
                'Parce qu\'il est facile',
                'Parce qu\'il est la puissance de Dieu pour le salut',
                'Parce qu\'il est populaire',
                'Parce qu\'il est obligatoire',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit : « Je n\'ai point honte de l\'Évangile : c\'est une puissance de Dieu pour le salut de quiconque croit. »',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 6.4 — La fidélité à Dieu
        // ═══════════════════════════════════════════════════════════
        $lecon6_4 = Lecon::create([
            'niveau_id' => $niveau6->id,
            'titre' => 'La fidélité à Dieu',
            'contenu' => "**Dieu cherche des hommes et des femmes fidèles.**\n\n" .
                "La vie chrétienne n'est pas un sprint, mais un marathon. Ce qui compte, ce n'est pas comment tu commences, mais comment tu termines. Dieu cherche des disciples **fidèles** jusqu'à la fin.\n\n" .
                "📖 **1 Corinthiens 4:2** — « Du reste, ce qu'on demande des dispensateurs, c'est que chacun soit trouvé fidèle. »\n\n" .
                "📖 **Les 6 domaines de la fidélité :**\n\n" .
                "1️⃣ **Fidélité à Dieu**\n" .
                "C'est notre premier engagement : aimer Dieu par-dessus tout, Lui obéir, Lui faire confiance.\n" .
                "📖 **Matthieu 6:24** — « Nul ne peut servir deux maîtres. Car, ou il haïra l'un, et aimera l'autre ; ou il s'attachera à l'un, et méprisera l'autre. »\n\n" .
                "2️⃣ **Fidélité dans la prière**\n" .
                "📖 **Colossiens 4:2** — « Persévérez dans la prière, veillez-y avec actions de grâces. »\n\n" .
                "3️⃣ **Fidélité dans la Parole**\n" .
                "📖 **Actes 17:11** — Les Béréens examinaient chaque jour les Écritures pour voir si ce qu'on leur annonçait était exact.\n\n" .
                "4️⃣ **Fidélité dans l'église**\n" .
                "📖 **Hébreux 10:24-25** — « N'abandonnons pas notre assemblée, comme c'est la coutume de quelques-uns ; mais exhortons-nous réciproquement. »\n\n" .
                "5️⃣ **Fidélité dans les petites choses**\n" .
                "📖 **Luc 16:10** — « Celui qui est fidèle dans les moindres choses est aussi fidèle dans les grandes choses. »\n\n" .
                "6️⃣ **Fidélité jusqu'à la fin**\n" .
                "📖 **Apocalypse 2:10** — « Sois fidèle jusqu'à la mort, et Je te donnerai la couronne de vie. »\n\n" .
                "📖 **Les obstacles à la fidélité :**\n\n" .
                "• **Les soucis du monde** — Marc 4:19 : Les soucis étouffent la Parole\n" .
                "• **Les richesses** — 1 Timothée 6:10 : L'amour de l'argent est une racine de tous les maux\n" .
                "• **Les plaisirs** — 2 Timothée 3:4 : Amis des plaisirs plutôt qu'amis de Dieu\n" .
                "• **La persécution** — Matthieu 13:21 : Certains trébuchent à cause de la persécution\n" .
                "• **La paresse** — Proverbes 24:30-34 : Le champ du paresseux se remplit d'épines\n\n" .
                "📖 **Comment rester fidèle ?**\n\n" .
                "1. **Garder les yeux sur Jésus** — L'auteur et le consommateur de notre foi (Hébreux 12:2)\n" .
                "2. **S'entourer de frères fidèles** — La communauté nous soutient\n" .
                "3. **Fixer des objectifs spirituels** — Lire la Bible, prier, servir\n" .
                "4. **Persévérer malgré les échecs** — Se relever et continuer\n" .
                "5. **Se rappeler la récompense** — La couronne de vie nous attend\n\n" .
                "📖 **La récompense de la fidélité :**\n\n" .
                "📖 **Matthieu 25:21** — « C'est bien, bon et fidèle serviteur ; tu as été fidèle en peu de choses, je t'établirai sur beaucoup ; entre dans la joie de ton maître. »\n\n" .
                "📖 **2 Timothée 4:7-8** — « J'ai combattu le bon combat, j'ai achevé la course, j'ai gardé la foi. Désormais, la couronne de justice m'est réservée ; le Seigneur, le juste juge, me la donnera dans ce jour-là, et non seulement à moi, mais encore à tous ceux qui auront aimé Son avènement. »\n\n" .
                "💡 **À retenir** : La fidélité n'est pas la perfection. C'est la **persévérance**. C'est se relever après chaque chute, continuer à avancer, garder les yeux fixés sur Jésus.\n\n" .
                "⚠️ **Un encouragement** : Tu peux tomber, mais ne reste pas à terre. Dieu est fidèle, et Il te relèvera. Continue à marcher avec Lui.\n\n" .
                "📖 **Philippiens 1:6** — « Je suis persuadé que Celui qui a commencé en vous cette bonne œuvre la rendra parfaite pour le jour de Jésus-Christ. »\n\n" .
                "🙏 **Prière** : « Seigneur, aide-moi à rester fidèle jusqu\'à la fin. Que je ne me détourne pas de Toi à cause des épreuves, des soucis ou des séductions du monde. Garde mes yeux fixés sur Jésus, et donne-moi la force de persévérer jusqu\'au bout. Amen. »",
            'versets_cles' => '1 Corinthiens 4:2, Luc 16:10, Apocalypse 2:10, Matthieu 25:21, Philippiens 1:6',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon6_4->id,
            'question' => 'Qu\'est-ce que Dieu demande aux dispensateurs selon 1 Corinthiens 4:2 ?',
            'options' => [
                'La perfection',
                'D\'être trouvés fidèles',
                'D\'être riches',
                'D\'être célèbres',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit : « Ce qu\'on demande des dispensateurs, c\'est que chacun soit trouvé fidèle. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_4->id,
            'question' => 'Selon Luc 16:10, si nous sommes fidèles dans les petites choses, que serons-nous ?',
            'options' => [
                'Fidèles aussi dans les grandes choses',
                'Riches',
                'Célèbres',
                'Puissants',
            ],
            'bonne_reponse' => 0,
            'explication' => 'Jésus dit : « Celui qui est fidèle dans les moindres choses est aussi fidèle dans les grandes choses. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_4->id,
            'question' => 'Selon Apocalypse 2:10, jusqu\'à quand devons-nous être fidèles ?',
            'options' => [
                'Jusqu\'à 5 ans',
                'Jusqu\'à la mort',
                'Jusqu\'au mariage',
                'Jusqu\'à la vieillesse',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus dit : « Sois fidèle jusqu\'à la mort, et Je te donnerai la couronne de vie. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_4->id,
            'question' => 'Selon Matthieu 25:21, quelle sera la récompense du serviteur fidèle ?',
            'options' => [
                'Des richesses',
                'Il sera établi sur beaucoup et entrera dans la joie de son maître',
                'Il sera célèbre',
                'Il sera libéré',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le maître dit : « C\'est bien, bon et fidèle serviteur ; tu as été fidèle en peu de choses, je t\'établirai sur beaucoup ; entre dans la joie de ton maître. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon6_4->id,
            'question' => 'Qu\'est-ce que la fidélité selon le cours ?',
            'options' => [
                'La perfection absolue',
                'La persévérance, se relever après chaque chute',
                'Ne jamais pécher',
                'Être riche',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La fidélité n\'est pas la perfection, c\'est la persévérance. C\'est se relever après chaque chute et continuer à avancer avec Dieu.',
            'points' => 1,
        ]);

        $this->command->info('✅ Niveau 5 (Le Saint-Esprit) + Niveau 6 (La Vie chrétienne) créés');
    }
}