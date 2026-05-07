<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
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

    // This will be set when the model is loaded in a request context
    protected $userTimezone = null;

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

    /**
     * Get the user's timezone from cookie or session
     */
    public function getUserTimezoneAttribute()
    {
        if ($this->userTimezone) {
            return $this->userTimezone;
        }

        // Try to get from cookie - handle encrypted cookies
        try {
            $userTimezone = Cookie::get('user_timezone');
            if ($userTimezone) {
                $this->userTimezone = $userTimezone;
                return $userTimezone;
            }
        } catch (\Exception $e) {
            // Cookie might be encrypted or not accessible
        }

        // Try from request cookie (if in HTTP context)
        if (function_exists('request') && request()->hasCookie('user_timezone')) {
            try {
                $userTimezone = request()->cookie('user_timezone');
                if ($userTimezone) {
                    $this->userTimezone = $userTimezone;
                    return $userTimezone;
                }
            } catch (\Exception $e) {
                // Ignore
            }
        }

        // Try from session
        if (session()->has('user_timezone')) {
            $this->userTimezone = session('user_timezone');
            return $this->userTimezone;
        }

        // Fallback to event's timezone or UTC
        return $this->timezone ?? 'UTC';
    }

    /**
     * Set user timezone manually (useful for testing or when model is loaded outside HTTP context)
     */
    public function setUserTimezone($timezone)
    {
        $this->userTimezone = $timezone;
        return $this;
    }

    public function getStartDateAttribute()
    {
        return $this->date->format('F j, Y');
    }

    public function getFormattedStartTimeAttribute()
    {
        return $this->start_time ? Carbon::parse($this->start_time)->timezone($this->timezone)->format('H:i') : null;
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_time ? Carbon::parse($this->end_time)->timezone($this->timezone)->format('H:i') : null;
    }

    // Get start time in user's timezone (default to event timezone if not specified)
    public function getStartTimeInTimezoneAttribute()
    {
        $userTimezone = $this->user_timezone;
        return $this->start_time ? Carbon::parse($this->start_time)->timezone($userTimezone) : null;
    }

    // Get end time in user's timezone
    public function getEndTimeInTimezoneAttribute()
    {
        $userTimezone = $this->user_timezone;
        return $this->end_time ? Carbon::parse($this->end_time)->timezone($userTimezone) : null;
    }

    // For display in admin panel (event's own timezone)
    public function getDisplayStartTimeAttribute()
    {
        return $this->start_time ? Carbon::parse($this->start_time)->timezone($this->timezone)->format('g:i A') : null;
    }

    public function getDisplayEndTimeAttribute()
    {
        return $this->end_time ? Carbon::parse($this->end_time)->timezone($this->timezone)->format('g:i A') : null;
    }

    // For user-facing display (their timezone)
    public function getUserStartTimeAttribute()
    {
        $userTimezone = $this->user_timezone;
        return $this->start_time ? Carbon::parse($this->start_time)->timezone($userTimezone)->format('M j, Y g:i A') : null;
    }

    public function getUserEndTimeAttribute()
    {
        $userTimezone = $this->user_timezone;
        return $this->end_time ? Carbon::parse($this->end_time)->timezone($userTimezone)->format('M j, Y g:i A') : null;
    }

    public function getStatusAttribute()
    {
        $now = now($this->timezone);
        $startTime = Carbon::parse($this->start_time)->timezone($this->timezone);
        $endTime = Carbon::parse($this->end_time)->timezone($this->timezone);

        if ($now->lt($startTime)) {
            return 'upcoming';
        }

        if ($now->between($startTime, $endTime)) {
            return 'ongoing';
        }

        return 'past';
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'upcoming' => '<span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">Upcoming</span>',
            'ongoing' => '<span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200">Ongoing</span>',
            'past' => '<span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300">Past</span>',
            default => '',
        };
    }

    public function getTimezoneAbbrAttribute()
    {
        if (! $this->timezone) {
            return null;
        }

        return now($this->timezone)->format('T');
    }

    public function getTimezoneDetailsAttribute(): array
    {
        $eventTimezone = $this->timezone ?: 'UTC';

        // Get user timezone from cookie
        $userTimezone = null;
        if (isset($_COOKIE['user_timezone'])) {
            $userTimezone = $_COOKIE['user_timezone'];
        } elseif (function_exists('request') && request()->hasCookie('user_timezone')) {
            $userTimezone = request()->cookie('user_timezone');
        } elseif (session()->has('user_timezone')) {
            $userTimezone = session('user_timezone');
        }

        // If no user timezone found, use event timezone
        if (!$userTimezone) {
            $userTimezone = $eventTimezone;
        }

        // Get event start time in event's timezone
        $eventStart = $this->start_time
            ? Carbon::parse($this->start_time)->setTimezone($eventTimezone)
            : null;

        // Get user's time representation
        $userEventTime = $eventStart && $userTimezone
            ? $eventStart->copy()->setTimezone($userTimezone)
            : null;

        // Check if timezones are the same (compare identifiers, not abbreviations)
        $isSameTimezone = ($eventTimezone === $userTimezone);

        // Extract city names from timezone (Africa/Lagos → Lagos)
        $eventCity = $eventTimezone ? str_replace('_', ' ', last(explode('/', $eventTimezone))) : null;
        $userCity = $userTimezone && !$isSameTimezone
            ? str_replace('_', ' ', last(explode('/', $userTimezone)))
            : null;

        return [
            'event_timezone' => $eventTimezone,
            'user_timezone' => $userTimezone,
            'event_start' => $eventStart,
            'user_event_time' => $userEventTime,
            'is_same_timezone' => $isSameTimezone,
            'event_time' => $eventStart ? $eventStart->format('g:i A') : null,
            'user_time' => $userEventTime ? $userEventTime->format('g:i A') : null,
            'event_tz' => $eventStart ? $eventStart->format('T') : null,
            'user_tz' => $userEventTime ? $userEventTime->format('T') : null,
            'event_city' => $eventCity,
            'user_city' => $userCity,
            'event_date' => $eventStart ? $eventStart->format('M j, Y') : null,
            'event_offset' => $eventStart ? $eventStart->format('P') : null, // +01:00 format
            'user_offset' => $userEventTime ? $userEventTime->format('P') : null,
        ];
    }

    public function getDisplayTimeAttribute()
    {
        return $this->start_time
            ->timezone($this->timezone)
            ->format('g:i A');
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

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // Skip invalid paths
        if (
            strpos($this->image, 'C:/') === 0 ||
            strpos($this->image, ':\\') !== false ||
            strpos($this->image, 'php') === 0 ||
            strpos($this->image, 'tmp') !== false
        ) {
            return null;
        }

        // Skip external URLs
        if (filter_var($this->image, FILTER_VALIDATE_URL) && strpos($this->image, 'storage') === false) {
            return null;
        }

        // Return storage URL
        return asset('storage/' . $this->image);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }
}
