<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->uuid('broadcast_group_id')
                ->nullable()
                ->after('expediteur_id');

            $table->index('broadcast_group_id');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['broadcast_group_id']);
            $table->dropColumn('broadcast_group_id');
        });
    }
};