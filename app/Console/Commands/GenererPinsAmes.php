<?php

namespace App\Console\Commands;

use App\Models\Ame;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenererPinsAmes extends Command
{
    protected $signature = 'ames:generer-pins {--force : Force la régénération même si le PIN existe déjà}';
    protected $description = 'Génère un PIN par défaut (00000) pour les âmes qui n\'en ont pas encore';

    public function handle()
    {
        $this->info('🔍 Recherche des âmes sans PIN...');
        $this->newLine();

        $query = Ame::query();

        // ✅ Par défaut : uniquement les âmes sans PIN
        if (!$this->option('force')) {
            $query->whereNull('password');
        }

        $ames = $query->get();
        $total = $ames->count();

        if ($total === 0) {
            $this->info('✅ Aucune âme à traiter. Toutes les âmes ont déjà un PIN.');
            return 0;
        }

        $this->info("📋 {$total} âme(s) trouvée(s) à traiter.");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $traitees = 0;
        foreach ($ames as $ame) {
            $ame->update([
                'password' => Hash::make('00000'),
                'pin_modifie' => false,
            ]);
            $traitees++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("✅ {$traitees} âme(s) traitée(s) avec succès !");
        $this->newLine();
        $this->line('📢 <fg=yellow>RAPPEL :</fg=yellow> Le PIN par défaut est <fg=red>00000</fg=red>');
        $this->line('   Communiquez-le oralement aux âmes concernées.');
        $this->newLine();
        $this->line('   Les âmes peuvent changer leur PIN dans l\'app :');
        $this->line('   Profil → Sécuriser mon compte');

        return 0;
    }
}