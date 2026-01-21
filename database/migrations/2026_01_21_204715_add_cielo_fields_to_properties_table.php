<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('properties', function (Blueprint $table) {
        // Verifica se a coluna 'video_url' NÃO existe antes de criar
        if (!Schema::hasColumn('properties', 'video_url')) {
            $table->string('video_url')->nullable()->after('cover_image');
        }

        // Verifica se a coluna 'is_energy_highlight' NÃO existe antes de criar
        if (!Schema::hasColumn('properties', 'is_energy_highlight')) {
            $table->boolean('is_energy_highlight')->default(false)->after('status');
        }
    });
}

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['is_energy_highlight', 'video_url']);
        });
    }
};