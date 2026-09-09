<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            // ✅ 1. Itoua Caleb - Admin
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

            // ✅ 2. Ilitch Edmet - Evangeliste
            [
                'nom' => 'Ilitch Edmet',
                'email' => 'ilitch.edmet@example.com',
                'telephone' => '242068347182',
                'password' => Hash::make('Evangeliste@123'),
                'role' => 'evangeliste',
                'zone_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ✅ 3. Dykoka Ngolo Yannick - Admin (Pasteur)
            [
                'nom' => 'Dykoka Ngolo Yannick',
                'email' => 'yannick.dykoka@example.com',
                'telephone' => '242060578901',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'zone_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // ✅ Supprimer la création d'utilisateurs supplémentaires
        // $this->createAdditionalUsers(10);
    }

    /**
     * Création d'utilisateurs supplémentaires (désactivée)
     */
    protected function createAdditionalUsers(int $count): void
    {
        // Désactivé pour garder seulement les 3 utilisateurs principaux
    }
}