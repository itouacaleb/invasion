<?php

namespace App\Console\Commands;

use App\Models\Ame;
use Illuminate\Console\Command;

class ListerAmesSansTelephone extends Command
{
    protected $signature = 'ames:sans-telephone';
    protected $description = 'Liste les âmes qui n\'ont pas de numéro de téléphone (ne pourront pas se connecter)';

    public function handle()
    {
        $ames = Ame::whereNull('telephone')
            ->orWhere('telephone', '')
            ->with(['campagne', 'encadreur'])
            ->get();

        if ($ames->isEmpty()) {
            $this->info('✅ Toutes les âmes ont un numéro de téléphone.');
            return 0;
        }

        $this->warn("⚠️  {$ames->count()} âme(s) sans téléphone :");
        $this->newLine();

        $this->table(
            ['ID', 'Nom', 'Campagne', 'Encadreur'],
            $ames->map(fn($a) => [
                $a->id,
                $a->nom,
                $a->campagne?->nom ?? '-',
                $a->encadreur?->nom ?? '-',
            ])
        );

        $this->newLine();
        $this->line('📢 Ces âmes ne pourront pas se connecter tant qu\'elles n\'auront pas de téléphone.');
        $this->line('   Demandez aux encadreurs de compléter leurs fiches.');

        return 0;
    }
}