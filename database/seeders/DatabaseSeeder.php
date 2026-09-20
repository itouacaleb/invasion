<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Uniquement les seeders SAFES
        $this->call([
            ParcoursSeeder::class,  // ✅ Safe (utilise create())
        ]);
    }
}