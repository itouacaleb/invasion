<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CampagneSeeder extends Seeder
{
    public function run(): void
    {
        $year = date('Y');

        DB::table('campagnes')->insert([
            'nom' => 'Invasion ' . $year,
            'date_debut' => Carbon::create($year, 1, 15),
            'date_fin' => Carbon::create($year, 12, 31), // ✅ Modifié : fin décembre
            'zone_id' => 1,
            'description' => 'Campagne Invasion des Âmes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}