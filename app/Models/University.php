<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    /** @use HasFactory<UniversityFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'subtitle',
        'slug',
        'content',
        'image',
        'country',
        'city',
        'logo',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function fundings(): HasMany
    {
        return $this->hasMany(Funding::class, 'university_id');
    }

    public function admissions(): HasMany
    {
        return $this->hasMany(Admission::class, 'university_id');
    }
}
