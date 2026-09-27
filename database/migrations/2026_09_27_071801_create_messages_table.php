<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // ✅ Conversation parente
            $table->foreignId('conversation_id')
                ->constrained('conversations')
                ->cascadeOnDelete();
            
            // ✅ Qui envoie ? (polymorphique : 'ame' ou 'user')
            $table->string('expediteur_type'); // 'ame' ou 'user'
            $table->unsignedBigInteger('expediteur_id');
            
            // ✅ Contenu
            $table->text('contenu');
            
            // ✅ Lecture
            $table->boolean('lu')->default(false);
            $table->timestamp('lu_at')->nullable();
            
            $table->timestamps();
            
            // ✅ Index pour recherche rapide
            $table->index(['conversation_id', 'created_at']);
            $table->index(['expediteur_type', 'expediteur_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};