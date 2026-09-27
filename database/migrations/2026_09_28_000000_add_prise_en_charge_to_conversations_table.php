<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // ✅ Statut de prise en charge
            $table->foreignId('pris_en_charge_par')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('pris_en_charge_at')
                ->nullable()
                ->after('pris_en_charge_par');

            // ✅ Une conv est "orpheline" si user_id ET pris_en_charge_par sont null
            //    (elle attend qu'un admin la prenne)
            $table->index(['ame_id', 'pris_en_charge_par']);
            $table->index('pris_en_charge_at');
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['pris_en_charge_par']);
            $table->dropIndex(['ame_id', 'pris_en_charge_par']);
            $table->dropIndex(['pris_en_charge_at']);
            $table->dropColumn(['pris_en_charge_par', 'pris_en_charge_at']);
        });
    }
};