<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = [

            [
                'nom' => 'Itoua Caleb',
                'email' => 'yvescalebitoua@gmail.com',
                'telephone' => '068731172',
                'password' => Hash::make('alexandre'),
                'role' => 'admin',
                'zone_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Jean Okombi',
                'email' => 'okombi@example.com',
                'telephone' => '064512345',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'zone_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Pasteur Nkounkou',
                'email' => 'nkounkou@example.com',
                'telephone' => '065523456',
                'password' => Hash::make('Encadreur@123'),
                'role' => 'encadreur',
                'zone_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Frère Mbemba',
                'email' => 'mbemba@example.com',
                'telephone' => '066534567',
                'password' => Hash::make('Encadreur@123'),
                'role' => 'encadreur',
                'zone_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Soeur Loubaki',
                'email' => 'loubaki@example.com',
                'telephone' => '067545678',
                'password' => Hash::make('Evangeliste@123'),
                'role' => 'evangeliste',
                'zone_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'David Matsiona',
                'email' => 'matsiona@example.com',
                'telephone' => '068556789',
                'password' => Hash::make('Evangeliste@123'),
                'role' => 'evangeliste',
                'zone_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Sarah Bouanga',
                'email' => 'bouanga@example.com',
                'telephone' => '069567890',
                'password' => Hash::make('Evangeliste@123'),
                'role' => 'evangeliste',
                'zone_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Pasteur Itoua',
                'email' => 'itoua@example.com',
                'telephone' => '060578901',
                'password' => Hash::make('Encadreur@123'),
                'role' => 'encadreur',
                'zone_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        foreach ($users as $user) {

            User::create($user);

        }

        $this->createAdditionalUsers(10);
    }

    /**
     * Création d'utilisateurs supplémentaires
     */
    protected function createAdditionalUsers(int $count): void
    {
        $prenoms = [
            'Jean',
            'Marie',
            'Pierre',
            'Paul',
            'Jacques',
            'Lucie',
            'Ange',
            'David'
        ];

        $noms = [
            'Okombi',
            'Nkounkou',
            'Mbemba',
            'Loubaki',
            'Matsiona',
            'Bouanga',
            'Itoua',
            'Kimbangu'
        ];

        $roles = [
            'evangeliste',
            'encadreur'
        ];

        $zones = [1,2,3];

        for ($i = 1; $i <= $count; $i++) {

            $prenom = $prenoms[array_rand($prenoms)];
            $nom = $noms[array_rand($noms)];

            User::create([

                'nom' => $prenom.' '.$nom,

                'email' => strtolower($prenom).'.'.strtolower($nom).$i.'@example.com',

                'telephone' => '061'.str_pad($i,6,'0',STR_PAD_LEFT),

                'password' => Hash::make('Password123'),

                'role' => $roles[array_rand($roles)],

                'zone_id' => $zones[array_rand($zones)],

                'created_at' => now(),

                'updated_at' => now(),

            ]);
        }
    }
}