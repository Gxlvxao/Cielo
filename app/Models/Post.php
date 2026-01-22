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
    public function scopeCategory(Builder $query, string $category): void
    {
        $query->where('category', $category);
    }

    /**
     * Filtra apenas os destacados.
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }
}