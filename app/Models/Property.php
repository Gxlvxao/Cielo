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
        'type',
        'transaction_type',
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

    /**
     * Get the owner/developer of the property
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope for public properties
     */
    public function scopePublic($query)
    {
        return $query->where('is_exclusive', false)
                    ->where('status', 'published');
    }

    /**
     * Scope for exclusive properties
     */
    public function scopeExclusive($query)
    {
        return $query->where('is_exclusive', true)
                    ->where('status', 'published');
    }

    /**
     * Scope for featured properties
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
                    ->where('status', 'published');
    }

    /**
     * Scope for filtering by city
     */
    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    /**
     * Scope for filtering by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for filtering by transaction type
     */
    public function scopeByTransactionType($query, $transactionType)
    {
        return $query->where('transaction_type', $transactionType);
    }

    /**
     * Scope for filtering by price range
     */
    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /**
     * Scope for filtering by bedrooms
     */
    public function scopeByBedrooms($query, $bedrooms)
    {
        return $query->where('bedrooms', '>=', $bedrooms);
    }

    /**
     * Check if property is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if property is exclusive
     */
    public function isExclusive(): bool
    {
        return $this->is_exclusive;
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return '€' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get first image
     */
    public function getFirstImageAttribute(): ?string
    {
        return $this->images[0] ?? null;
    }
}
