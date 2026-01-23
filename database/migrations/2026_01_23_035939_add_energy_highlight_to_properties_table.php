<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Adiciona o campo booleano para destacar o imóvel
            $table->boolean('is_energy_of_week')->default(false)->after('status');
            
            // Opcional: Um campo de texto curto para a "Frase de Energia" (ex: "Fluxo criativo intenso")
            $table->string('energy_tagline')->nullable()->after('is_energy_of_week');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['is_energy_of_week', 'energy_tagline']);
        });
    }
};