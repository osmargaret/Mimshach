<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\AdmissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    /** @use HasFactory<AdmissionFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'program',
        'year',
        'country',
        'deadline',
        'university_id',
    ];

    protected $casts = [
        'deadline' => 'date',
        'year' => 'integer',
    ];

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

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id');
    }
}
