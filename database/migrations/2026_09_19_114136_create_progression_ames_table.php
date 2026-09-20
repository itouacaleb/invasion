<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progression_ames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ame_id')->constrained()->onDelete('cascade');
            $table->foreignId('niveau_id')->constrained()->onDelete('cascade');
            $table->enum('statut', ['non_commence', 'en_cours', 'complete', 'echoue'])
                  ->default('non_commence');
            $table->integer('lecons_completees')->default(0);
            $table->integer('score_total')->default(0);
            $table->integer('score_requis')->default(80);
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_completion')->nullable();
            $table->timestamps();

            $table->unique(['ame_id', 'niveau_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progression_ames');
    }
};