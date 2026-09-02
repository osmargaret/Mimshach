<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    /** @use HasFactory<BlogFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'user_id',
        'featured_image',
    ];

    protected $appends = [
        'featured_image_url',
    ];

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        if (filter_var($this->featured_image, FILTER_VALIDATE_URL) || str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        return asset('storage/'.ltrim($this->featured_image, '/'));
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
