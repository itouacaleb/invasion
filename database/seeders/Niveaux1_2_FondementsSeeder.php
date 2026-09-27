<?php

namespace Database\Seeders;

use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use Illuminate\Database\Seeder;

class Niveaux1_2_FondementsSeeder extends Seeder
{
    public function run(): void
    {
        // ═══════════════════════════════════════════════════════════
        // NIVEAU 1 : LE SALUT
        // ═══════════════════════════════════════════════════════════
        $niveau1 = Niveau::create([
            'nom' => 'Le Salut',
            'description' => 'Découvrir le don merveilleux du salut en Jésus-Christ',
            'ordre' => 1,
            'icone' => '❤️',
            'couleur' => '#E65100',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 1.1 — Le plan d'amour de Dieu
        // ═══════════════════════════════════════════════════════════
        $lecon1_1 = Lecon::create([
            'niveau_id' => $niveau1->id,
            'titre' => 'Le plan d\'amour de Dieu',
            'contenu' => "**Dieu t'a créé pour une relation avec Lui.**\n\n" .
                "Depuis le commencement, Dieu a voulu marcher avec l'humanité. Il a créé Adam et Ève pour vivre en communion parfaite avec Lui dans le jardin d'Éden. Mais le péché est entré dans le monde par leur désobéissance, et cette communion a été brisée. Depuis ce jour, l'humanité est séparée de Dieu.\n\n" .
                "📖 **La bonne nouvelle** : Jean 3:16\n" .
                "« Car Dieu a tant aimé le monde qu'Il a donné Son Fils unique, afin que quiconque croit en Lui ne périsse point, mais qu'il ait la vie éternelle. »\n\n" .
                "**Ce verset révèle 4 vérités profondes :**\n\n" .
                "1️⃣ **Dieu t'aime** — D'un amour inconditionnel, sans condition, sans limite. Il t'aime non pas parce que tu es parfait, mais parce que tu es Son enfant.\n\n" .
                "2️⃣ **Il a donné Son Fils** — Le prix était énorme. Dieu n'a pas envoyé un ange, un prophète, mais Son propre Fils unique. Jésus a quitté la gloire du ciel pour venir mourir sur une croix à ta place.\n\n" .
                "3️⃣ **Quiconque croit** — Ce n'est pas réservé aux parfaits, aux religieux, aux riches. C'est pour TOI, personnellement, sans condition.\n\n" .
                "4️⃣ **La vie éternelle** — Pas juste une vie meilleure sur terre, mais la vie éternelle avec Dieu. Une vie qui ne finit jamais, dans la présence de Dieu.\n\n" .
                "💡 **À retenir** :\n" .
                "• Le salut n'est PAS une religion, c'est une RELATION\n" .
                "• Le salut n'est PAS un salaire, c'est un CADEAU\n" .
                "• Le salut n'est PAS mérité, il est REÇU par la foi\n\n" .
                "📖 **Romains 5:8** — « Mais Dieu prouve Son amour envers nous, en ce que, lorsque nous étions encore des pécheurs, Christ est mort pour nous. »\n\n" .
                "📖 **1 Jean 4:9-10** — « L'amour de Dieu a été manifesté envers nous en ce que Dieu a envoyé Son Fils unique dans le monde, afin que nous vivions par Lui. »\n\n" .
                "🙏 **Prière** : « Père céleste, je Te remercie pour Ton amour immense. Je reconnais que Jésus est mort sur la croix pour moi. Je crois en Lui. Aide-moi à comprendre la profondeur de Ton amour. Amen. »",
            'versets_cles' => 'Jean 3:16, Romains 5:8, 1 Jean 4:9-10',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Pourquoi Dieu a-t-Il envoyé Son Fils unique dans le monde ?',
            'options' => [
                'Parce que nous étions parfaits',
                'Parce qu\'Il nous aime',
                'Parce que nous l\'avions mérité',
                'Par obligation',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Dieu nous aime d\'un amour inconditionnel. C\'est Son amour qui L\'a poussé à donner Jésus pour nous sauver.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Le salut est un don gratuit de Dieu. Vrai ou Faux ?',
            'options' => ['Vrai', 'Faux'],
            'bonne_reponse' => 0,
            'explication' => 'Le salut ne s\'achète pas et ne se mérite pas. C\'est un cadeau gratuit que Dieu offre à tous ceux qui croient.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Selon Jean 3:16, comment recevons-nous la vie éternelle ?',
            'options' => [
                'En faisant beaucoup de bonnes œuvres',
                'En allant à l\'église tous les dimanches',
                'En croyant en Jésus-Christ',
                'En donnant de l\'argent',
            ],
            'bonne_reponse' => 2,
            'explication' => 'La vie éternelle est offerte à quiconque croit en Jésus-Christ. C\'est la foi qui nous sauve, pas nos œuvres.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Selon Romains 5:8, quand Christ est-Il mort pour nous ?',
            'options' => [
                'Quand nous étions déjà sauvés',
                'Quand nous étions de bons chrétiens',
                'Quand nous étions encore pécheurs',
                'Quand nous le méritions',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Christ est mort pour nous quand nous étions ENCORE pécheurs. C\'est la preuve de Son amour inconditionnel.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_1->id,
            'question' => 'Le salut est :',
            'options' => [
                'Une religion à suivre',
                'Une relation avec Dieu',
                'Un salaire à mériter',
                'Une récompense pour les bons',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le salut n\'est pas une religion, mais une relation personnelle avec Dieu par Jésus-Christ.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 1.2 — La repentance et la foi
        // ═══════════════════════════════════════════════════════════
        $lecon1_2 = Lecon::create([
            'niveau_id' => $niveau1->id,
            'titre' => 'La repentance et la foi',
            'contenu' => "**Pour recevoir le salut, il faut deux choses : la repentance et la foi.**\n\n" .
                "Beaucoup pensent qu'il suffit de croire en Dieu. Mais la Bible nous montre que le salut véritable implique un changement profond du cœur. Jésus Lui-même a commencé Son ministère par ces mots : « Le temps est accompli, et le royaume de Dieu est proche. Repentez-vous, et croyez à la bonne nouvelle. » (Marc 1:15)\n\n" .
                "📖 **Les deux clés du salut :**\n\n" .
                "1️⃣ **La repentance** (en grec *metanoia* = changement de mentalité)\n\n" .
                "Se repentir, ce n'est pas seulement regretter ses péchés. C'est un **changement radical de direction** :\n" .
                "• **Reconnaître** — Je reconnais que je suis pécheur et que j'ai besoin d'un Sauveur\n" .
                "• **Se détourner** — Je décide de tourner le dos à mes péchés\n" .
                "• **Se retourner vers Dieu** — Je choisis de suivre Dieu désormais\n\n" .
                "📖 **Actes 3:19** — « Repentez-vous donc et convertissez-vous, pour que vos péchés soient effacés. »\n\n" .
                "2️⃣ **La foi en Jésus-Christ**\n\n" .
                "La foi, ce n'est pas juste croire que Dieu existe. C'est **placer toute sa confiance en Jésus** comme Seigneur et Sauveur.\n\n" .
                "📖 **Romains 10:9-10** — « Si tu confesses de ta bouche le Seigneur Jésus, et si tu crois dans ton cœur que Dieu L'a ressuscité des morts, tu seras sauvé. Car c'est en croyant du cœur qu'on parvient à la justice, et c'est en confessant de la bouche qu'on parvient au salut. »\n\n" .
                "**Ce que la foi implique :**\n" .
                "• Croire **dans le cœur** — Une conviction profonde, pas juste intellectuelle\n" .
                "• Confesser **de la bouche** — L'annoncer publiquement\n" .
                "• Placer sa **confiance totale** en Jésus — Pas en soi-même, pas en ses œuvres\n\n" .
                "💡 **À retenir** : La repentance me fait tourner LE DOS au péché. La foi me fait tourner LE VISAGE vers Jésus. Les deux vont ensemble.\n\n" .
                "📖 **Éphésiens 2:8-9** — « C'est par la grâce que vous êtes sauvés, par le moyen de la foi. Et cela ne vient pas de vous, c'est le don de Dieu. Ce n'est point par les œuvres, afin que personne ne se glorifie. »\n\n" .
                "🙏 **Prière de repentance et de foi** : « Seigneur Jésus, je reconnais que je suis pécheur. Je me repens sincèrement. Je crois que Tu es mort et ressuscité pour moi. Je Te reçois comme mon Seigneur et Sauveur. Change mon cœur. Amen. »",
            'versets_cles' => 'Marc 1:15, Actes 3:19, Romains 10:9-10, Éphésiens 2:8-9',
            'ordre' => 2,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'Que signifie le mot "repentance" ?',
            'options' => [
                'Pleurer ses péchés',
                'Un changement de mentalité et de direction',
                'Faire pénitence',
                'Se punir soi-même',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le mot grec "metanoia" signifie un changement profond de mentalité qui conduit à un changement de direction dans la vie.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'Selon Romains 10:9, que faut-il confesser de sa bouche ?',
            'options' => [
                'Nos péchés uniquement',
                'Que Jésus est Seigneur',
                'Nos bonnes actions',
                'Nos prières quotidiennes',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Nous devons confesser de notre bouche que Jésus est Seigneur, et croire dans notre cœur que Dieu L\'a ressuscité.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'La repentance implique trois choses. Laquelle n\'en fait PAS partie ?',
            'options' => [
                'Reconnaître ses péchés',
                'Se détourner de ses péchés',
                'Se retourner vers Dieu',
                'Faire des sacrifices pour payer ses péchés',
            ],
            'bonne_reponse' => 3,
            'explication' => 'La repentance n\'implique AUCUN paiement. Jésus a déjà tout payé sur la croix. Nous recevons gratuitement.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'Selon Éphésiens 2:8-9, comment sommes-nous sauvés ?',
            'options' => [
                'Par nos bonnes œuvres',
                'Par la grâce, par le moyen de la foi',
                'Par le baptême',
                'Par la prière',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le salut est un don de Dieu, reçu par la grâce au moyen de la foi. Ce n\'est pas par nos œuvres.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_2->id,
            'question' => 'La foi véritable en Jésus implique :',
            'options' => [
                'Juste croire que Dieu existe',
                'Croire dans le cœur + confesser de la bouche + placer sa confiance en Lui',
                'Aller à l\'église',
                'Lire la Bible',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La foi véritable implique une conviction profonde du cœur, une confession publique, et une confiance totale placée en Jésus.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 1.3 — La nouvelle naissance
        // ═══════════════════════════════════════════════════════════
        $lecon1_3 = Lecon::create([
            'niveau_id' => $niveau1->id,
            'titre' => 'La nouvelle naissance',
            'contenu' => "**Quand tu reçois Jésus, tu deviens une nouvelle créature.**\n\n" .
                "Un soir, un chef religieux nommé Nicodème vint voir Jésus de nuit. Il était respecté, instruit, pieux. Pourtant Jésus lui dit une chose surprenante : « Si un homme ne naît de nouveau, il ne peut voir le royaume de Dieu. » (Jean 3:3)\n\n" .
                "Nicodème ne comprit pas. Comment un homme adulte peut-il naître de nouveau ? Jésus expliqua qu'il ne s'agit pas d'une naissance physique, mais d'une **naissance spirituelle** : « Ce qui est né de la chair est chair, et ce qui est né de l'Esprit est esprit. » (Jean 3:6)\n\n" .
                "📖 **Ce que signifie \"naître de nouveau\" :**\n\n" .
                "1️⃣ **Un changement de nature** — Avant, tu avais une nature pécheresse (héritée d'Adam). Maintenant, tu reçois la nature de Dieu. Tu deviens un enfant de Dieu.\n\n" .
                "📖 **Jean 1:12** — « Mais à tous ceux qui L'ont reçue, à ceux qui croient en Son nom, Elle a donné le pouvoir de devenir enfants de Dieu. »\n\n" .
                "2️⃣ **Un changement d'identité** — Tu n'es plus ce que tu étais. Ton passé est effacé. Tu es pardonné, justifié, accepté par Dieu.\n\n" .
                "📖 **2 Corinthiens 5:17** — « Si quelqu'un est en Christ, il est une nouvelle créature. Les choses anciennes sont passées ; voici, toutes choses sont devenues nouvelles. »\n\n" .
                "3️⃣ **Un changement de cœur** — Dieu ne fait pas juste un nettoyage extérieur. Il transforme ton cœur de l'intérieur.\n\n" .
                "📖 **Ézéchiel 36:26** — « Je vous donnerai un cœur nouveau, et Je mettrai en vous un esprit nouveau ; J'ôterai de votre corps le cœur de pierre, et Je vous donnerai un cœur de chair. »\n\n" .
                "💡 **À retenir** : La nouvelle naissance, c'est l'œuvre du Saint-Esprit qui vient habiter dans ton cœur et te transforme de l'intérieur.\n\n" .
                "⚠️ **Important**** : Cette nouvelle naissance ne vient pas de toi. C'est un miracle de Dieu. Tu ne peux pas te \"reprogrammer\" toi-même pour devenir meilleur. C'est Dieu qui te transforme par Son Esprit.\n\n" .
                "📖 **Tite 3:5** — « Il nous a sauvés, non à cause des œuvres de justice que nous aurions faites, mais selon Sa miséricorde, par le baptême de la régénération et le renouvellement du Saint-Esprit. »\n\n" .
                "🙏 **Prière** : « Seigneur, je Te remercie pour cette nouvelle naissance. Je ne suis plus ce que j'étais. Je suis une nouvelle créature en Christ. Transforme-moi chaque jour davantage. Amen. »",
            'versets_cles' => 'Jean 3:3-8, Jean 1:12, 2 Corinthiens 5:17, Ézéchiel 36:26',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon1_3->id,
            'question' => 'Qu\'a dit Jésus à Nicodème qu\'il devait faire pour voir le royaume de Dieu ?',
            'options' => [
                'Respecter les 10 commandements',
                'Naître de nouveau',
                'Donner tous ses biens',
                'Jeûner 40 jours',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : "Si un homme ne naît de nouveau, il ne peut voir le royaume de Dieu." (Jean 3:3)',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_3->id,
            'question' => 'La "nouvelle naissance" est :',
            'options' => [
                'Une naissance physique',
                'Une naissance spirituelle par le Saint-Esprit',
                'Un baptême dans l\'eau',
                'Une décision intellectuelle',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La nouvelle naissance est spirituelle : c\'est l\'œuvre du Saint-Esprit qui vient habiter en nous et nous transforme.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_3->id,
            'question' => 'Selon 2 Corinthiens 5:17, celui qui est en Christ est :',
            'options' => [
                'Un meilleur pécheur',
                'Une nouvelle créature',
                'Un religieux',
                'Un sage',
            ],
            'bonne_reponse' => 1,
            'explication' => 'En Christ, nous sommes une nouvelle créature. Les choses anciennes sont passées, tout est devenu nouveau.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_3->id,
            'question' => 'Que fait Dieu selon Ézéchiel 36:26 ?',
            'options' => [
                'Il nous donne des richesses',
                'Il ôte notre cœur de pierre et donne un cœur de chair',
                'Il nous donne une longue vie',
                'Il nous rend célèbres',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Dieu Lui-même transforme notre cœur : Il enlève le cœur de pierre (dur, insensible) et donne un cœur de chair (vivant, sensible à Sa voix).',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_3->id,
            'question' => 'Qui produit la nouvelle naissance ?',
            'options' => [
                'Notre propre effort',
                'Le pasteur',
                'Le Saint-Esprit',
                'Les bonnes œuvres',
            ],
            'bonne_reponse' => 2,
            'explication' => 'La nouvelle naissance est un miracle du Saint-Esprit. Ce n\'est pas nous qui nous transformons, c\'est Dieu qui agit en nous.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 1.4 — L'assurance du salut
        // ═══════════════════════════════════════════════════════════
        $lecon1_4 = Lecon::create([
            'niveau_id' => $niveau1->id,
            'titre' => 'L\'assurance du salut',
            'contenu' => "**Comment savoir si je suis vraiment sauvé ?**\n\n" .
                "Beaucoup de chrétiens vivent dans le doute : \"Est-ce que je suis vraiment sauvé ? Et si je fais un péché, est-ce que je perds mon salut ?\" Ces questions viennent du diable qui veut nous voler notre paix.\n\n" .
                "La Bible est claire : **ton salut ne dépend pas de tes performances, mais de l'œuvre parfaite de Jésus-Christ.**\n\n" .
                "📖 **Les 5 assurances du salut :**\n\n" .
                "1️⃣ **La Parole de Dieu** — Dieu a promis, et Dieu ne ment pas.\n" .
                "📖 **1 Jean 5:11-13** — « Et voici ce témoignage, c'est que Dieu nous a donné la vie éternelle, et que cette vie est dans Son Fils. Celui qui a le Fils a la vie ; celui qui n'a pas le Fils de Dieu n'a pas la vie. Je vous ai écrit ces choses... afin que vous sachiez que vous avez la vie éternelle, vous qui croyez au nom du Fils de Dieu. »\n\n" .
                "Le \"sachiez\" est une certitude, pas un espoir vague. Si tu as cru en Jésus, tu PEUX SAVOIR que tu as la vie éternelle.\n\n" .
                "2️⃣ **Le témoignage intérieur du Saint-Esprit**\n" .
                "📖 **Romains 8:16** — « L'Esprit Lui-même rend témoignage à notre esprit que nous sommes enfants de Dieu. »\n\n" .
                "Quand tu pries et dis \"Papa\" à Dieu, c'est le Saint-Esprit qui te donne cette intimité.\n\n" .
                "3️⃣ **La transformation de la vie**\n" .
                "Si tu es vraiment né de nouveau, ta vie change progressivement. Tu ne peux pas continuer à pécher comme avant sans être dérangé intérieurement.\n\n" .
                "📖 **1 Jean 3:9** — « Quiconque est né de Dieu ne pratique pas le péché, parce que la semence de Dieu demeure en lui. »\n\n" .
                "⚠️ Attention : ça ne veut pas dire que tu ne pécheras plus jamais. Ça veut dire que tu ne pourras plus vivre confortablement dans le péché.\n\n" .
                "4️⃣ **La correction de Dieu**\n" .
                "Si tu appartiens à Dieu, Il te corrige quand tu fais le mal, comme un père corrige son enfant.\n\n" .
                "📖 **Hébreux 12:6** — « Car le Seigneur châtie celui qu'Il aime, et Il frappe de la verge tous ceux qu'Il reconnaît pour Ses fils. »\n\n" .
                "Si tu peux pécher sans être dérangé, c'est peut-être que tu n'es pas vraiment né de nouveau.\n\n" .
                "5️⃣ **L'amour pour les frères**\n" .
                "📖 **1 Jean 3:14** — « Nous savons que nous sommes passés de la mort à la vie, parce que nous aimons les frères. »\n\n" .
                "Un vrai chrétien aime ses frères et sœurs en Christ.\n\n" .
                "💡 **À retenir** : L'assurance ne vient PAS de tes sentiments, mais de la Parole de Dieu. Même si tu ne \"sens\" pas Dieu, Sa promesse reste vraie.\n\n" .
                "⚠️ **Le péché et le salut** : Quand tu péches, tu ne perds PAS ton salut, mais tu perds ta communion avec Dieu. Il faut confesser ton péché et revenir à Lui.\n\n" .
                "📖 **1 Jean 1:9** — « Si nous confessons nos péchés, Il est fidèle et juste pour nous les pardonner, et pour nous purifier de toute iniquité. »\n\n" .
                "🙏 **Prière** : « Père, je Te remercie car je ne suis plus condamné. Jésus a tout payé pour moi. Aide-moi à vivre dans cette assurance, à marcher dans la paix, et à ne plus douter de Ton amour. Amen. »",
            'versets_cles' => '1 Jean 5:11-13, Romains 8:16, 1 Jean 3:9, Hébreux 12:6, 1 Jean 1:9',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon1_4->id,
            'question' => 'Selon 1 Jean 5:13, pourquoi Jean a-t-il écrit ces choses ?',
            'options' => [
                'Pour nous faire douter',
                'Pour que nous sachions que nous avons la vie éternelle',
                'Pour nous rappeler nos péchés',
                'Pour nous donner des règles',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jean a écrit ces choses pour que nous SACHIONS (pas espérions) que nous avons la vie éternelle en Christ.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_4->id,
            'question' => 'Qu\'est-ce qui nous assure que nous sommes enfants de Dieu selon Romains 8:16 ?',
            'options' => [
                'Nos sentiments',
                'Le témoignage du Saint-Esprit dans notre esprit',
                'Nos œuvres',
                'Notre baptême',
            ],
            'bonne_reponse' => 1,
            'explication' => 'C\'est le Saint-Esprit Lui-même qui rend témoignage à notre esprit que nous sommes enfants de Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_4->id,
            'question' => 'Quand un vrai chrétien pèche, que perd-il ?',
            'options' => [
                'Son salut',
                'Sa communion avec Dieu',
                'Son baptême',
                'Son nom dans le livre de vie',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le péché ne fait pas perdre le salut, mais il brise la communion avec Dieu. Il faut confesser et revenir à Lui.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_4->id,
            'question' => 'Sur quoi repose l\'assurance du salut ?',
            'options' => [
                'Nos sentiments',
                'Nos performances spirituelles',
                'La Parole de Dieu et la promesse en Christ',
                'Notre fidélité',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Notre assurance ne vient pas de nos sentiments (qui changent) ni de nos performances (imparfaites), mais de la Parole de Dieu qui est fiable.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon1_4->id,
            'question' => 'Que devons-nous faire quand nous péchons ?',
            'options' => [
                'Nous punir nous-mêmes',
                'Confesser notre péché à Dieu',
                'Arrêter d\'aller à l\'église',
                'Jeûner 7 jours',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Si nous confessons nos péchés, Dieu est fidèle et juste pour nous pardonner (1 Jean 1:9).',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // NIVEAU 2 : LE BAPTÊME
        // ═══════════════════════════════════════════════════════════
        $niveau2 = Niveau::create([
            'nom' => 'Le Baptême',
            'description' => 'Comprendre le baptême et se préparer à y entrer',
            'ordre' => 2,
            'icone' => '💧',
            'couleur' => '#0288D1',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 2.1 — Pourquoi le baptême ?
        // ═══════════════════════════════════════════════════════════
        $lecon2_1 = Lecon::create([
            'niveau_id' => $niveau2->id,
            'titre' => 'Pourquoi le baptême ?',
            'contenu' => "**Le baptême est un commandement direct de Jésus.**\n\n" .
                "Avant de monter au ciel, Jésus a donné une mission claire à Ses disciples : « Allez, faites de toutes les nations des disciples, les baptisant au nom du Père, du Fils et du Saint-Esprit. » (Matthieu 28:19)\n\n" .
                "Ce n'est pas une option, ni une tradition humaine. C'est un **commandement** de notre Seigneur. Chaque personne qui a cru en Jésus doit se faire baptiser.\n\n" .
                "📖 **Ce que le baptême EST :**\n\n" .
                "1️⃣ **Un acte d'obéissance** — Je me fais baptiser parce que Jésus l'a commandé.\n\n" .
                "2️⃣ **Un témoignage public** — Je déclare devant tous que j'appartiens à Christ.\n\n" .
                "📖 **Actes 2:41** — « Ceux qui acceptèrent sa parole furent baptisés ; et, en ce jour-là, le nombre des disciples augmenta d'environ trois mille âmes. »\n\n" .
                "3️⃣ **Un engagement** — Je m'engage publiquement à suivre Christ pour toute ma vie.\n\n" .
                "📖 **Ce que le baptême N'EST PAS :**\n\n" .
                "❌ Ce n'est **pas** ce qui sauve. On est sauvé par la foi en Jésus, pas par le baptême.\n\n" .
                "📖 **Éphésiens 2:8-9** — « C'est par la grâce que vous êtes sauvés, par le moyen de la foi... Ce n'est point par les œuvres. »\n\n" .
                "❌ Ce n'est **pas** un rituel magique qui efface automatiquement les péchés.\n\n" .
                "❌ Ce n'est **pas** une tradition familiale ou culturelle à suivre par habitude.\n\n" .
                "📖 **L'exemple de Jésus** :\n\n" .
                "Jésus Lui-même s'est fait baptiser par Jean-Baptiste dans le Jourdain. Il n'avait pourtant aucun péché ! Il l'a fait pour nous donner l'exemple.\n\n" .
                "📖 **Matthieu 3:13-17** — Jésus vint de la Galilée au Jourdain vers Jean, pour être baptisé par lui. Jean s'y opposait en disant : « C'est moi qui ai besoin d'être baptisé par toi, et tu viens à moi ! » Mais Jésus lui répondit : « Laisse faire maintenant, car il est convenable que nous accomplissions ainsi tout ce qui est juste. »\n\n" .
                "💡 **À retenir** : Le baptême est la première grande étape d'obéissance après le salut. C'est ton premier \"OUI\" public à Christ.\n\n" .
                "⚠️ **Important** : Le baptême doit venir APRÈS la foi et la repentance. On ne baptise pas quelqu'un qui ne croit pas encore.\n\n" .
                "📖 **Actes 2:38** — « Repentez-vous, et que chacun de vous soit baptisé au nom de Jésus-Christ, pour le pardon de vos péchés ; et vous recevrez le don du Saint-Esprit. »\n\n" .
                "🙏 **Prière** : « Seigneur, je veux obéir à Ton commandement. Je me prépare à me faire baptiser pour Te suivre publiquement. Aide-moi à bien comprendre la signification de ce pas. Amen. »",
            'versets_cles' => 'Matthieu 28:19, Actes 2:38, Actes 2:41, Éphésiens 2:8-9, Matthieu 3:13-17',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Qui a commandé le baptême ?',
            'options' => [
                'Les apôtres',
                'Jean-Baptiste',
                'Jésus Lui-même',
                'L\'église primitive',
            ],
            'bonne_reponse' => 2,
            'explication' => 'C\'est Jésus Lui-même qui a commandé le baptême dans Matthieu 28:19 : "les baptisant au nom du Père, du Fils et du Saint-Esprit."',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Le baptême sauve-t-il ?',
            'options' => [
                'Oui, il efface les péchés',
                'Non, on est sauvé par la foi en Jésus',
                'Oui, c\'est obligatoire pour le salut',
                'Oui, si on est adulte',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le salut vient par la foi en Jésus-Christ, pas par le baptême. Le baptême est un acte d\'obéissance qui SUIT le salut.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Que fait le baptême selon Actes 2:41 ?',
            'options' => [
                'Il rend célèbre',
                'Il fait partie du processus de conversion et de discipulat',
                'Il donne des dons spirituels',
                'Il guérit les maladies',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Après avoir accepté la parole de Pierre, les croyants furent baptisés. Le baptême fait partie de la vie du disciple.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Jésus s\'est-il fait baptiser ?',
            'options' => [
                'Non, Il n\'en avait pas besoin',
                'Oui, par Jean-Baptiste dans le Jourdain',
                'Oui, par Ses disciples',
                'Non, Il a seulement été circoncis',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus s\'est fait baptiser par Jean-Baptiste pour nous donner l\'exemple, même s\'Il n\'avait aucun péché.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_1->id,
            'question' => 'Le baptême vient :',
            'options' => [
                'Avant la foi',
                'Au moment de la foi',
                'Après la foi et la repentance',
                'Peu importe l\'ordre',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Le baptême vient après la foi et la repentance. On ne baptise pas quelqu\'un qui ne croit pas encore en Jésus.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 2.2 — Le baptême par immersion
        // ═══════════════════════════════════════════════════════════
        $lecon2_2 = Lecon::create([
            'niveau_id' => $niveau2->id,
            'titre' => 'Le baptême par immersion',
            'contenu' => "**Le baptême biblique se fait par immersion complète dans l'eau.**\n\n" .
                "Le mot grec utilisé dans le Nouveau Testament pour \"baptiser\" est **baptizô**, qui signifie littéralement \"plonger, immerger\". Ce n'est pas une aspersion (projeter de l'eau) ni une effusion (verser un peu d'eau sur la tête), mais une immersion complète.\n\n" .
                "📖 **Les preuves bibliques de l'immersion :**\n\n" .
                "1️⃣ **L'exemple de Jésus**\n" .
                "📖 **Marc 1:9-10** — « Jésus vint... et il fut baptisé par Jean dans le Jourdain. Et aussitôt, en remontant de l'eau, il vit les cieux s'ouvrir. »\n\n" .
                "Notez : Jésus est entré dans l'eau (descendu) et en est ressorti (remonté). Cela indique une immersion.\n\n" .
                "2️⃣ **L'exemple de l'eunuque éthiopien**\n" .
                "📖 **Actes 8:38-39** — « Il ordonna d'arrêter le char ; Philippe et l'eunuque descendirent tous deux dans l'eau, et Philippe baptisa l'eunuque. Quand ils furent sortis de l'eau... »\n\n" .
                "Ils sont descendus dans l'eau. On ne descend pas dans l'eau pour recevoir une simple aspersion.\n\n" .
                "3️⃣ **Le symbolisme du baptême**\n" .
                "L'immersion symbolise :\n" .
                "• **L'ensevelissement** — On est plongé dans l'eau comme dans un tombeau\n" .
                "• **La mort avec Christ** — On meurt à l'ancienne vie\n" .
                "• **La résurrection** — On sort de l'eau comme Christ est sorti du tombeau\n" .
                "• **La nouvelle vie** — On commence une vie nouvelle en Christ\n\n" .
                "📖 **Romains 6:3-4** — « Ignorez-vous que nous tous qui avons été baptisés en Jésus-Christ, c'est en Sa mort que nous avons été baptisés ? Nous avons donc été ensevelis avec Lui par le baptême en Sa mort, afin que, comme Christ est ressuscité des morts par la gloire du Père, de même nous aussi nous marchions en nouveauté de vie. »\n\n" .
                "💡 **À retenir** : L'immersion est le mode biblique du baptême. Elle symbolise de manière vivante la mort, l'ensevelissement et la résurrection avec Christ.\n\n" .
                "⚠️ **Ce que ça implique pour toi** :\n" .
                "Quand tu seras baptisé par immersion, tu vivras un moment très fort. Tu descendras dans l'eau en déclarant : \"Mon ancienne vie est morte.\" Tu sortiras en déclarant : \"Je marche maintenant en nouveauté de vie.\"\n\n" .
                "📖 **Colossiens 2:12** — « Ayant été ensevelis avec Lui par le baptême, vous êtes aussi ressuscités en Lui et avec Lui, par la foi en la puissance de Dieu qui L'a ressuscité des morts. »\n\n" .
                "🙏 **Prière** : « Seigneur, je comprends maintenant la signification profonde du baptême. Je veux mourir à mon ancienne vie et marcher en nouveauté de vie avec Toi. Prépare mon cœur pour ce grand jour. Amen. »",
            'versets_cles' => 'Marc 1:9-10, Actes 8:38-39, Romains 6:3-4, Colossiens 2:12',
            'ordre' => 2,
            'duree_minutes' => 12,
        ]);

        Question::create([
            'lecon_id' => $lecon2_2->id,
            'question' => 'Que signifie le mot grec "baptizô" ?',
            'options' => [
                'Verser de l\'eau',
                'Asperger',
                'Plonger, immerger',
                'Oindre',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Le mot grec "baptizô" signifie littéralement "plonger, immerger". C\'est pourquoi le baptême biblique se fait par immersion complète.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_2->id,
            'question' => 'Comment Jésus a-t-Il été baptisé selon Marc 1:9-10 ?',
            'options' => [
                'Par aspersion',
                'Par immersion dans le Jourdain',
                'Par effusion d\'huile',
                'Par imposition des mains',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus est descendu dans le Jourdain et en est remonté — c\'est une immersion complète.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_2->id,
            'question' => 'Selon Romains 6:3-4, que symbolise le baptême par immersion ?',
            'options' => [
                'Notre richesse spirituelle',
                'Notre mort, ensevelissement et résurrection avec Christ',
                'Notre sagesse',
                'Notre force',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le baptême symbolise notre mort avec Christ (immersion), notre ensevelissement (dans l\'eau) et notre résurrection pour une nouvelle vie (sortie de l\'eau).',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_2->id,
            'question' => 'Dans Actes 8:38-39, où Philippe et l\'eunuque sont-ils allés pour le baptême ?',
            'options' => [
                'Dans un temple',
                'Dans une maison',
                'Dans l\'eau',
                'Dans une église',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Ils sont descendus tous deux dans l\'eau pour le baptême, ce qui confirme la pratique par immersion.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_2->id,
            'question' => 'Que déclare-t-on en descendant dans l\'eau du baptême ?',
            'options' => [
                'Que nos péchés sont effacés par l\'eau',
                'Que notre ancienne vie est morte',
                'Que nous sommes parfaits',
                'Que nous ne pécherons plus',
            ],
            'bonne_reponse' => 1,
            'explication' => 'En descendant dans l\'eau, on déclare symboliquement que notre ancienne vie est morte. En remontant, on déclare qu\'on marche en nouveauté de vie.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 2.3 — Le baptême et le Saint-Esprit
        // ═══════════════════════════════════════════════════════════
        $lecon2_3 = Lecon::create([
            'niveau_id' => $niveau2->id,
            'titre' => 'Le baptême et le Saint-Esprit',
            'contenu' => "**Le baptême d'eau et le baptême du Saint-Esprit sont deux choses distinctes.**\n\n" .
                "Beaucoup confondent les deux. La Bible montre clairement qu'il y a :\n" .
                "• Le **baptême d'eau** — un acte extérieur d'obéissance\n" .
                "• Le **baptême du Saint-Esprit** — une expérience spirituelle de puissance\n\n" .
                "📖 **Jean-Baptiste annonçait les deux :**\n\n" .
                "📖 **Matthieu 3:11** — « Moi, je vous baptise d'eau, pour vous amener à la repentance ; mais Celui qui vient après moi est plus puissant que moi... Il vous baptisera du Saint-Esprit et de feu. »\n\n" .
                "Jean-Baptiste baptisait d'eau. Jésus baptise du Saint-Esprit.\n\n" .
                "📖 **Le jour de la Pentecôte :**\n\n" .
                "Après l'ascension de Jésus, les disciples étaient réunis à Jérusalem. Soudain, le Saint-Esprit descendit sur eux avec puissance. Ils furent remplis et commencèrent à parler en d'autres langues.\n\n" .
                "📖 **Actes 2:1-4** — « Le jour de la Pentecôte, ils étaient tous ensemble dans le même lieu. Tout à coup, il vint du ciel un bruit comme celui d'un vent impétueux... Et ils furent tous remplis du Saint-Esprit, et se mirent à parler en d'autres langues. »\n\n" .
                "📖 **L'exemple des Samaritains :**\n\n" .
                "Philippe prêcha à Samarie, et beaucoup crurent et furent baptisés d'eau. Mais ils n'avaient pas encore reçu le Saint-Esprit. Les apôtres vinrent prier pour eux, et ils reçurent le Saint-Esprit.\n\n" .
                "📖 **Actes 8:14-17** — « Les apôtres... envoyèrent Pierre et Jean... qui prièrent pour eux, afin qu'ils reçoivent le Saint-Esprit. Car Il n'était encore descendu sur aucun d'eux ; ils avaient seulement été baptisés au nom du Seigneur Jésus. Alors Pierre et Jean leur imposèrent les mains, et ils reçurent le Saint-Esprit. »\n\n" .
                "Cela prouve que le baptême d'eau et le baptême du Saint-Esprit sont bien deux choses distinctes.\n\n" .
                "💡 **Ce que le baptême du Saint-Esprit apporte :**\n" .
                "• **Puissance** pour témoigner (Actes 1:8)\n" .
                "• **Dons spirituels** (1 Corinthiens 12)\n" .
                "• **Fruit de l'Esprit** (Galates 5:22-23)\n" .
                "• **Intimité** avec Dieu\n" .
                "• **Direction** dans la vie\n\n" .
                "📖 **Actes 1:8** — « Mais vous recevrez une puissance, le Saint-Esprit survenant sur vous, et vous serez Mes témoins à Jérusalem, dans toute la Judée, dans la Samarie, et jusqu'aux extrémités de la terre. »\n\n" .
                "⚠️ **Important** : Le baptême du Saint-Esprit est pour TOUS les croyants. Ce n'est pas réservé aux pasteurs ou aux \"spéciaux\". C'est pour toi aussi !\n\n" .
                "📖 **Actes 2:38-39** — « Repentez-vous, et que chacun de vous soit baptisé au nom de Jésus-Christ... et vous recevrez le don du Saint-Esprit. Car la promesse est pour vous, pour vos enfants, et pour tous ceux qui sont loin, pour tous ceux que le Seigneur notre Dieu appellera. »\n\n" .
                "🙏 **Prière** : « Seigneur Jésus, je Te remercie pour Ton Saint-Esprit. Je veux Te recevoir d\'une manière nouvelle. Remplis-moi de Ton Esprit, donne-moi Ta puissance, et fais de moi un témoin vivant de Ton amour. Amen. »",
            'versets_cles' => 'Matthieu 3:11, Actes 2:1-4, Actes 8:14-17, Actes 1:8, Actes 2:38-39',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon2_3->id,
            'question' => 'Selon Matthieu 3:11, qui baptise du Saint-Esprit ?',
            'options' => [
                'Jean-Baptiste',
                'Les apôtres',
                'Jésus',
                'Les pasteurs',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jean-Baptiste a dit que Jésus baptiserait du Saint-Esprit et de feu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_3->id,
            'question' => 'Le baptême d\'eau et le baptême du Saint-Esprit sont-ils la même chose ?',
            'options' => [
                'Oui, c\'est identique',
                'Non, ce sont deux choses distinctes',
                'Oui, si on est adulte',
                'Oui, si on est baptisé par immersion',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La Bible montre clairement que ce sont deux expériences distinctes, comme le prouve l\'exemple des Samaritains dans Actes 8.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_3->id,
            'question' => 'Qu\'est-ce que le baptême du Saint-Esprit apporte ?',
            'options' => [
                'La richesse',
                'La puissance, les dons, le fruit de l\'Esprit',
                'La santé',
                'La célébrité',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le baptême du Saint-Esprit apporte la puissance pour témoigner, les dons spirituels, le fruit de l\'Esprit, et une intimité avec Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_3->id,
            'question' => 'Selon Actes 1:8, que recevons-nous quand le Saint-Esprit vient sur nous ?',
            'options' => [
                'Des richesses',
                'Une puissance pour être témoins',
                'Une position élevée',
                'Une sagesse humaine',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le Saint-Esprit nous donne la puissance pour être témoins de Jésus partout où nous allons.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_3->id,
            'question' => 'Selon Actes 2:39, pour qui est la promesse du Saint-Esprit ?',
            'options' => [
                'Uniquement pour les apôtres',
                'Uniquement pour les pasteurs',
                'Pour tous ceux qui croient, pour nous et nos enfants',
                'Uniquement pour les Juifs',
            ],
            'bonne_reponse' => 2,
            'explication' => 'La promesse du Saint-Esprit est pour tous ceux qui croient en Jésus, sans distinction.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 2.4 — Vivre après son baptême
        // ═══════════════════════════════════════════════════════════
        $lecon2_4 = Lecon::create([
            'niveau_id' => $niveau2->id,
            'titre' => 'Vivre après son baptême',
            'contenu' => "**Le baptême est un commencement, pas une arrivée.**\n\n" .
                "Beaucoup pensent qu'après le baptême tout est fini. Mais en réalité, c'est là que tout commence ! Le baptême marque le début d'une nouvelle vie avec Christ.\n\n" .
                "📖 **Ce que tu dois faire après ton baptême :**\n\n" .
                "1️⃣ **Persévérer dans la Parole**\n" .
                "Le premier signe d'un vrai disciple, c'est son attachement à la Parole de Dieu.\n\n" .
                "📖 **Actes 2:42** — « Ils persévéraient dans l'enseignement des apôtres, dans la communion fraternelle, dans la fraction du pain, et dans les prières. »\n\n" .
                "Chaque jour, lis la Bible. Même 10 minutes par jour transforment une vie.\n\n" .
                "2️⃣ **Vivre dans la prière**\n" .
                "La prière est ta respiration spirituelle. Sans elle, tu t'étouffes spirituellement.\n\n" .
                "📖 **1 Thessaloniciens 5:17** — « Priez sans cesse. »\n\n" .
                "3️⃣ **Rejoindre une communauté de foi**\n" .
                "Un chrétien seul est un chrétien en danger. Tu as besoin d'une famille spirituelle.\n\n" .
                "📖 **Hébreux 10:24-25** — « N'abandonnons pas notre assemblée, comme c'est la coutume de quelques-uns ; mais exhortons-nous réciproquement. »\n\n" .
                "4️⃣ **Témoigner de ta foi**\n" .
                "Ton baptême est un témoignage public. Maintenant, témoigne par ta vie et par tes paroles.\n\n" .
                "📖 **Matthieu 5:16** — « Que votre lumière luise ainsi devant les hommes, afin qu'ils voient vos bonnes œuvres, et qu'ils glorifient votre Père qui est dans les cieux. »\n\n" .
                "5️⃣ **Grandir dans la sanctification**\n" .
                "La sanctification, c'est le processus par lequel Dieu te rend de plus en plus semblable à Christ. Ça prend du temps, mais c'est l'objectif.\n\n" .
                "📖 **1 Thessaloniciens 4:3** — « Ce que Dieu veut, c'est votre sanctification. »\n\n" .
                "📖 **Les 4 piliers de la vie chrétienne :**\n\n" .
                "• **LA PAROLE** — Lire et méditer la Bible chaque jour\n" .
                "• **LA PRIÈRE** — Parler à Dieu régulièrement\n" .
                "• **LA COMMUNAUTÉ** — Vivre avec d'autres croyants\n" .
                "• **LE TÉMOIGNAGE** — Partager la Bonne Nouvelle\n\n" .
                "💡 **À retenir** : Le baptême est le début de ton aventure avec Dieu. Ne t'arrête pas là. Continue à grandir chaque jour.\n\n" .
                "⚠️ **Les épreuves viendront** : Après son baptême, Jésus a été tenté dans le désert. Toi aussi tu seras tenté. Mais souviens-toi : Dieu est avec toi, et Il ne permettra pas que tu sois tenté au-delà de tes forces.\n\n" .
                "📖 **1 Corinthiens 10:13** — « Dieu est fidèle, Il ne permettra pas que vous soyez tentés au-delà de vos forces ; mais avec la tentation, Il préparera aussi le moyen d'en sortir. »\n\n" .
                "🙏 **Prière** : « Seigneur, je Te remercie pour le don merveilleux du baptême. Maintenant, aide-moi à marcher avec Toi chaque jour. Rends-moi fidèle dans Ta Parole, dans la prière, dans la communauté et dans le témoignage. Que ma vie soit un reflet de Ton amour. Amen. »",
            'versets_cles' => 'Actes 2:42, 1 Thessaloniciens 5:17, Hébreux 10:24-25, Matthieu 5:16, 1 Corinthiens 10:13',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon2_4->id,
            'question' => 'Selon Actes 2:42, dans quoi les premiers chrétiens persévéraient-ils ?',
            'options' => [
                'Dans les richesses',
                'Dans l\'enseignement, la communion, la fraction du pain et les prières',
                'Dans les jeûnes uniquement',
                'Dans le jeûne et les bonnes œuvres',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les premiers chrétiens persévéraient dans 4 choses : l\'enseignement des apôtres, la communion fraternelle, la fraction du pain et les prières.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_4->id,
            'question' => 'Quels sont les 4 piliers de la vie chrétienne ?',
            'options' => [
                'Argent, célébrité, pouvoir, sagesse',
                'Parole, prière, communauté, témoignage',
                'Jeûne, offrande, chant, prière',
                'Étude, travail, sport, famille',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les 4 piliers sont : la Parole de Dieu, la prière, la communauté de foi et le témoignage.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_4->id,
            'question' => 'Un chrétien peut-il vivre sa foi tout seul ?',
            'options' => [
                'Oui, pas besoin d\'église',
                'Non, il a besoin d\'une communauté de foi',
                'Oui, si on prie régulièrement',
                'Oui, si on lit la Bible',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Hébreux 10:24-25 nous encourage à ne pas abandonner notre assemblée. La communauté est essentielle à la croissance spirituelle.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_4->id,
            'question' => 'Selon 1 Corinthiens 10:13, que fait Dieu face à la tentation ?',
            'options' => [
                'Il nous laisse tomber',
                'Il ne permettra pas que nous soyons tentés au-delà de nos forces',
                'Il nous punit',
                'Il nous ignore',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Dieu est fidèle : Il ne permettra jamais que tu sois tenté au-delà de tes forces, et Il te donnera toujours un moyen d\'en sortir.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon2_4->id,
            'question' => 'Le baptême est :',
            'options' => [
                'Une arrivée',
                'Un commencement',
                'Une fin en soi',
                'Une garantie de perfection',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le baptême est le COMMENCEMENT d\'une nouvelle vie avec Christ, pas une arrivée. Le chemin continue après.',
            'points' => 1,
        ]);

        $this->command->info('✅ Niveau 1 (Le Salut) + Niveau 2 (Le Baptême) créés');
    }
}