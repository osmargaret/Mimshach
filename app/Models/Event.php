<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'timezone',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
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

    public function getStartDateAttribute()
    {
        return $this->date->format('F j, Y');
    }

    public function getFormattedStartTimeAttribute()
    {
        if (! $this->start_time) {
            return null;
        }

        return $this->start_time->timezone($this->timezone)->format('g:i A');
    }

    public function getFormattedEndTimeAttribute()
    {
        if (! $this->end_time) {
            return null;
        }

        return $this->end_time->timezone($this->timezone)->format('g:i A');
    }

    public function getStatusAttribute()
    {
        $now = now($this->timezone);

        if ($now->lt($this->start_time)) {
            return 'upcoming';
        }

        if ($now->between($this->start_time, $this->end_time)) {
            return 'ongoing';
        }

        return 'past';
    }

    public function getTimezoneAbbrAttribute()
    {
        if (! $this->timezone) {
            return null;
        }

        return now($this->timezone)->format('T');
    }

    public function getDisplayTimeAttribute()
    {
        if (! $this->start_time) {
            return 'Not scheduled';
        }

        return $this->start_time
            ->timezone($this->timezone)
            ->format('g:i A T');
    }

    public function getDurationHoursAttribute()
    {
        return $this->start_time->diffInHours($this->end_time);
    }

    public function getStartIsoAttribute()
    {
        return $this->start_time->toIso8601String();
    }

    public function getEndIsoAttribute()
    {
        return $this->end_time->toIso8601String();
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }
}
