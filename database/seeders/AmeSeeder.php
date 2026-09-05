<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AmeSeeder extends Seeder
{
    public function run(): void
    {
        $campagne = DB::table('campagnes')->where('nom', 'like', 'Invasion%')->first();

        if (!$campagne) {
            dump('❌ Campagne Invasion introuvable, exécute CampagneSeeder d\'abord.');
            return;
        }

        $ames = [
            // ========== ANCIENNES ÂMES (2024) ==========
            [
                'nom' => 'Jean Kimbangu',
                'telephone' => '242054512345',
                'email' => 'jean.kimbangu@example.com',
                'sexe' => 'H',
                'age' => 32,
                'adresse' => 'Avenue Matsoua, Bacongo',
                'date_conversion' => Carbon::create(2024, 1, 20),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2694400,
                'longitude' => 15.2711100,
                'assigne_a' => 3,
                'cellule_id' => 1,
                'image' => 'https://images.pexels.com/photos/14931950/pexels-photo-14931950.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2024, 2, 18),
                'created_at' => Carbon::create(2024, 1, 15), // ✅ Ancienne (janvier 2024)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Marie Loubaki',
                'telephone' => '242055523456',
                'email' => 'marie.loubaki@example.com',
                'sexe' => 'F',
                'age' => 28,
                'adresse' => 'Rue Loutassi, Bacongo',
                'date_conversion' => Carbon::create(2024, 2, 15),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Rédication',
                'latitude' => -4.2700000,
                'longitude' => 15.2720000,
                'assigne_a' => 4,
                'cellule_id' => 1,
                'image' => 'https://images.pexels.com/photos/7372390/pexels-photo-7372390.jpeg',
                'suivi' => false,
                'derniere_interaction' => Carbon::create(2024, 2, 20),
                'created_at' => Carbon::create(2024, 2, 10), // ✅ Ancienne (février 2024)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Marcelline Nkounkou',
                'telephone' => '242066634567',
                'email' => 'marcelline.nkounkou@example.com',
                'sexe' => 'F',
                'age' => 45,
                'adresse' => 'Avenue Foch, Poto-Poto',
                'date_conversion' => Carbon::create(2024, 3, 5),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2638900,
                'longitude' => 15.2791700,
                'assigne_a' => 2,
                'cellule_id' => 2,
                'image' => 'https://images.pexels.com/photos/16748461/pexels-photo-16748461.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2024, 3, 7),
                'created_at' => Carbon::create(2024, 3, 1), // ✅ Ancienne (mars 2024)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Grâce Okombi',
                'telephone' => '242078856789',
                'email' => 'grace.okombi@example.com',
                'sexe' => 'F',
                'age' => 35,
                'adresse' => 'Quartier 15, Talangaï',
                'date_conversion' => Carbon::create(2024, 4, 10),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Renouvellement',
                'latitude' => -4.2200000,
                'longitude' => 15.3000000,
                'assigne_a' => 6,
                'cellule_id' => 4,
                'image' => 'https://images.pexels.com/photos/7088971/pexels-photo-7088971.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2024, 5, 1),
                'created_at' => Carbon::create(2024, 4, 5), // ✅ Ancienne (avril 2024)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Jonathan Itoua',
                'telephone' => '242079967890',
                'email' => 'jonathan.itoua@example.com',
                'sexe' => 'H',
                'age' => 19,
                'adresse' => 'Quartier 20, Talangaï',
                'date_conversion' => Carbon::create(2024, 5, 12),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2250000,
                'longitude' => 15.3050000,
                'assigne_a' => 7,
                'cellule_id' => 4,
                'image' => 'https://images.pexels.com/photos/15451658/pexels-photo-15451658.jpeg',
                'suivi' => false,
                'derniere_interaction' => Carbon::create(2024, 5, 18),
                'created_at' => Carbon::create(2024, 5, 10), // ✅ Ancienne (mai 2024)
                'updated_at' => now(),
            ],

            // ========== NOUVELLES ÂMES (2026) ==========
            [
                'nom' => 'Esther Mboungou',
                'telephone' => '242081234567',
                'email' => 'esther.mboungou@example.com',
                'sexe' => 'F',
                'age' => 24,
                'adresse' => 'Avenue de la Paix, Bacongo',
                'date_conversion' => Carbon::create(2026, 8, 15),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2680000,
                'longitude' => 15.2700000,
                'assigne_a' => 3,
                'cellule_id' => 1,
                'image' => 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2026, 8, 20),
                'created_at' => Carbon::create(2026, 8, 10), // ✅ Nouvelle (août 2026)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Samuel Nzila',
                'telephone' => '242082345678',
                'email' => 'samuel.nzila@example.com',
                'sexe' => 'H',
                'age' => 27,
                'adresse' => 'Quartier Massamba, Talangaï',
                'date_conversion' => Carbon::create(2026, 9, 1),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2220000,
                'longitude' => 15.3020000,
                'assigne_a' => 6,
                'cellule_id' => 4,
                'image' => 'https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2026, 9, 5),
                'created_at' => Carbon::create(2026, 9, 1), // ✅ Nouvelle (septembre 2026)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Ruth Loukaka',
                'telephone' => '242083456789',
                'email' => 'ruth.loukaka@example.com',
                'sexe' => 'F',
                'age' => 30,
                'adresse' => 'Avenue de l\'Indépendance, Poto-Poto',
                'date_conversion' => Carbon::create(2026, 9, 3),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Rédication',
                'latitude' => -4.2640000,
                'longitude' => 15.2780000,
                'assigne_a' => 4,
                'cellule_id' => 2,
                'image' => 'https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg',
                'suivi' => false,
                'derniere_interaction' => Carbon::create(2026, 9, 4),
                'created_at' => Carbon::create(2026, 9, 2), // ✅ Nouvelle (septembre 2026)
                'updated_at' => now(),
            ],
            [
                'nom' => 'David Bantsimba',
                'telephone' => '242084567890',
                'email' => 'david.bantsimba@example.com',
                'sexe' => 'H',
                'age' => 22,
                'adresse' => 'Quartier 12, Ouenzé',
                'date_conversion' => Carbon::create(2026, 9, 4),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2670000,
                'longitude' => 15.2750000,
                'assigne_a' => 2,
                'cellule_id' => 3,
                'image' => 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2026, 9, 5),
                'created_at' => Carbon::create(2026, 9, 4), // ✅ Nouvelle (septembre 2026)
                'updated_at' => now(),
            ],
            [
                'nom' => 'Sarah Mavoungou',
                'telephone' => '242085678901',
                'email' => 'sarah.mavoungou@example.com',
                'sexe' => 'F',
                'age' => 18,
                'adresse' => 'Quartier 8, Bacongo',
                'date_conversion' => Carbon::create(2026, 9, 5),
                'campagne_id' => $campagne->id,
                'type_decision' => 'Première décision',
                'latitude' => -4.2710000,
                'longitude' => 15.2730000,
                'assigne_a' => 7,
                'cellule_id' => 1,
                'image' => 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg',
                'suivi' => true,
                'derniere_interaction' => Carbon::create(2026, 9, 5),
                'created_at' => Carbon::create(2026, 9, 5), // ✅ Nouvelle (septembre 2026)
                'updated_at' => now(),
            ],
        ];

        DB::table('ames')->insert($ames);
    }
}