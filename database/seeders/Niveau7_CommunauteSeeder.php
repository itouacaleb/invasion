<?php

namespace Database\Seeders;

use App\Models\Niveau;
use App\Models\Lecon;
use App\Models\Question;
use Illuminate\Database\Seeder;

class Niveau7_CommunauteSeeder extends Seeder
{
    public function run(): void
    {
        // ═══════════════════════════════════════════════════════════
        // NIVEAU 7 : LA COMMUNAUTÉ
        // ═══════════════════════════════════════════════════════════
        $niveau7 = Niveau::create([
            'nom' => 'La Communauté',
            'description' => 'Vivre sa foi au sein de la famille spirituelle',
            'ordre' => 7,
            'icone' => '👥',
            'couleur' => '#0B1465',
            'is_actif' => true,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 7.1 — L'importance de l'Église
        // ═══════════════════════════════════════════════════════════
        $lecon7_1 = Lecon::create([
            'niveau_id' => $niveau7->id,
            'titre' => 'L\'importance de l\'Église',
            'contenu' => "**L'Église n'est pas un bâtiment, c'est une famille.**\n\n" .
                "Beaucoup de gens pensent que l'Église est un bâtiment, une institution religieuse, ou une organisation humaine. Mais la Bible nous révèle que l'Église est bien plus que cela : c'est le **corps de Christ**, une **famille spirituelle**, composée de tous ceux qui ont cru en Jésus.\n\n" .
                "📖 **Matthieu 16:18** — « Et moi, Je te dis que tu es Pierre, et que sur cette pierre Je bâtirai Mon Église, et que les portes du séjour des morts ne prévaudront point contre elle. »\n\n" .
                "📖 **Ce que l'Église est :**\n\n" .
                "1️⃣ **Le corps de Christ**\n" .
                "📖 **1 Corinthiens 12:27** — « Vous êtes le corps de Christ, et vous êtes chacun un de ses membres. »\n\n" .
                "Comme le corps humain a plusieurs membres, l'Église a plusieurs membres, chacun avec un rôle différent. Nous sommes unis à Christ et unis les uns aux autres.\n\n" .
                "2️⃣ **La famille de Dieu**\n" .
                "📖 **Éphésiens 2:19** — « Ainsi donc, vous n'êtes plus des étrangers, ni des gens du dehors ; mais vous êtes concitoyens des saints, gens de la maison de Dieu. »\n\n" .
                "Par la foi en Jésus, nous devenons enfants de Dieu et frères et sœurs les uns des autres.\n\n" .
                "3️⃣ **La maison de Dieu**\n" .
                "📖 **1 Timothée 3:15** — « ... afin que tu saches, si je tarde, comment il faut se conduire dans la maison de Dieu, qui est l'Église du Dieu vivant, la colonne et l'appui de la vérité. »\n\n" .
                "4️⃣ **L'épouse de Christ**\n" .
                "📖 **Éphésiens 5:25-27** — « Christ a aimé l'Église, et S'est livré Lui-même pour elle. »\n\n" .
                "Jésus aime l'Église. Il S'est donné pour elle. Elle est Son épouse bien-aimée.\n\n" .
                "📖 **Pourquoi devons-nous faire partie d'une Église locale ?**\n\n" .
                "1️⃣ **Pour grandir spirituellement**\n" .
                "On ne grandit pas seul. La communauté nous encourage, nous enseigne, nous corrige.\n\n" .
                "📖 **Proverbes 27:17** — « Comme le fer aiguise le fer, ainsi un homme excite la colère d'un homme. »\n\n" .
                "2️⃣ **Pour être protégé**\n" .
                "Un chrétien isolé est une brebis seule face au loup. La communauté nous protège, nous soutient dans les épreuves.\n\n" .
                "📖 **Ecclésiaste 4:12** — « Si quelqu'un veut attaquer un homme seul, deux lui résisteront ; et la corde à trois fils ne se rompt pas facilement. »\n\n" .
                "3️⃣ **Pour servir**\n" .
                "Chaque membre a un don à utiliser pour édifier les autres.\n\n" .
                "📖 **1 Pierre 4:10** — « Comme de bons dispensateurs des diverses grâces de Dieu, que chacun de vous mette au service des autres le don qu'il a reçu. »\n\n" .
                "4️⃣ **Pour témoigner ensemble**\n" .
                "Ensemble, nous sommes plus forts pour témoigner de Jésus.\n\n" .
                "5️⃣ **Pour obéir à Dieu**\n" .
                "La Bible nous commande de ne pas abandonner notre assemblée.\n\n" .
                "📖 **Hébreux 10:24-25** — « N'abandonnons pas notre assemblée, comme c'est la coutume de quelques-uns ; mais exhortons-nous réciproquement, et cela d'autant plus que vous voyez s'approcher le jour. »\n\n" .
                "📖 **Les 4 piliers de la vie d'Église :**\n\n" .
                "📖 **Actes 2:42** — « Ils persévéraient dans l'enseignement des apôtres, dans la communion fraternelle, dans la fraction du pain, et dans les prières. »\n\n" .
                "• **L'enseignement** — Écouter et étudier la Parole\n" .
                "• **La communion** — Vivre en communauté, s'aimer, se soutenir\n" .
                "• **La fraction du pain** — Célébrer la Sainte Cène, se souvenir de Jésus\n" .
                "• **Les prières** — Prier ensemble\n\n" .
                "💡 **À retenir** : L'Église n'est pas optionnelle. Elle est la famille que Dieu nous a donnée pour grandir, être protégé, et servir. Ne sois pas un chrétien isolé.\n\n" .
                "⚠️ **Aucune église n'est parfaite** : L'Église est composée d'humains imparfaits. Il y aura des déceptions, des blessures. Mais ne renonce pas à l'Église à cause des hommes. Jésus aime l'Église, et Il veut que tu L'aimes aussi.\n\n" .
                "🙏 **Prière** : « Seigneur, merci pour l\'Église, ma famille spirituelle. Aide-moi à m\'engager fidèlement dans une communauté locale. Que je puisse grandir, servir, et être une bénédiction pour mes frères et sœurs. Aide-moi à aimer l\'Église comme Tu l\'aimes. Amen. »",
            'versets_cles' => 'Matthieu 16:18, 1 Corinthiens 12:27, Éphésiens 2:19, Hébreux 10:24-25, Actes 2:42',
            'ordre' => 1,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon7_1->id,
            'question' => 'Qu\'est-ce que l\'Église selon la Bible ?',
            'options' => [
                'Un bâtiment',
                'Le corps de Christ, une famille spirituelle',
                'Une organisation humaine',
                'Un parti politique',
            ],
            'bonne_reponse' => 1,
            'explication' => 'L\'Église n\'est pas un bâtiment, mais le corps de Christ. C\'est une famille spirituelle composée de tous ceux qui ont cru en Jésus.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_1->id,
            'question' => 'Selon 1 Corinthiens 12:27, que sommes-nous ?',
            'options' => [
                'Des étrangers',
                'Le corps de Christ et chacun un de ses membres',
                'Des spectateurs',
                'Des invités',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit : « Vous êtes le corps de Christ, et vous êtes chacun un de ses membres. » Chacun a un rôle à jouer.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_1->id,
            'question' => 'Que devons-nous faire selon Hébreux 10:24-25 ?',
            'options' => [
                'Abandonner notre assemblée',
                'Ne pas abandonner notre assemblée, mais nous exhorter',
                'Rester seuls',
                'Éviter les autres chrétiens',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Hébreux 10:25 nous encourage à ne pas abandonner notre assemblée, mais à nous exhorter réciproquement, surtout à l\'approche du jour de Dieu.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_1->id,
            'question' => 'Selon Actes 2:42, quels sont les 4 piliers de la vie d\'Église ?',
            'options' => [
                'Argent, célébrité, pouvoir, sagesse',
                'Enseignement, communion, fraction du pain, prières',
                'Chant, danse, jeûne, prédication',
                'Foi, espérance, charité, patience',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Les premiers chrétiens persévéraient dans 4 choses : l\'enseignement des apôtres, la communion fraternelle, la fraction du pain et les prières.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_1->id,
            'question' => 'Pourquoi est-il important de faire partie d\'une Église locale ?',
            'options' => [
                'Par obligation religieuse',
                'Pour grandir, être protégé, servir et obéir à Dieu',
                'Pour être vu des autres',
                'Par tradition',
            ],
            'bonne_reponse' => 1,
            'explication' => 'L\'Église nous aide à grandir spirituellement, nous protège, nous permet de servir, et nous aide à obéir au commandement de Dieu.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 7.2 — Le service et le don de soi
        // ═══════════════════════════════════════════════════════════
        $lecon7_2 = Lecon::create([
            'niveau_id' => $niveau7->id,
            'titre' => 'Le service et le don de soi',
            'contenu' => "**Servir, c'est aimer en action.**\n\n" .
                "Jésus a dit une chose surprenante à Ses disciples : « Si quelqu'un veut être le premier, il sera le dernier de tous et le serviteur de tous. » (Marc 9:35) Dans le royaume de Dieu, la grandeur se mesure au service, pas au pouvoir.\n\n" .
                "📖 **Marc 10:45** — « Car le Fils de l'homme est venu, non pour être servi, mais pour servir et donner Sa vie comme la rançon de plusieurs. »\n\n" .
                "📖 **L'exemple de Jésus : le lavement des pieds**\n\n" .
                "📖 **Jean 13:3-5** — « Jésus, sachant que le Père a remis toutes choses entre Ses mains... se leva de table, ôta Ses vêtements, et prit un linge, dont Il se ceignit. Ensuite Il versa de l'eau dans un bassin, et Il se mit à laver les pieds des disciples, et à les essuyer avec le linge dont Il était ceint. »\n\n" .
                "Jésus, le Maître, s'est abaissé pour laver les pieds de Ses disciples — une tâche réservée aux serviteurs les plus humbles. Il nous a donné l'exemple du service.\n\n" .
                "📖 **Pourquoi servir ?**\n\n" .
                "1️⃣ **Parce que Jésus a servi**\n" .
                "Le serviteur n'est pas plus grand que son Maître. Si Jésus a servi, nous devons servir.\n\n" .
                "📖 **Jean 13:14-15** — « Si donc Je vous ai lavé les pieds, Moi, le Seigneur et le Maître, vous devez aussi vous laver les pieds les uns aux autres ; car Je vous ai donné un exemple, afin que vous fassiez comme Je vous ai fait. »\n\n" .
                "2️⃣ **Parce que chaque chrétien a un don**\n" .
                "📖 **1 Pierre 4:10** — « Comme de bons dispensateurs des diverses grâces de Dieu, que chacun de vous mette au service des autres le don qu'il a reçu. »\n\n" .
                "3️⃣ **Parce que servir est une preuve d'amour**\n" .
                "📖 **Galates 5:13** — « Frères, vous avez été appelés à la liberté, seulement ne faites pas de cette liberté un prétexte de vivre selon la chair ; mais rendez-vous, par amour, serviteurs les uns des autres. »\n\n" .
                "4️⃣ **Parce que servir produit une récompense**\n" .
                "📖 **Matthieu 25:21** — « C'est bien, bon et fidèle serviteur ; tu as été fidèle en peu de choses, je t'établirai sur beaucoup. »\n\n" .
                "📖 **Comment servir concrètement ?**\n\n" .
                "• **À l'église** — Aider à l'accueil, au chant, à la sono, au nettoyage, au rangement\n" .
                "• **Dans la cellule** — Accueillir, préparer, organiser, encourager\n" .
                "• **Dans le quartier** — Visiter les malades, aider les nécessiteux\n" .
                "• **Au travail** — Travailler avec excellence, être honnête, aider ses collègues\n" .
                "• **Dans la famille** — Prendre soin des siens, aider son conjoint, ses enfants\n" .
                "• **Dans la prière** — Intercéder pour les autres\n\n" .
                "📖 **Les qualités d'un serviteur :**\n\n" .
                "• **Humilité** — Servir sans chercher la gloire\n" .
                "• **Fidélité** — Servir avec constance\n" .
                "• **Joie** — Servir avec plaisir\n" .
                "• **Disponibilité** — Servir quand il y a un besoin\n" .
                "• **Amour** — Servir les autres sincèrement\n\n" .
                "📖 **Le danger de servir pour la gloire personnelle :**\n\n" .
                "Jésus a averti contre les pharisiens qui faisaient tout pour être vus. Le vrai serviteur cherche la gloire de Dieu, pas la sienne.\n\n" .
                "📖 **Matthieu 6:1** — « Gardez-vous de pratiquer votre justice devant les hommes, pour être vus d'eux ; autrement, vous n'aurez point de récompense auprès de votre Père qui est dans les cieux. »\n\n" .
                "💡 **À retenir** : Servir, c'est aimer en action. C'est mettre ses dons et ses capacités au service des autres et de Dieu. Le vrai disciple est un serviteur.\n\n" .
                "⚠️ **Important** : Servir n'est pas toujours facile. Parfois on ne sera pas remercié, pas remarqué. Mais Dieu voit, et Il récompensera.\n\n" .
                "🙏 **Prière** : « Seigneur, apprends-moi à servir comme Tu as servi. Enlève de moi l\'orgueil et l\'égoïsme. Donne-moi un cœur de serviteur, qui aime les autres en actes et en vérité. Que je serve avec joie, fidélité et humilité, pour Ta gloire. Amen. »",
            'versets_cles' => 'Marc 10:45, Jean 13:3-5, Galates 5:13, 1 Pierre 4:10, Matthieu 25:21',
            'ordre' => 2,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon7_2->id,
            'question' => 'Pourquoi Jésus est-Il venu selon Marc 10:45 ?',
            'options' => [
                'Pour être servi',
                'Pour servir et donner Sa vie comme rançon',
                'Pour être célèbre',
                'Pour gouverner',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Le Fils de l\'homme est venu, non pour être servi, mais pour servir et donner Sa vie comme la rançon de plusieurs. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_2->id,
            'question' => 'Qu\'a fait Jésus lors du dernier repas pour donner l\'exemple du service ?',
            'options' => [
                'Il a fait un discours',
                'Il a lavé les pieds de Ses disciples',
                'Il a chanté',
                'Il a prié longtemps',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus, le Maître, a lavé les pieds de Ses disciples — une tâche réservée aux serviteurs les plus humbles — pour nous donner l\'exemple du service.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_2->id,
            'question' => 'Selon Galates 5:13, comment devons-nous utiliser notre liberté ?',
            'options' => [
                'Pour vivre selon la chair',
                'Pour nous rendre serviteurs les uns des autres par amour',
                'Pour faire ce que nous voulons',
                'Pour nous amuser',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit : « Rendez-vous, par amour, serviteurs les uns des autres. » Notre liberté en Christ doit servir à aimer et à servir les autres.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_2->id,
            'question' => 'Selon 1 Pierre 4:10, que devons-nous faire de nos dons ?',
            'options' => [
                'Les garder pour nous',
                'Les mettre au service des autres',
                'Les montrer à tout le monde',
                'Les vendre',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Pierre dit : « Que chacun de vous mette au service des autres le don qu\'il a reçu. » Les dons sont pour servir.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_2->id,
            'question' => 'Quelle est la récompense du serviteur fidèle selon Matthieu 25:21 ?',
            'options' => [
                'Des richesses',
                'Être établi sur beaucoup et entrer dans la joie du maître',
                'La célébrité',
                'Le repos',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Le maître dit au serviteur fidèle : « C\'est bien, bon et fidèle serviteur ; tu as été fidèle en peu de choses, je t\'établirai sur beaucoup ; entre dans la joie de ton maître. »',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 7.3 — L'unité entre frères
        // ═══════════════════════════════════════════════════════════
        $lecon7_3 = Lecon::create([
            'niveau_id' => $niveau7->id,
            'titre' => 'L\'unité entre frères',
            'contenu' => "**L'unité est un commandement et une bénédiction.**\n\n" .
                "Avant de mourir, Jésus a prié pour une chose très importante : que Ses disciples soient **unis**. L'unité n'est pas un luxe pour l'Église, c'est une **nécessité**.\n\n" .
                "📖 **Jean 17:20-21** — « Je ne prie pas pour eux seulement, mais encore pour ceux qui croiront en Moi par leur parole, afin que tous soient un, comme Toi, Père, Tu es en Moi, et comme Je suis en Toi, afin qu'eux aussi soient un en Nous, pour que le monde croie que Tu M'as envoyé. »\n\n" .
                "Jésus a prié pour notre unité. Il sait combien il est difficile de vivre ensemble en harmonie.\n\n" .
                "📖 **Le Psaume 133:1** — « Voici, oh ! qu'il est agréable, qu'il est doux pour des frères de demeurer ensemble ! »\n\n" .
                "L'unité est belle et agréable. Elle attire la bénédiction de Dieu.\n\n" .
                "📖 **Pourquoi l'unité est-elle importante ?**\n\n" .
                "1️⃣ **Elle glorifie Dieu**\n" .
                "Quand nous sommes unis, Dieu est glorifié.\n\n" .
                "2️⃣ **Elle témoigne au monde**\n" .
                "📖 **Jean 13:35** — « À ceci tous connaîtront que vous êtes Mes disciples, si vous avez de l'amour les uns pour les autres. »\n\n" .
                "Le monde regarde l'Église. Notre unité est un témoignage puissant.\n\n" .
                "3️⃣ **Elle attire la bénédiction**\n" .
                "📖 **Psaume 133:3** — « C'est là que l'Éternel donne la bénédiction, la vie pour toujours. »\n\n" .
                "4️⃣ **Elle nous fortifie**\n" .
                "Unis, nous sommes plus forts. Divisés, nous sommes vulnérables.\n\n" .
                "📖 **Les obstacles à l'unité :**\n\n" .
                "• **L'orgueil** — Chacun pense avoir raison\n" .
                "• **Les préférences** — On veut imposer ses goûts\n" .
                "• **Les commérages** — On parle mal des autres\n" .
                "• **Les divisions** — On forme des clans\n" .
                "• **Le manque de pardon** — On garde des rancunes\n" .
                "• **L'égoïsme** — On pense d'abord à soi\n\n" .
                "📖 **Comment préserver l'unité ?**\n\n" .
                "1️⃣ **Par l'humilité**\n" .
                "📖 **Philippiens 2:3** — « Ne faites rien par esprit de parti ou par vaine gloire, mais que l'humilité vous fasse regarder les autres comme étant au-dessus de vous-mêmes. »\n\n" .
                "2️⃣ **Par l'amour**\n" .
                "📖 **Colossiens 3:14** — « Mais par-dessus toutes ces choses revêtez-vous de l'amour, qui est le lien de la perfection. »\n\n" .
                "3️⃣ **Par le pardon**\n" .
                "📖 **Éphésiens 4:32** — « Soyez bons les uns envers les autres, compatissants, vous pardonnant réciproquement. »\n\n" .
                "4️⃣ **Par la paix**\n" .
                "📖 **Romains 12:18** — « S'il est possible, autant que cela dépend de vous, soyez en paix avec tous les hommes. »\n\n" .
                "5️⃣ **Par la prière commune**\n" .
                "Quand nous prions ensemble, nos cœurs s'unissent.\n\n" .
                "📖 **L'unité dans la diversité :**\n\n" .
                "L'unité ne signifie pas l'uniformité. Nous sommes différents, avec des dons et des personnalités différentes, mais nous sommes unis dans le même Christ.\n\n" .
                "📖 **1 Corinthiens 12:12** — « Car, comme le corps est un et a plusieurs membres, et comme tous les membres du corps, malgré leur nombre, ne forment qu'un seul corps, ainsi en est-il de Christ. »\n\n" .
                "💡 **À retenir** : L'unité est un commandement, une bénédiction, et un témoignage. Cherchons à préserver l'unité de l'Esprit par le lien de la paix.\n\n" .
                "⚠️ **Important** : Préserver l'unité ne signifie pas fermer les yeux sur le péché. Il y a des cas où il faut confronter le péché avec amour. Mais la plupart des conflits viennent de choses mineures qu'on transforme en montagnes.\n\n" .
                "📖 **Éphésiens 4:3** — « Vous efforçant de conserver l'unité de l'Esprit par le lien de la paix. »\n\n" .
                "🙏 **Prière** : « Seigneur, aide-moi à préserver l\'unité dans Ton Église. Donne-moi un cœur humble, aimant, prêt à pardonner. Enlève de moi l\'orgueil et l\'égoïsme. Que je sois un artisan de paix, pas un semeur de division. Amen. »",
            'versets_cles' => 'Jean 17:20-21, Psaume 133:1-3, Philippiens 2:3, Éphésiens 4:3, Colossiens 3:14',
            'ordre' => 3,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon7_3->id,
            'question' => 'Pour quoi Jésus a-t-Il prié dans Jean 17:21 ?',
            'options' => [
                'Pour que Ses disciples soient riches',
                'Pour que Ses disciples soient unis',
                'Pour qu\'ils soient célèbres',
                'Pour qu\'ils vivent longtemps',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a prié : « Afin que tous soient un, comme Toi, Père, Tu es en Moi... afin qu\'eux aussi soient un en Nous. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_3->id,
            'question' => 'Selon Jean 13:35, à quoi le monde reconnaîtra-t-il que nous sommes disciples de Jésus ?',
            'options' => [
                'À nos miracles',
                'À notre amour les uns pour les autres',
                'À nos richesses',
                'À nos prières',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « À ceci tous connaîtront que vous êtes Mes disciples, si vous avez de l\'amour les uns pour les autres. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_3->id,
            'question' => 'Selon Philippiens 2:3, quelle attitude devons-nous avoir ?',
            'options' => [
                'Faire tout par vaine gloire',
                'L\'humilité, regardant les autres comme supérieurs à nous-mêmes',
                'Chercher le premier rang',
                'Penser d\'abord à soi',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit : « Ne faites rien par esprit de parti ou par vaine gloire, mais que l\'humilité vous fasse regarder les autres comme étant au-dessus de vous-mêmes. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_3->id,
            'question' => 'Selon Colossiens 3:14, qu\'est-ce qui est le lien de la perfection ?',
            'options' => [
                'La richesse',
                'L\'amour',
                'La sagesse',
                'La force',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Paul dit : « Mais par-dessus toutes ces choses revêtez-vous de l\'amour, qui est le lien de la perfection. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_3->id,
            'question' => 'L\'unité dans l\'Église signifie :',
            'options' => [
                'Être tous identiques',
                'Être unis malgré nos différences',
                'Penser tous la même chose',
                'Avoir les mêmes dons',
            ],
            'bonne_reponse' => 1,
            'explication' => 'L\'unité ne signifie pas l\'uniformité. Nous sommes différents, avec des dons et des personnalités différentes, mais unis dans le même Christ.',
            'points' => 1,
        ]);

        // ═══════════════════════════════════════════════════════════
        // LEÇON 7.4 — La mission
        // ═══════════════════════════════════════════════════════════
        $lecon7_4 = Lecon::create([
            'niveau_id' => $niveau7->id,
            'titre' => 'La mission',
            'contenu' => "**Chaque disciple est un missionnaire.**\n\n" .
                "Beaucoup pensent que la mission est réservée aux missionnaires envoyés en pays lointains. Mais la Bible nous montre que **chaque disciple** est appelé à être un missionnaire, là où Dieu l'a placé.\n\n" .
                "📖 **Matthieu 28:18-20** — « Jésus S'approcha, et leur parla ainsi : Tout pouvoir M'a été donné dans le ciel et sur la terre. Allez, faites de toutes les nations des disciples, les baptisant au nom du Père, du Fils et du Saint-Esprit, et enseignez-leur à observer tout ce que Je vous ai prescrit. Et voici, Je suis avec vous tous les jours, jusqu'à la fin du monde. »\n\n" .
                "C'est le **mandat missionnaire** : aller, faire des disciples, baptiser, enseigner. C'est pour TOUS les disciples.\n\n" .
                "📖 **Les 4 composantes du mandat missionnaire :**\n\n" .
                "1️⃣ **ALLER** — Sortir de notre zone de confort\n" .
                "Nous ne devons pas attendre que les gens viennent à nous. Nous devons aller vers eux.\n\n" .
                "2️⃣ **FAIRE DES DISCIPLES** — Pas seulement des convertis\n" .
                "Un converti a dit « oui » à Jésus une fois. Un disciple marche avec Jésus toute sa vie.\n\n" .
                "3️⃣ **BAPTISER** — Marquer l'engagement public\n" .
                "Le baptême est l'étape d'obéissance qui suit la conversion.\n\n" .
                "4️⃣ **ENSEIGNER** — Former dans la Parole\n" .
                "Le disciple doit grandir dans la connaissance et l'obéissance à la Parole de Dieu.\n\n" .
                "📖 **Le champ missionnaire :**\n\n" .
                "📖 **Actes 1:8** — « Mais vous recevrez une puissance, le Saint-Esprit survenant sur vous, et vous serez Mes témoins à Jérusalem, dans toute la Judée, dans la Samarie, et jusqu'aux extrémités de la terre. »\n\n" .
                "Ce verset nous montre **4 cercles** de mission :\n\n" .
                "• **Jérusalem** — Notre cercle proche (famille, voisins, amis)\n" .
                "• **Judée** — Notre région (quartier, ville)\n" .
                "• **Samarie** — Les personnes différentes de nous (autres cultures, autres milieux)\n" .
                "• **Extrémités de la terre** — Les nations lointaines\n\n" .
                "Nous sommes tous appelés à commencer par notre **Jérusalem** — notre entourage immédiat.\n\n" .
                "📖 **Comment être un missionnaire là où nous sommes ?**\n\n" .
                "1️⃣ **Prier pour les perdus** — Faire une liste de personnes à sauver\n" .
                "2️⃣ **Vivre une vie cohérente** — Que notre témoignage soit crédible\n" .
                "3️⃣ **Servir les autres** — L'amour en action ouvre les cœurs\n" .
                "4️⃣ **Partager sa foi** — Saisir les occasions, avec sagesse et respect\n" .
                "5️⃣ **Inviter à l'église** — Faire découvrir la communauté chrétienne\n" .
                "6️⃣ **Accompagner les nouveaux** — Aider les nouveaux convertis à grandir\n\n" .
                "📖 **Les obstacles à la mission :**\n\n" .
                "• **La peur du rejet** — Dieu nous donne un Esprit de force (2 Timothée 1:7)\n" .
                "• **Le manque de temps** — Nous avons toujours le temps pour ce qui est important\n" .
                "• **Le manque d'amour pour les perdus** — Demandons à Dieu Son cœur pour eux\n" .
                "• **Le manque de foi** — Croyons que Dieu peut sauver n'importe qui\n" .
                "• **Le confort** — Sortons de notre zone de confort\n\n" .
                "📖 **La promesse de Jésus :**\n\n" .
                "📖 **Matthieu 28:20** — « Et voici, Je suis avec vous tous les jours, jusqu'à la fin du monde. »\n\n" .
                "Nous ne sommes pas seuls dans la mission. Jésus est avec nous tous les jours.\n\n" .
                "📖 **La récompense de la mission :**\n\n" .
                "📖 **Daniel 12:3** — « Ceux qui auront été intelligents brilleront comme la splendeur du ciel, et ceux qui auront enseigné la justice à la multitude brilleront comme les étoiles, à toujours et à perpétuité. »\n\n" .
                "Ceux qui amènent des âmes à Christ brillent pour l'éternité.\n\n" .
                "💡 **À retenir** : Chaque disciple est un missionnaire. La mission n'est pas réservée à une élite. Elle est pour toi, là où tu vis, avec les personnes que tu connais. Commence par ton Jérusalem.\n\n" .
                "⚠️ **Important** : La mission n'est pas de forcer les gens à croire. C'est de **partager** avec amour, respect et sagesse. C'est Dieu qui convainc, pas nous.\n\n" .
                "📖 **1 Corinthiens 3:6** — « J'ai planté, Apollos a arrosé, mais Dieu a fait croître. »\n\n" .
                "🙏 **Prière** : « Seigneur, fais de moi un missionnaire là où Tu m\'as placé. Donne-moi Ton cœur pour les perdus, du courage pour témoigner, et de la sagesse pour partager l\'Évangile avec amour. Utilise-moi pour amener des âmes à Toi. Que ma vie soit un témoignage vivant de Ton amour. Amen. »",
            'versets_cles' => 'Matthieu 28:18-20, Actes 1:8, Daniel 12:3, 1 Corinthiens 3:6, 2 Timothée 1:7',
            'ordre' => 4,
            'duree_minutes' => 15,
        ]);

        Question::create([
            'lecon_id' => $lecon7_4->id,
            'question' => 'Qu\'a commandé Jésus à Ses disciples dans Matthieu 28:19 ?',
            'options' => [
                'De rester chez eux',
                'D\'aller et de faire de toutes les nations des disciples',
                'De prier uniquement',
                'De jeûner 40 jours',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a dit : « Allez, faites de toutes les nations des disciples, les baptisant au nom du Père, du Fils et du Saint-Esprit. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_4->id,
            'question' => 'Selon Actes 1:8, où devons-nous être témoins de Jésus ?',
            'options' => [
                'Uniquement à Jérusalem',
                'Uniquement dans notre pays',
                'À Jérusalem, en Judée, en Samarie, et jusqu\'aux extrémités de la terre',
                'Uniquement dans notre église',
            ],
            'bonne_reponse' => 2,
            'explication' => 'Jésus a dit que nous serions Ses témoins à Jérusalem (notre entourage immédiat), en Judée (notre région), en Samarie (les personnes différentes de nous), et jusqu\'aux extrémités de la terre.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_4->id,
            'question' => 'Quelle est la différence entre un converti et un disciple ?',
            'options' => [
                'Aucune différence',
                'Un converti a dit oui une fois, un disciple marche avec Jésus toute sa vie',
                'Le converti est meilleur',
                'Le disciple est plus âgé',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Un converti a dit « oui » à Jésus une fois. Un disciple marche avec Jésus toute sa vie, grandit, et fait d\'autres disciples.',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_4->id,
            'question' => 'Que promet Jésus à Ses disciples à la fin du mandat missionnaire ?',
            'options' => [
                'La richesse',
                'Sa présence avec eux tous les jours',
                'La célébrité',
                'La santé',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Jésus a promis : « Et voici, Je suis avec vous tous les jours, jusqu\'à la fin du monde. »',
            'points' => 1,
        ]);

        Question::create([
            'lecon_id' => $lecon7_4->id,
            'question' => 'Que dit Daniel 12:3 sur la récompense de ceux qui amènent des âmes à Christ ?',
            'options' => [
                'Ils seront riches',
                'Ils brilleront comme les étoiles, à toujours et à perpétuité',
                'Ils seront célèbres',
                'Ils seront puissants',
            ],
            'bonne_reponse' => 1,
            'explication' => 'Daniel 12:3 dit : « Ceux qui auront enseigné la justice à la multitude brilleront comme les étoiles, à toujours et à perpétuité. »',
            'points' => 1,
        ]);

        $this->command->info('✅ Niveau 7 (La Communauté) créé');
        $this->command->info('🎉 Le parcours spirituel complet est maintenant terminé !');
    }
}