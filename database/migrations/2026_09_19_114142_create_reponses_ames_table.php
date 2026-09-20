<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reponses_ames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ame_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('lecon_id')->constrained()->onDelete('cascade');
            $table->integer('reponse_donnee');
            $table->boolean('est_correcte');
            $table->integer('points_obtenus')->default(0);
            $table->timestamp('date_reponse')->useCurrent();
            $table->timestamps();

            $table->unique(['ame_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reponses_ames');
    }
};