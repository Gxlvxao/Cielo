<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'summary',      // Resumo do post
        'image_path',   // Caminho da imagem (Storage)
        'category',     // Categoria/Tag
        'published_at', // Data de publicação
        'is_featured'   // Destaque principal
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // --- SETUP DE ROTAS (SEO) ---

    /**
     * Define que a chave de busca na URL será o 'slug' e não o ID.
     * Isso permite rotas como: /journal/titulo-do-artigo
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // --- ACESSORES (Getters Mágicos) ---

    /**
     * Permite acessar $post->image nas views, mapeando para image_path.
     * Evita erros de "Undefined property" no front-end.
     */
    public function getImageAttribute()
    {
        return $this->image_path;
    }

    // --- RELACIONAMENTOS ---

    /**
     * O autor do post (Admin/User).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- SCOPES (Consultas Reutilizáveis) ---

    /**
     * Filtra apenas posts publicados (Data válida e não futura).
     */
    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at')
              ->where('published_at', '<=', now());
    }

    /**
     * Filtra por categoria específica.
     */
    public function scopeCategory(Builder $query, ?string $category): void
    {
        // Só aplica o filtro se a categoria não for nula/vazia
        if (!empty($category)) {
            $query->where('category', $category);
        }
        
        // Se for null, ele simplesmente ignora e não quebra o site,
        // retornando posts variados (o que é ótimo para "Relacionados")
    }

    /**
     * Encapsula a lógica de busca textual.
     */
    public function scopeSearch(Builder $query, ?string $term): void
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('summary', 'like', "%{$term}%")
                  ->orWhere('content', 'like', "%{$term}%");
            });
        }
    }
}