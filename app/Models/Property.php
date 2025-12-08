<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'cover_image', // NOVO
        'type',
        'transaction_type',
        'condition',
        'price',
        'city',
        'district',
        'address',
        'postal_code',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'area',
        'land_area',
        'year_built',
        'energy_rating',
        'video_url',
        'whatsapp',
        'features',
        'images',
        'status',
        'is_exclusive',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'price' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_exclusive' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes (mantidos iguais para manter a lógica de filtro)
    public function scopePublic($query)
    {
        return $query->where('is_exclusive', false)->where('status', 'published');
    }

    public function scopeExclusive($query)
    {
        return $query->where('is_exclusive', true)->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('status', 'published');
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByTransactionType($query, $transactionType)
    {
        return $query->where('transaction_type', $transactionType);
    }

    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeByBedrooms($query, $bedrooms)
    {
        return $query->where('bedrooms', '>=', $bedrooms);
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function getFormattedPriceAttribute(): string
    {
        return '€ ' . number_format($this->price, 0, ',', '.');
    }

    // Retorna a URL do Embed para o vídeo
    public function getVideoEmbedAttribute(): ?string
    {
        if (!$this->video_url) return null;

        // Suporte para YouTube
        if (str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be')) {
            // Extrai o ID do vídeo
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
            return isset($matches[1]) ? "https://www.youtube.com/embed/{$matches[1]}" : null;
        }

        // Suporte para Vimeo
        if (str_contains($this->video_url, 'vimeo.com')) {
            $videoId = (int) substr(parse_url($this->video_url, PHP_URL_PATH), 1);
            return "https://player.vimeo.com/video/{$videoId}";
        }

        return null;
    }

    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->whatsapp) return null;
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return "https://wa.me/{$number}?text=" . urlencode("Olá, vi o imóvel '{$this->title}' no portal Crow Global e gostaria de mais informações.");
    }
}