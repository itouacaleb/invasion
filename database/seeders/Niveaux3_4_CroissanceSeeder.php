<?php

namespace Database\Seeders;

use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use Illuminate\Database\Seeder;

class Niveaux3_4_CroissanceSeeder extends Seeder
{
    public function run(): void
    {
        // ═══════════════════════════════════════════════════════════
        // NIVEAU 3 : LA PRIÈRE
        // ═══════════════════════════════════════════════════════════
        $niveau3 = Niveau::create([
            'nom' => 'La Prière',
            'description' => 'Apprendre à communiquer avec Dieu et à persévérer',
            'ordre' => 3,
            'icone' => '🙏',
            'couleur' => '#7B1FA2',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 3.1 — Qu'est-ce que la prière ?
        // ═══════════════════════════════════════════════════════════
        $lecon3_1 = Lecon::create([
            'niveau_id' => $niveau3->id,
            'titre' => 'Qu\'est-ce que la prière ?',
            'contenu' => "**La prière est une conversation vivante avec Dieu.**\n\n" .
                "Beaucoup de gens pensent que la prière est un rituel religieux, une formule magique à réciter, ou un exercice obligatoire. Mais la prière est bien plus que cela : c'est une **relation**, une **communication intime** avec le Dieu vivant.\n\n" .
                "📖 **Ce que la prière n'est PAS :**\n\n" .
                "❌ Ce n'est pas un monologue — Dieu nous répond (par Sa Parole, par la paix, par le Saint-Esprit)\n" .
                "❌ Ce n'est pas une formule magique — Ce n'est pas répéter des mots sans cœur\n" .
                "❌ Ce n'est pas réservé aux pasteurs — Chaque enfant de Dieu peut prier\n" .
                "❌ Ce n'est pas une obligation religieuse — C'est un privilège et un plaisir\n\n" .
                "📖 **Ce que la prière EST :**\n\n" .
                "1️⃣ **Une relation** — Comme un enfant parle à son Père\n" .
                "📖 **Matthieu 6:9** — « Voici donc comment vous devez prier : Notre Père qui es aux cieux ! Que Ton nom soit sanctifié. »\n\n" .
                "Dieu n'est pas un être lointain et distant. Il est « Notre Père ». Nous pouvons L'appeler « Papa », avec intimité et confiance.\n\n" .
                "2️⃣ **Un dialogue** — Nous parlons, mais Dieu parle aussi\n" .
                "La prière n'est pas seulement nous qui parlons. C'est aussi prendre le temps d'écouter Dieu dans le silence, à travers Sa Parole, et par le Saint-Esprit.\n\n" .
                "3️⃣ **Une communion** — Être en Sa présence\n" .
                "📖 **1 Thessaloniciens 5:17** — « Priez sans cesse. »\n\n" .
                "« Prier sans cesse » ne veut pas dire être à genoux 24h/24. Cela veut dire vivre dans une attitude constante de communion avec Dieu, Lui parler tout au long de la journée.\n\n" .
                "4️⃣ **Un combat spirituel** — La prière est puissante\n" .
                "📖 **Jacques 5:16** — « La prière fervente du juste a une grande efficace. »\n\n" .
                "La prière n'est pas passive. C'est une arme spirituelle puissante qui peut changer les situations, les cœurs, et même le cours des événements.\n\n" .
                "📖 **Les différents types de prière :**\n\n" .
                "• **L'adoration** — Louer Dieu pour qui Il est\n" .
                "• **La confession** — Reconnaître nos péchés\n" .
                "• **L'action de grâce** — Remercier Dieu\n" .
                "• **La supplication** — Présenter nos demandes\n" .
                "• **L'intercession** — Prier pour les autres\n\n" .
                "💡 **À retenir** : La prière est ta respiration spirituelle. Sans elle, tu t'étouffes spirituellement. Avec elle, tu grandis, tu es fortifié, et tu vois Dieu agir.\n\n" .
                "📖 **Luc 18:1** — « Jésus leur adressa une parabole, pour montrer qu'il faut toujours prier, et ne point se relâcher. »\n\n" .
                "🙏 **Prière** : « Mon Père, je Te remercie de pouvoir venir à Toi à tout moment. Apprends-moi à prier, à T'écouter, et à vivre dans Ta présence chaque jour. Je veux Te connaître plus intimement. Amen. »",
            'versets_cles' => 'Matthieu 6:9, 1 Thessaloniciens 5:17, Jacques 5:16, Luc 18:1',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'Qu\'est-ce que la prière ?',
            'options' => [
                'Un rituel religieux à répéter',
                'Une conversation vivante avec Dieu',
                'Une formule magique',
                'Une obligation quotidienne',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La prière est une relation intime et vivante avec Dieu, pas un rituel ou une formule.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'Comment Jésus nous apprend-Il à appeler Dieu dans la prière ?',
            'options' => [
                'Un juge sévère',
                'Un roi lointain',
                'Notre Père',
                'Un inconnu',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jésus nous enseigne à appeler Dieu « Notre Père », ce qui souligne l\'intimité et la confiance que nous pouvons avoir avec Lui.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'Que signifie « Priez sans cesse » dans 1 Thessaloniciens 5:17 ?',
            'options' => [
                'Rester à genoux 24h/24',
                'Vivre dans une communion constante avec Dieu',
                'Ne rien faire d\'autre',
                'Répéter les mêmes mots',
            ],
            'bonne_reponse' => 1,
            'explication' => '« Prier sans cesse » signifie vivre dans une attitude continue de communion avec Dieu, Lui parlant tout au long de la journée.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'Pourquoi la prière est-elle puissante selon Jacques 5:16 ?',
            'options' => [
                'Parce qu\'elle est longue',
                'Parce qu\'elle est fervente et faite par un juste',
                'Parce qu\'on crie fort',
                'Parce qu\'on jeûne avant',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La prière fervente du juste (celui qui est justifié en Christ) a une grande efficace. Ce n\'est pas la longueur ni le volume, mais la sincérité et la foi.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_1->id,
            'question' => 'La prière est :',
            'options' => [
                'Réservée aux pasteurs',
                'Un privilège pour chaque enfant de Dieu',
                'Une obligation religieuse',
                'Une formule secrète',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Chaque enfant de Dieu peut prier. C\'est un privilège merveilleux, pas une obligation.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 3.2 — Comment prier ? Le Notre Père
        // ═══════════════════════════════════════════════════════════
        $lecon3_2 = Lecon::create([
            'niveau_id' => $niveau3->id,
            'titre' => 'Comment prier ? Le Notre Père',
            'contenu' => "**Jésus nous a donné un modèle parfait de prière.**\n\n" .
                "Quand les disciples ont demandé à Jésus : « Seigneur, enseigne-nous à prier » (Luc 11:1), Jésus leur a donné un modèle que nous appelons aujourd'hui « Le Notre Père ». Ce n'est pas une formule à réciter mécaniquement, mais un **modèle** à suivre.\n\n" .
                "📖 **Matthieu 6:9-13** — « Voici donc comment vous devez prier :\n\n" .
                "« Notre Père qui es aux cieux ! Que Ton nom soit sanctifié ; que Ton règne vienne ; que Ta volonté soit faite sur la terre comme au ciel. Donne-nous aujourd'hui notre pain quotidien ; pardonne-nous nos offenses, comme nous aussi nous pardonnons à ceux qui nous ont offensés ; ne nous induis pas en tentation, mais délivre-nous du malin. Car c'est à Toi qu'appartiennent, dans tous les siècles, le règne, la puissance et la gloire. Amen ! »\n\n" .
                "📖 **Décomposition du Notre Père :**\n\n" .
                "1️⃣ **« Notre Père qui es aux cieux »** — Reconnaître Dieu comme Père (intimité) et Roi (souveraineté)\n\n" .
                "2️⃣ **« Que Ton nom soit sanctifié »** — Honorer Dieu, Le glorifier, vivre pour Sa gloire\n\n" .
                "3️⃣ **« Que Ton règne vienne »** — Désirer que Dieu règne dans ma vie et dans le monde\n\n" .
                "4️⃣ **« Que Ta volonté soit faite »** — Se soumettre à la volonté de Dieu, Lui faire confiance\n\n" .
                "5️⃣ **« Donne-nous aujourd'hui notre pain quotidien »** — Demander nos besoins matériels, avec confiance\n\n" .
                "6️⃣ **« Pardonne-nous nos offenses »** — Confesser nos péchés, demander pardon\n\n" .
                "7️⃣ **« Comme nous aussi nous pardonnons »** — Pardonner aux autres, sans quoi Dieu ne peut nous pardonner\n\n" .
                "8️⃣ **« Ne nous induis pas en tentation »** — Demander la protection contre les tentations\n\n" .
                "9️⃣ **« Délivre-nous du malin »** — Demander la délivrance du diable et de ses pièges\n\n" .
                "🔟 **« Car c'est à Toi qu'appartiennent le règne, la puissance et la gloire »** — Reconnaître la souveraineté de Dieu\n\n" .
                "📖 **Les attitudes d'une prière efficace :**\n\n" .
                "• **Avec foi** — « Tout ce que vous demanderez en priant, croyez que vous l'avez reçu, et vous le verrez s'accomplir » (Marc 11:24)\n" .
                "• **Avec humilité** — Dieu résiste aux orgueilleux, mais Il fait grâce aux humbles\n" .
                "• **Avec persévérance** — « Priez sans cesse » (1 Thessaloniciens 5:17)\n" .
                "• **Avec un cœur pur** — « Si je garde l'iniquité dans mon cœur, le Seigneur ne m'écoutera pas » (Psaume 66:18)\n" .
                "• **Au nom de Jésus** — « Tout ce que vous demanderez en Mon nom, Je le ferai » (Jean 14:14)\n\n" .
                "💡 **À retenir** : Le Notre Père n'est pas une formule à réciter par cœur, mais un modèle qui nous montre comment structurer nos prières : adoration, soumission, demande, confession, protection.\n\n" .
                "🙏 **Prière** : « Notre Père qui es aux cieux, que Ton nom soit sanctifié. Que Ton règne vienne dans ma vie. Que Ta volonté soit faite. Donne-moi aujourd\'hui ce dont j\'ai besoin. Pardonne-moi mes péchés comme je pardonne aux autres. Protège-moi du mal. À Toi le règne, la puissance et la gloire. Amen. »",
            'versets_cles' => 'Matthieu 6:9-13, Luc 11:1, Marc 11:24, Jean 14:14',
            'ordre' => 2,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon3_2->id,
            'question' => 'Que voulait dire « Que Ton nom soit sanctifié » dans le Notre Père ?',
            'options' => [
                'Ne pas prononcer le nom de Dieu',
                'Honorer Dieu et Le glorifier',
                'Prier en silence',
                'Écrire le nom de Dieu',
            ],
            'bonne_reponse' => 1,
            'explication' => '« Sanctifier » signifie honorer, glorifier. C\'est un appel à vivre pour la gloire de Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_2->id,
            'question' => 'Pourquoi devons-nous pardonner aux autres selon le Notre Père ?',
            'options' => [
                'Parce que c\'est une règle',
                'Parce que Dieu nous pardonne et nous devons refléter Son pardon',
                'Parce que sinon on va en enfer',
                'Parce que c\'est facile',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le pardon que nous recevons de Dieu doit se refléter dans le pardon que nous accordons aux autres. C\'est le signe que nous avons vraiment compris la grâce.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_2->id,
            'question' => 'Selon Marc 11:24, comment devons-nous prier ?',
            'options' => [
                'En doutant',
                'Avec foi, en croyant que nous avons déjà reçu',
                'En criant fort',
                'En jeûnant 3 jours',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus dit : « Tout ce que vous demanderez en priant, croyez que vous l\'avez reçu, et vous le verrez s\'accomplir. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_2->id,
            'question' => 'Au nom de qui devons-nous prier ?',
            'options' => [
                'Au nom des saints',
                'Au nom de Marie',
                'Au nom de Jésus',
                'Au nom des anges',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jésus a dit : « Tout ce que vous demanderez en Mon nom, Je le ferai. » Nous prions au nom de Jésus, car Il est notre médiateur.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_2->id,
            'question' => 'Le Notre Père est :',
            'options' => [
                'Une formule magique',
                'Un modèle à suivre pour structurer nos prières',
                'La seule prière autorisée',
                'Une prière à réciter 10 fois par jour',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le Notre Père est un modèle, pas une formule. Il nous montre comment structurer nos prières, mais nous devons prier avec nos propres mots et notre cœur.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 3.3 — L'intercession
        // ═══════════════════════════════════════════════════════════
        $lecon3_3 = Lecon::create([
            'niveau_id' => $niveau3->id,
            'titre' => 'L\'intercession',
            'contenu' => "**L'intercession, c'est prier pour les autres.**\n\n" .
                "La plupart du temps, nous prions pour nous-mêmes : nos besoins, nos problèmes, nos désirs. Mais la Bible nous appelle à prier **aussi pour les autres**. C'est ce qu'on appelle l'**intercession**.\n\n" .
                "📖 **Qu'est-ce que l'intercession ?**\n\n" .
                "Intercéder, c'est se placer entre Dieu et une personne (ou une situation) pour demander Sa grâce, Sa protection, Sa bénédiction en faveur de cette personne.\n\n" .
                "📖 **1 Timothée 2:1** — « J'exhorte donc, avant toutes choses, à faire des prières, des supplications, des requêtes, des actions de grâces, pour tous les hommes. »\n\n" .
                "📖 **Les exemples bibliques d'intercession :**\n\n" .
                "1️⃣ **Abraham** a intercédé pour Sodome et Gomorrhe (Genèse 18:22-33)\n\n" .
                "2️⃣ **Moïse** a intercédé pour Israël quand Dieu voulait les détruire (Exode 32:11-14)\n\n" .
                "3️⃣ **Daniel** priait 3 fois par jour pour son peuple (Daniel 6:10)\n\n" .
                "4️⃣ **Jésus** Lui-même intercède pour nous (Hébreux 7:25)\n\n" .
                "5️⃣ **Paul** priait constamment pour les églises (Philippiens 1:3-5)\n\n" .
                "📖 **Pour qui devons-nous intercéder ?**\n\n" .
                "• **Notre famille** — Époux, enfants, parents, frères et sœurs\n" .
                "• **Nos frères et sœurs en Christ** — Les membres de l'église\n" .
                "• **Nos dirigeants** — Ceux qui ont autorité sur nous (1 Timothée 2:2)\n" .
                "• **Les malades** — Jacques 5:14-15\n" .
                "• **Les perdus** — Ceux qui ne connaissent pas Jésus\n" .
                "• **Nos ennemis** — Jésus a dit : « Priez pour ceux qui vous maltraitent » (Matthieu 5:44)\n\n" .
                "📖 **Le pouvoir de l'intercession :**\n\n" .
                "📖 **Jacques 5:16** — « Confessez donc vos péchés les uns aux autres, et priez les uns pour les autres, afin que vous soyez guéris. La prière fervente du juste a une grande efficace. »\n\n" .
                "Quand nous prions pour les autres, Dieu agit puissamment. Nos prières peuvent apporter la guérison, la délivrance, le salut.\n\n" .
                "📖 **Le rôle de Jésus comme intercesseur :**\n\n" .
                "Jésus est notre grand Intercesseur. Il est à la droite de Dieu et Il prie pour nous constamment.\n\n" .
                "📖 **Hébreux 7:25** — « C'est aussi pour cela qu'Il peut sauver parfaitement ceux qui s'approchent de Dieu par Lui, étant toujours vivant pour intercéder en leur faveur. »\n\n" .
                "💡 **À retenir** : L'intercession est un ministère puissant. Quand tu pries pour quelqu'un, tu deviens un canal de la grâce de Dieu dans sa vie.\n\n" .
                "⚠️ **Prier pour les autres change aussi ton cœur** : Quand tu intercèdes pour quelqu'un, tu commences à l'aimer davantage. Ton cœur s'élargit pour lui.\n\n" .
                "🙏 **Prière d'intercession** : « Père, je Te présente mes proches, mes frères et sœurs en Christ, ceux qui souffrent, et même mes ennemis. Touche leur vie par Ta grâce. Guéris les malades, console les affligés, sauve les perdus. Que Ta volonté parfaite s\'accomplisse dans leur vie. Amen. »",
            'versets_cles' => '1 Timothée 2:1, Jacques 5:16, Hébreux 7:25, Matthieu 5:44',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon3_3->id,
            'question' => 'Qu\'est-ce que l\'intercession ?',
            'options' => [
                'Prier pour soi-même',
                'Prier pour les autres',
                'Lire la Bible',
                'Chanter des louanges',
            ],
            'bonne_reponse' => 1,
            'explication' => 'L\'intercession, c\'est prier pour les autres personnes, en se plaçant entre Dieu et elles pour demander Sa grâce.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_3->id,
            'question' => 'Pour qui devons-nous intercéder selon 1 Timothée 2:1 ?',
            'options' => [
                'Uniquement pour les croyants',
                'Pour tous les hommes',
                'Uniquement pour notre famille',
                'Uniquement pour les pasteurs',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul nous exhorte à faire des prières et des intercessions « pour tous les hommes », sans exception.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_3->id,
            'question' => 'Qui est notre grand Intercesseur auprès de Dieu ?',
            'options' => [
                'Les apôtres',
                'Les prophètes',
                'Jésus-Christ',
                'Les anges',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jésus est notre grand Intercesseur. Il est à la droite de Dieu et Il intercède constamment pour nous (Hébreux 7:25).',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_3->id,
            'question' => 'Devons-nous prier pour nos ennemis ?',
            'options' => [
                'Non, ils ne le méritent pas',
                'Oui, Jésus nous l\'a commandé',
                'Seulement s\'ils nous le demandent',
                'Uniquement dans les cas graves',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Priez pour ceux qui vous maltraitent » (Matthieu 5:44). L\'intercession pour nos ennemis brise la haine et ouvre la voie à la réconciliation.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_3->id,
            'question' => 'Que fait la prière fervente du juste selon Jacques 5:16 ?',
            'options' => [
                'Elle nous rend célèbres',
                'Elle a une grande efficace',
                'Elle nous rend riches',
                'Elle nous donne du pouvoir',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La prière fervente du juste a une grande efficace. Elle peut apporter la guérison, la délivrance, et changer les situations.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 3.4 — Le jeûne et la persévérance
        // ═══════════════════════════════════════════════════════════
        $lecon3_4 = Lecon::create([
            'niveau_id' => $niveau3->id,
            'titre' => 'Le jeûne et la persévérance',
            'contenu' => "**Le jeûne et la persévérance sont deux armes puissantes dans la prière.**\n\n" .
                "Beaucoup abandonnent la prière quand la réponse ne vient pas tout de suite. Mais la Bible nous enseigne à **persévérer** et à **jeûner** pour voir Dieu agir.\n\n" .
                "📖 **LE JEÛNE**\n\n" .
                "Le jeûne consiste à s'abstenir volontairement de nourriture (ou d'autre chose) pendant un temps déterminé pour se consacrer à Dieu, à la prière, et à la recherche de Sa volonté.\n\n" .
                "📖 **Matthieu 6:16-18** — Jésus a dit : « Lorsque vous jeûnez, ne prenez pas un air triste, comme les hypocrites... Mais quand tu jeûnes, parfume ta tête et lave ton visage, afin de ne pas montrer aux hommes que tu jeûnes, mais à ton Père qui est là dans le lieu secret ; et ton Père, qui voit dans le secret, te le rendra. »\n\n" .
                "⚠️ Attention : Jésus ne dit pas « SI vous jeûnez », mais « QUAND vous jeûnez ». Le jeûne fait partie de la vie chrétienne normale.\n\n" .
                "📖 **Le but du jeûne :**\n" .
                "• **Se consacrer à Dieu** — Mettre Dieu au-dessus de la nourriture\n" .
                "• **Chercher Sa volonté** — Écouter Dieu pour une décision importante\n" .
                "• **Intercéder** — Prier intensément pour une situation\n" .
                "• **Combattre spirituellement** — Chasser les influences démoniaques\n" .
                "• **Se repentir** — Exprimer un regret profond devant Dieu\n\n" .
                "📖 **Les exemples bibliques de jeûne :**\n" .
                "• **Moïse** jeûna 40 jours sur le mont Sinaï (Exode 34:28)\n" .
                "• **Jésus** jeûna 40 jours dans le désert avant Son ministère (Matthieu 4:1-2)\n" .
                "• **Daniel** jeûna pour obtenir une révélation (Daniel 10:3)\n" .
                "• **Esther** jeûna avec tout le peuple pour être délivrée (Esther 4:16)\n" .
                "• **L'église primitive** jeûna avant d'envoyer Paul et Barnabé (Actes 13:2-3)\n\n" .
                "📖 **LA PERSÉVÉRANCE**\n\n" .
                "La persévérance consiste à **continuer à prier** même quand on ne voit rien venir.\n\n" .
                "📖 **Luc 18:1-8** — Jésus raconta la parabole de la veuve persistante pour montrer « qu'il faut toujours prier, et ne point se relâcher ».\n\n" .
                "La veuve venait sans cesse voir le juge injuste pour obtenir justice. Elle a persisté jusqu'à ce qu'elle obtienne. Si même un juge injuste cède à la persévérance, combien plus notre Père céleste, qui est juste et bon, répondra à ceux qui persistent !\n\n" .
                "📖 **Galates 6:9** — « Ne nous lassons pas de faire le bien ; car nous moissonnerons au temps convenable, si nous ne nous relâchons pas. »\n\n" .
                "📖 **Les 3 clés de la persévérance :**\n" .
                "1. **Prier sans cesse** — Ne pas abandonner après 2 ou 3 prières\n" .
                "2. **Croire que Dieu agira** — Même si la réponse tarde\n" .
                "3. **Rester dans la foi** — Ne pas douter, continuer à espérer\n\n" .
                "💡 **À retenir** : Dieu répond toujours à la prière : soit par un OUI, soit par un NON, soit par un ATTENDS. La persévérance nous fait grandir et nous prépare à recevoir la réponse.\n\n" .
                "⚠️ **Le jeûne doit être accompagné de prière** : Jeûner sans prier n'a pas de sens. Le jeûne est un moyen de consacrer plus de temps à la prière.\n\n" .
                "🙏 **Prière** : « Seigneur, apprends-moi à persévérer dans la prière et à jeûner quand c\'est nécessaire. Je crois que Tu entends et que Tu agiras au moment parfait. Fortifie ma foi et ma patience. Amen. »",
            'versets_cles' => 'Matthieu 6:16-18, Luc 18:1-8, Galates 6:9, Matthieu 4:1-2',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon3_4->id,
            'question' => 'Qu\'est-ce que le jeûne ?',
            'options' => [
                'Ne pas dormir',
                'S\'abstenir volontairement de nourriture pour se consacrer à Dieu',
                'Ne pas parler',
                'Ne pas travailler',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le jeûne consiste à s\'abstenir volontairement de nourriture (ou d\'autre chose) pendant un temps déterminé pour se consacrer à Dieu et à la prière.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_4->id,
            'question' => 'Selon Matthieu 6:16-18, quelle est la bonne attitude en jeûnant ?',
            'options' => [
                'Montrer qu\'on jeûne à tout le monde',
                'Se parfumer et avoir l\'air normal, en secret devant Dieu',
                'Pleurer devant les gens',
                'Crier fort',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus nous dit de jeûner en secret, sans montrer aux hommes que nous jeûnons, mais à notre Père qui voit dans le secret.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_4->id,
            'question' => 'Combien de temps Jésus a-t-Il jeûné dans le désert ?',
            'options' => [
                '3 jours',
                '7 jours',
                '21 jours',
                '40 jours',
            ],
            'bonne_reponse' => 3,
            'explication' => 'Jésus a jeûné 40 jours dans le désert avant de commencer Son ministère public (Matthieu 4:1-2).',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_4->id,
            'question' => 'Que nous enseigne la parabole de la veuve persistante dans Luc 18 ?',
            'options' => [
                'Qu\'il faut se venger',
                'Qu\'il faut toujours prier et ne point se relâcher',
                'Qu\'il faut être riche',
                'Qu\'il faut jeûner 40 jours',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a raconté cette parabole pour montrer qu\'il faut toujours prier et ne point se relâcher (Luc 18:1).',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon3_4->id,
            'question' => 'Selon Galates 6:9, que se passe-t-il si nous ne nous relâchons pas ?',
            'options' => [
                'Nous devenons célèbres',
                'Nous moissonnerons au temps convenable',
                'Nous serons riches',
                'Nous n\'aurons plus de problèmes',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul nous encourage : « Ne nous lassons pas de faire le bien ; car nous moissonnerons au temps convenable, si nous ne nous relâchons pas. »',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // NIVEAU 4 : LA PAROLE DE DIEU
        // ═══════════════════════════════════════════════════════════
        $niveau4 = Niveau::create([
            'nom' => 'La Parole de Dieu',
            'description' => 'Découvrir la puissance et l\'importance de la Bible',
            'ordre' => 4,
            'icone' => '📖',
            'couleur' => '#2E7D32',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 4.1 — La Bible, Parole inspirée de Dieu
        // ═══════════════════════════════════════════════════════════
        $lecon4_1 = Lecon::create([
            'niveau_id' => $niveau4->id,
            'titre' => 'La Bible, Parole inspirée de Dieu',
            'contenu' => "**La Bible n'est pas un livre ordinaire : c'est la Parole de Dieu.**\n\n" .
                "Beaucoup de livres parlent de Dieu. Mais la Bible est le seul livre qui est **la Parole de Dieu elle-même** adressée à l'humanité. Elle est **inspirée** par Dieu, c'est-à-dire que Dieu a soufflé Ses paroles à travers les auteurs humains.\n\n" .
                "📖 **2 Timothée 3:16-17** — « Toute Écriture est inspirée de Dieu, et utile pour enseigner, pour convaincre, pour corriger, pour instruire dans la justice, afin que l'homme de Dieu soit accompli et propre à toute bonne œuvre. »\n\n" .
                "📖 **Les caractéristiques de la Bible :**\n\n" .
                "1️⃣ **Elle est inspirée par Dieu**\n" .
                "📖 **2 Pierre 1:20-21** — « Sachez avant tout qu'aucune prophétie de l'Écriture ne peut être un objet d'interprétation particulière, car ce n'est pas par une volonté d'homme qu'une prophétie a jamais été apportée, mais c'est poussés par le Saint-Esprit que des hommes ont parlé de la part de Dieu. »\n\n" .
                "Les auteurs de la Bible n'ont pas écrit leurs propres pensées. Ils ont été **poussés par le Saint-Esprit**.\n\n" .
                "2️⃣ **Elle est vivante et efficace**\n" .
                "📖 **Hébreux 4:12** — « Car la Parole de Dieu est vivante et efficace, plus tranchante qu'une épée quelconque à deux tranchants, pénétrante jusqu'à partager âme et esprit, jointures et moelles ; elle juge les sentiments et les pensées du cœur. »\n\n" .
                "La Bible n'est pas un livre mort. Elle est **vivante**. Quand tu la lis, Dieu te parle directement.\n\n" .
                "3️⃣ **Elle est éternelle**\n" .
                "📖 **Ésaïe 40:8** — « L'herbe sèche, la fleur tombe ; mais la Parole de notre Dieu subsiste éternellement. »\n\n" .
                "Les civilisations passent, les philosophies changent, mais la Parole de Dieu demeure pour toujours.\n\n" .
                "4️⃣ **Elle est vraie et digne de confiance**\n" .
                "📖 **Jean 17:17** — « Sanctifie-les par Ta vérité : Ta Parole est la vérité. »\n\n" .
                "Jésus Lui-même a déclaré que la Parole de Dieu est la vérité. Elle ne contient aucune erreur.\n\n" .
                "📖 **La structure de la Bible :**\n\n" .
                "• **Ancien Testament** — 39 livres (création, patriarches, loi, prophètes)\n" .
                "• **Nouveau Testament** — 27 livres (vie de Jésus, église, épîtres, apocalypse)\n" .
                "• **Total** — 66 livres, écrits sur environ 1500 ans par plus de 40 auteurs\n\n" .
                "Malgré la diversité des auteurs et des époques, la Bible forme une unité parfaite : elle raconte l'histoire du salut de Dieu pour l'humanité.\n\n" .
                "💡 **À retenir** : La Bible est la Parole de Dieu. Quand tu la lis, tu entends la voix de Dieu. Elle est ta nourriture spirituelle, ta boussole, ton arme.\n\n" .
                "⚠️ **Prends l'habitude de lire la Bible chaque jour** — Un chrétien qui ne lit pas la Bible est un chrétien qui s'affaiblit spirituellement.\n\n" .
                "🙏 **Prière** : « Seigneur, je Te remercie pour Ta Parole. Ouvre mes yeux pour que je contemple les merveilles de Ta loi. Que Ta Parole soit ma nourriture quotidienne, ma lampe à mes pieds, et la joie de mon cœur. Amen. »",
            'versets_cles' => '2 Timothée 3:16-17, 2 Pierre 1:20-21, Hébreux 4:12, Ésaïe 40:8, Jean 17:17',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Selon 2 Timothée 3:16, toute Écriture est :',
            'options' => [
                'Inventée par les hommes',
                'Inspirée de Dieu',
                'Un mythe',
                'Une simple histoire',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul affirme que toute l\'Écriture est inspirée de Dieu. Dieu Lui-même a soufflé Ses paroles à travers les auteurs humains.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Que dit Hébreux 4:12 au sujet de la Parole de Dieu ?',
            'options' => [
                'Elle est ennuyeuse',
                'Elle est vivante et efficace',
                'Elle est dépassée',
                'Elle est difficile',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La Parole de Dieu est vivante et efficace, plus tranchante qu\'une épée à deux tranchants, pénétrant jusqu\'au plus profond de notre être.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Combien de livres contient la Bible ?',
            'options' => [
                '40',
                '50',
                '66',
                '100',
            ],
            'bonne_reponse' => 2,
            'explication' => 'La Bible contient 66 livres : 39 dans l\'Ancien Testament et 27 dans le Nouveau Testament.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Selon Jean 17:17, qu\'est-ce que la Parole de Dieu ?',
            'options' => [
                'Une opinion',
                'Une tradition',
                'La vérité',
                'Une philosophie',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jésus a prié : « Sanctifie-les par Ta vérité : Ta Parole est la vérité. » La Bible est la vérité absolue.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_1->id,
            'question' => 'Comment la Bible a-t-elle été écrite selon 2 Pierre 1:21 ?',
            'options' => [
                'Par la volonté des hommes',
                'Poussés par le Saint-Esprit',
                'Par des philosophes',
                'Par des rois',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les auteurs de la Bible ont été poussés par le Saint-Esprit. C\'est Dieu qui a parlé à travers eux.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 4.2 — Comment étudier la Bible
        // ═══════════════════════════════════════════════════════════
        $lecon4_2 = Lecon::create([
            'niveau_id' => $niveau4->id,
            'titre' => 'Comment étudier la Bible',
            'contenu' => "**Lire la Bible, c'est bien. L'étudier, c'est mieux.**\n\n" .
                "Beaucoup de chrétiens lisent la Bible rapidement sans vraiment la comprendre. Mais Dieu veut que nous la **méditions** et l'**étudiions** pour être transformés.\n\n" .
                "📖 **Josué 1:8** — « Que ce livre de la loi ne s'éloigne point de ta bouche ; médite-le jour et nuit, pour agir fidèlement selon tout ce qui y est écrit ; car c'est alors que tu auras du succès dans tes entreprises, c'est alors que tu réussiras. »\n\n" .
                "📖 **Les 5 étapes pour étudier la Bible :**\n\n" .
                "1️⃣ **PRIER avant de lire**\n" .
                "Demande au Saint-Esprit de t'ouvrir les yeux et de te parler. Sans Lui, la Bible reste un livre fermé.\n\n" .
                "📖 **Psaume 119:18** — « Dessille mes yeux, afin que je contemple les merveilles de Ta loi ! »\n\n" .
                "2️⃣ **LIRE attentivement le passage**\n" .
                "Lis plusieurs fois. Prends le temps. Ne te précipite pas. Choisis un passage court (5-10 versets) plutôt qu'un long chapitre bâclé.\n\n" .
                "3️⃣ **OBSERVER les détails**\n" .
                "Pose-toi des questions :\n" .
                "• Qui parle ? À qui ?\n" .
                "• Où et quand cela se passe-t-il ?\n" .
                "• Pourquoi ce message a-t-il été écrit ?\n" .
                "• Y a-t-il des mots-clés, des répétitions, des contrastes ?\n\n" .
                "4️⃣ **MÉDITER sur ce que tu lis**\n" .
                "Méditer, c'est ruminer la Parole comme un ruminant rumine l'herbe. Tu la tournes dans ton esprit encore et encore.\n" .
                "• Que me dit Dieu à travers ce passage ?\n" .
                "• Comment cela s'applique-t-il à ma vie ?\n" .
                "• Y a-t-il un péché à abandonner ? Une promesse à saisir ? Un commandement à obéir ?\n\n" .
                "📖 **Psaume 1:2-3** — « Mais qui trouve son plaisir dans la loi de l'Éternel, et qui la médite jour et nuit ! Il est comme un arbre planté près d'un courant d'eau, qui donne son fruit en sa saison, et dont le feuillage ne se flétrit point. »\n\n" .
                "5️⃣ **APPLIQUER ce que tu apprends**\n" .
                "La Bible n'est pas faite pour être juste lue, mais pour être **vécue**. Après chaque lecture, demande-toi : « Qu'est-ce que je vais faire différemment aujourd'hui ? »\n\n" .
                "📖 **Jacques 1:22** — « Mettez en pratique la Parole, et ne vous bornez pas à l'écouter, en vous trompant vous-mêmes par de faux raisonnements. »\n\n" .
                "📖 **Quand et combien de temps lire la Bible ?**\n\n" .
                "• **Le matin** — Commence ta journée avec Dieu (Marc 1:35)\n" .
                "• **Le soir** — Termine ta journée avec Sa Parole (Psaume 119:148)\n" .
                "• **Un moment régulier** — Choisis une heure fixe chaque jour\n" .
                "• **15-30 minutes minimum** — Un chrétien devrait lire la Bible quotidiennement\n\n" .
                "💡 **Un conseil pratique** : Suis un **plan de lecture**.\n" .
                "• Commence par l'Évangile de Jean (21 chapitres)\n" .
                "• Puis les autres Évangiles (Matthieu, Marc, Luc)\n" .
                "• Puis les Actes et les Épîtres\n" .
                "• En parallèle, lis un Psaume et un Proverbe chaque jour\n\n" .
                "⚠️ **Ne te décourage pas** : Si tu ne comprends pas tout, c'est normal. Continue. Plus tu lis, plus tu comprends.\n\n" .
                "🙏 **Prière** : « Saint-Esprit, ouvre mes yeux pour que je comprenne Ta Parole. Donne-moi un désir profond de Te connaître à travers les Écritures. Aide-moi à obéir à ce que je lis, et à être transformé par Ta vérité. Amen. »",
            'versets_cles' => 'Josué 1:8, Psaume 119:18, Psaume 1:2-3, Jacques 1:22, Marc 1:35',
            'ordre' => 2,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon4_2->id,
            'question' => 'Que devons-nous faire AVANT de lire la Bible ?',
            'options' => [
                'Allumer une bougie',
                'Prier et demander au Saint-Esprit de nous ouvrir les yeux',
                'Jeûner 3 jours',
                'Aller à l\'église',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Nous devons prier avant de lire la Bible, demandant au Saint-Esprit de nous éclairer, car sans Lui, la Bible reste un livre fermé.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_2->id,
            'question' => 'Que signifie « méditer » la Parole de Dieu ?',
            'options' => [
                'La lire rapidement',
                'La ruminer dans son esprit, y réfléchir profondément',
                'L\'oublier',
                'La mémoriser mot à mot',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Méditer, c\'est ruminer la Parole, la tourner dans son esprit encore et encore, la laisser pénétrer notre cœur.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_2->id,
            'question' => 'Selon Jacques 1:22, que devons-nous faire de la Parole ?',
            'options' => [
                'Juste l\'écouter',
                'La mettre en pratique',
                'La mémoriser',
                'L\'oublier',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jacques nous dit de mettre en pratique la Parole, et non de nous borner à l\'écouter. La Parole doit transformer notre vie.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_2->id,
            'question' => 'Selon Josué 1:8, que devons-nous faire de la Parole pour réussir ?',
            'options' => [
                'La lire une fois',
                'La méditer jour et nuit',
                'L\'ignorer',
                'La mémoriser',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Josué 1:8 dit de méditer la Parole « jour et nuit ». C\'est la clé du succès spirituel.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_2->id,
            'question' => 'Quand devons-nous lire la Bible ?',
            'options' => [
                'Uniquement le dimanche',
                'Régulièrement chaque jour',
                'Une fois par mois',
                'Quand on a envie',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Nous devons lire la Bible quotidiennement, à un moment régulier. C\'est notre nourriture spirituelle.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 4.3 — La Parole qui transforme
        // ═══════════════════════════════════════════════════════════
        $lecon4_3 = Lecon::create([
            'niveau_id' => $niveau4->id,
            'titre' => 'La Parole qui transforme',
            'contenu' => "**La Parole de Dieu a le pouvoir de transformer une vie.**\n\n" .
                "La Bible n'est pas un simple livre de sagesse. Elle est **vivante** et **agissante**. Elle a le pouvoir de transformer les cœurs, de guérir les âmes, de renouveler les pensées, et de changer complètement une vie.\n\n" .
                "📖 **Les 6 manières dont la Parole transforme :**\n\n" .
                "1️⃣ **Elle sauve**\n" .
                "📖 **Romains 10:17** — « Ainsi la foi vient de ce qu'on entend, et ce qu'on entend vient de la Parole de Christ. »\n\n" .
                "Beaucoup de personnes ont été sauvées en lisant ou en entendant la Bible. La Parole de Dieu produit la foi qui sauve.\n\n" .
                "2️⃣ **Elle guérit**\n" .
                "📖 **Psaume 107:20** — « Il envoya Sa parole et les guérit, Il les fit échapper de la fosse. »\n\n" .
                "La Parole de Dieu a un pouvoir de guérison, tant physique que spirituelle.\n\n" .
                "3️⃣ **Elle libère**\n" .
                "📖 **Jean 8:31-32** — « Si vous persévérez dans Ma parole, vous êtes vraiment Mes disciples ; vous connaîtrez la vérité, et la vérité vous affranchira. »\n\n" .
                "La vérité de la Parole de Dieu libère des mensonges, des dépendances, des peurs, des chaînes spirituelles.\n\n" .
                "4️⃣ **Elle sanctifie**\n" .
                "📖 **Jean 17:17** — « Sanctifie-les par Ta vérité : Ta Parole est la vérité. »\n\n" .
                "La Parole de Dieu nous aide à grandir en sainteté, à rejeter le péché, à nous rapprocher de Dieu.\n\n" .
                "5️⃣ **Elle nous guide**\n" .
                "📖 **Psaume 119:105** — « Ta Parole est une lampe à mes pieds, et une lumière sur mon sentier. »\n\n" .
                "Quand tu ne sais pas quelle décision prendre, la Parole de Dieu t'éclaire et te montre la bonne direction.\n\n" .
                "6️⃣ **Elle fortifie**\n" .
                "📖 **Matthieu 4:4** — « L'homme ne vivra pas de pain seulement, mais de toute parole qui sort de la bouche de Dieu. »\n\n" .
                "La Bible est notre nourriture spirituelle. Ceux qui la lisent régulièrement sont spirituellement forts.\n\n" .
                "📖 **La Parole est comparée à :**\n\n" .
                "• **Une épée** — Elle tranche (Éphésiens 6:17)\n" .
                "• **Un marteau** — Elle brise (Jérémie 23:29)\n" .
                "• **Un feu** — Elle purifie (Jérémie 23:29)\n" .
                "• **Une semence** — Elle porte du fruit (Luc 8:11)\n" .
                "• **Du pain** — Elle nourrit (Matthieu 4:4)\n" .
                "• **De l'eau** — Elle lave (Éphésiens 5:26)\n" .
                "• **Un miroir** — Elle révèle (Jacques 1:23-24)\n" .
                "• **De l'or** — Elle est précieuse (Psaume 19:10)\n" .
                "• **Du miel** — Elle est douce (Psaume 119:103)\n" .
                "• **Une lampe** — Elle éclaire (Psaume 119:105)\n\n" .
                "💡 **À retenir** : Plus tu passes du temps dans la Parole de Dieu, plus tu es transformé. La transformation n'est pas instantanée, mais progressive. C'est en lisant, méditant et obéissant que Dieu te change de gloire en gloire.\n\n" .
                "📖 **2 Corinthiens 3:18** — « Nous tous qui, le visage découvert, contemplons comme dans un miroir la gloire du Seigneur, nous sommes transformés en la même image, de gloire en gloire, comme par le Seigneur, l'Esprit. »\n\n" .
                "🙏 **Prière** : « Seigneur, que Ta Parole transforme ma vie. Qu\'elle me sauve, me guérisse, me libère, me sanctifie, me guide et me fortifie. Fais de moi un disciple transformé par Ta vérité. Amen. »",
            'versets_cles' => 'Romains 10:17, Psaume 107:20, Jean 8:31-32, Jean 17:17, Psaume 119:105',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon4_3->id,
            'question' => 'Selon Romains 10:17, d\'où vient la foi ?',
            'options' => [
                'De nos sentiments',
                'De l\'écoute de la Parole de Dieu',
                'De nos œuvres',
                'Des miracles',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La foi vient de ce qu\'on entend, et ce qu\'on entend vient de la Parole de Christ.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_3->id,
            'question' => 'Selon Jean 8:32, qu\'est-ce que la vérité nous apporte ?',
            'options' => [
                'La richesse',
                'La liberté',
                'La célébrité',
                'La sagesse humaine',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Vous connaîtrez la vérité, et la vérité vous affranchira. » La vérité de la Parole de Dieu libère.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_3->id,
            'question' => 'Selon Psaume 119:105, la Parole de Dieu est :',
            'options' => [
                'Un fardeau',
                'Une lampe à mes pieds et une lumière sur mon sentier',
                'Un mystère',
                'Une tradition',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La Parole de Dieu éclaire notre chemin. Elle nous guide dans nos décisions et nous montre la bonne direction.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_3->id,
            'question' => 'À quoi la Parole de Dieu est-elle comparée dans Éphésiens 6:17 ?',
            'options' => [
                'Un bouclier',
                'Une épée',
                'Un casque',
                'Une cuirasse',
            ],
            'bonne_reponse' => 1,
            'explication' => 'La Parole de Dieu est comparée à une épée de l\'Esprit. C\'est une arme puissante pour le combat spirituel.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_3->id,
            'question' => 'Comment la Parole de Dieu nous sanctifie-t-elle selon Jean 17:17 ?',
            'options' => [
                'Par la magie',
                'Par la vérité',
                'Par les rituels',
                'Par les traditions',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Sanctifie-les par Ta vérité : Ta Parole est la vérité. » C\'est la vérité de la Parole qui nous sanctifie.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 4.4 — Méditer et mémoriser la Parole
        // ═══════════════════════════════════════════════════════════
        $lecon4_4 = Lecon::create([
            'niveau_id' => $niveau4->id,
            'titre' => 'Méditer et mémoriser la Parole',
            'contenu' => "**Méditer et mémoriser la Parole de Dieu transforme une vie.**\n\n" .
                "Lire la Bible une fois ne suffit pas. Pour vraiment être transformé, il faut **méditer** la Parole (y réfléchir profondément) et la **mémoriser** (la garder dans son cœur).\n\n" .
                "📖 **LA MÉDITATION :**\n\n" .
                "Méditer, c'est prendre un verset ou un passage et y réfléchir longuement, le laisser pénétrer notre cœur et notre esprit.\n\n" .
                "📖 **Psaume 1:2-3** — « Mais qui trouve son plaisir dans la loi de l'Éternel, et qui la médite jour et nuit ! Il est comme un arbre planté près d'un courant d'eau, qui donne son fruit en sa saison, et dont le feuillage ne se flétrit point : tout ce qu'il fait lui réussit. »\n\n" .
                "Celui qui médite la Parole est comme un arbre planté près d'un courant d'eau : il est stable, fructueux, et ne se dessèche pas.\n\n" .
                "📖 **Josué 1:8** — « Que ce livre de la loi ne s'éloigne point de ta bouche ; médite-le jour et nuit, pour agir fidèlement selon tout ce qui y est écrit ; car c'est alors que tu auras du succès dans tes entreprises, c'est alors que tu réussiras. »\n\n" .
                "📖 **Comment méditer concrètement :**\n\n" .
                "1. **Choisis un verset** — Prends un verset qui te parle\n" .
                "2. **Lis-le plusieurs fois** — Lentement, attentivement\n" .
                "3. **Répète-le** — Dis-le à voix haute\n" .
                "4. **Pose-toi des questions** — Que dit ce verset ? Que signifie-t-il pour moi ?\n" .
                "5. **Prie à travers ce verset** — Transforme-le en prière\n" .
                "6. **Applique-le** — Comment vais-je vivre ce verset aujourd'hui ?\n\n" .
                "📖 **LA MÉMORISATION :**\n\n" .
                "Mémoriser la Parole, c'est la garder dans son cœur pour pouvoir y revenir à tout moment.\n\n" .
                "📖 **Psaume 119:11** — « Je serre Ta parole dans mon cœur, afin de ne pas pécher contre Toi. »\n\n" .
                "Quand la Parole est dans ton cœur, le Saint-Esprit peut te la rappeler au moment où tu en as besoin.\n\n" .
                "📖 **Les avantages de mémoriser la Parole :**\n\n" .
                "• **Résister à la tentation** — Jésus a utilisé la Parole pour vaincre Satan (Matthieu 4:1-11)\n" .
                "• **Avoir la paix** — Dans les moments difficiles, la Parole te rassure\n" .
                "• **Témoigner efficacement** — Tu peux partager la Parole aux autres\n" .
                "• **Prier avec puissance** — Tu pries avec les mots de Dieu Lui-même\n" .
                "• **Être guidé** — Le Saint-Esprit te rappelle les versets au bon moment\n\n" .
                "📖 **Comment mémoriser un verset :**\n\n" .
                "1. **Écris-le** — Sur un papier, un carnet, ton téléphone\n" .
                "2. **Lis-le à voix haute** — Plusieurs fois par jour\n" .
                "3. **Découpe-le en morceaux** — Mémorise phrase par phrase\n" .
                "4. **Répète-le** — Le matin, le midi, le soir (Deutéronome 6:7)\n" .
                "5. **Révise régulièrement** — Revois les versets que tu as appris\n" .
                "6. **Utilise-le** — Récite-le dans tes prières, dans tes conversations\n\n" .
                "📖 **10 versets à mémoriser en premier :**\n" .
                "1. Jean 3:16 — L\'amour de Dieu\n" .
                "2. Romains 3:23 — Tous ont péché\n" .
                "3. Romains 6:23 — Le salaire du péché\n" .
                "4. Romains 10:9 — Confesser et croire\n" .
                "5. Éphésiens 2:8-9 — Sauvés par grâce\n" .
                "6. 1 Jean 1:9 — Confesser nos péchés\n" .
                "7. Philippiens 4:13 — Je puis tout par Christ\n" .
                "8. Psaume 23:1 — L\'Éternel est mon berger\n" .
                "9. Matthieu 6:33 — Cherchez premièrement le royaume\n" .
                "10. Josué 1:9 — Sois fort et courageux\n\n" .
                "💡 **À retenir** : La Parole de Dieu est un trésor. Plus tu la médites et la mémorises, plus tu deviens fort spirituellement, plus tu résistes au mal, et plus tu portes du fruit pour Dieu.\n\n" .
                "⚠️ **Un conseil** : Commence petit. Mémorise **1 verset par semaine**. En un an, tu auras 52 versets dans ton cœur !\n\n" .
                "🙏 **Prière** : « Seigneur, donne-moi le désir de méditer Ta Parole jour et nuit. Aide-moi à la mémoriser et à la garder dans mon cœur. Que Ta Parole soit ma force, ma lumière, et ma joie. Amen. »",
            'versets_cles' => 'Psaume 1:2-3, Josué 1:8, Psaume 119:11, Matthieu 4:1-11, Deutéronome 6:7',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon4_4->id,
            'question' => 'À quoi ressemble celui qui médite la Parole de Dieu selon Psaume 1:2-3 ?',
            'options' => [
                'À un rocher',
                'À un arbre planté près d\'un courant d\'eau',
                'À une fleur',
                'À un désert',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Celui qui médite la Parole est comme un arbre planté près d\'un courant d\'eau : stable, fructueux, jamais desséché.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_4->id,
            'question' => 'Pourquoi devons-nous serrer la Parole dans notre cœur selon Psaume 119:11 ?',
            'options' => [
                'Pour nous vanter',
                'Afin de ne pas pécher contre Dieu',
                'Pour gagner de l\'argent',
                'Pour être célèbre',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le psalmiste dit : « Je serre Ta parole dans mon cœur, afin de ne pas pécher contre Toi. » La Parole mémorisée nous aide à résister à la tentation.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_4->id,
            'question' => 'Comment Jésus a-t-Il vaincu les tentations de Satan dans le désert ?',
            'options' => [
                'Par Sa force physique',
                'En citant la Parole de Dieu',
                'En fuyant',
                'En priant 40 jours',
            ],
            'bonne_reponse' => 1,
            'explication' => 'À chaque tentation, Jésus a répondu : « Il est écrit... » Il a utilisé la Parole de Dieu pour vaincre Satan (Matthieu 4:1-11).',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_4->id,
            'question' => 'Que promet Dieu à celui qui médite Sa Parole jour et nuit selon Josué 1:8 ?',
            'options' => [
                'La richesse',
                'Le succès et la réussite',
                'La santé',
                'La sagesse humaine',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Dieu promet : « C\'est alors que tu auras du succès dans tes entreprises, c\'est alors que tu réussiras. » La méditation de la Parole mène au vrai succès.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon4_4->id,
            'question' => 'Selon Deutéronome 6:7, quand devons-nous parler de la Parole de Dieu ?',
            'options' => [
                'Uniquement le dimanche',
                'En étant assis, en marchant, en se couchant et en se levant',
                'Uniquement à l\'église',
                'Une fois par mois',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Deutéronome 6:7 nous encourage à parler de la Parole « quand tu seras assis dans ta maison, quand tu iras par le chemin, quand tu te coucheras, et quand tu te lèveras » — c\'est-à-dire tout le temps.',
            'points' => 1,
        ]);

        $this->command->info('✅ Niveau 3 (La Prière) + Niveau 4 (La Parole de Dieu) créés');
    }
}