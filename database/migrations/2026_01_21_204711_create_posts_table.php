<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // 1. Relacionamento
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 2. Conteúdo Principal
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable(); 
            $table->longText('content');
            $table->string('image_path')->nullable();
            
            // 3. Status e Controle (Essencial para o Controller funcionar)
            $table->string('status')->default('draft'); // 'published' ou 'draft'
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            
            // 4. Metadados para o Layout
            $table->string('category')->nullable();
            $table->string('tag')->nullable();         // Ex: 'Design', 'Architecture'
            $table->string('author_name')->nullable(); // Ex: 'Cielo Team'
            $table->string('author_photo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};