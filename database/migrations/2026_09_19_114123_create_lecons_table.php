<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('niveau_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->longText('contenu');
            $table->text('versets_cles')->nullable();
            $table->integer('ordre');
            $table->integer('duree_minutes')->default(10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecons');
    }
};