<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CelluleSeeder extends Seeder
{
    public function run(): void
    {
        $cellules = [
            // Bacongo (zone_id: 1)
            ['nom' => 'Cellule Bethel', 'zone_id' => 1, 'responsable_id' => 2],
            ['nom' => 'Cellule Sion', 'zone_id' => 1, 'responsable_id' => 4],

            // Poto-Poto (zone_id: 2)
            ['nom' => 'Cellule Emmanuel', 'zone_id' => 2, 'responsable_id' => 3],
            ['nom' => 'Cellule Jéricho', 'zone_id' => 2, 'responsable_id' => 5],

            // Moungali (zone_id: 3) ✅
            ['nom' => 'Cellule Béthel-Moungali', 'zone_id' => 3, 'responsable_id' => 7],
            ['nom' => 'Cellule des Jeunes Elus', 'zone_id' => 3, 'responsable_id' => 6],

            // Ouenzé (zone_id: 4)
            ['nom' => 'Cellule Shalom', 'zone_id' => 4, 'responsable_id' => null],

            // Talangaï (zone_id: 5) ✅
            ['nom' => 'Cellule Talangaï-Centre', 'zone_id' => 5, 'responsable_id' => null],

            // Makélékélé (zone_id: 6)
            ['nom' => 'Cellule des Victorieux', 'zone_id' => 6, 'responsable_id' => null],
        ];

        DB::table('cellules')->insert($cellules);
    }
}