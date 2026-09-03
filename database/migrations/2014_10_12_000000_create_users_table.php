<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('nom');
            // facultatif
            $table->string('email')->nullable()->unique();
            // obligatoire et unique
            $table->string('telephone')->unique();
            $table->string('password');
            $table->enum('role', [
                'evangeliste',
                'encadreur',
                'admin'
            ]);

            $table->foreignId('zone_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};