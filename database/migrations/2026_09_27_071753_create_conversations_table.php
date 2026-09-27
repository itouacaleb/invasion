<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            
            // ✅ L'âme qui participe
            $table->foreignId('ame_id')
                ->constrained('ames')
                ->cascadeOnDelete();
            
            // ✅ Le responsable (admin/évangéliste/encadreur)
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            
            // ✅ Métadonnées
            $table->timestamp('dernier_message_at')->nullable();
            $table->integer('messages_non_lus_ame')->default(0);
            $table->integer('messages_non_lus_user')->default(0);
            
            $table->timestamps();
            
            // ✅ Une seule conversation par paire (âme, user)
            $table->unique(['ame_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};