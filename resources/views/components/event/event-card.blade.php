@props(['event' => []])

@php
  $eventCardId = $event->id ?? sha1($event->title);
  $timezoneDetails = $event->timezone_details;

  $eventStart = $timezoneDetails['event_start'];
  $userEventTime = $timezoneDetails['user_event_time'];
  $isSameTimezone = $timezoneDetails['is_same_timezone'];
  $eventTime = $timezoneDetails['event_time'];
  $userTime = $timezoneDetails['user_time'];
  $eventTz = $timezoneDetails['event_tz'];
  $userTz = $timezoneDetails['user_tz'];
  $eventCity = $timezoneDetails['event_city'];
  $userCity = $timezoneDetails['user_city'];
  $eventDate = $timezoneDetails['event_date'];
  $eventOffset = $timezoneDetails['event_offset'];
  $userOffset = $timezoneDetails['user_offset'];
@endphp

<a
  class="group relative block h-80 overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#C6A43F]/80 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0A192F]"
  href="{{ route('events.event', $event) }}"
  aria-labelledby="event-card-title-{{ $eventCardId }}"
  aria-describedby="event-card-meta-{{ $eventCardId }}">

  <!-- Background Image -->
  <div
    class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
    style="background-image: url('{{ Storage::url($event->image) }}');"
    aria-hidden="true">
  </div>

  <!-- Gradient Overlay -->
  <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-[#0A192F]/60 to-transparent" aria-hidden="true">
  </div>

  <!-- Content -->
  <div class="absolute bottom-0 left-0 right-0 p-4 md:p-5">
    <h3
      id="event-card-title-{{ $eventCardId }}"
      class="line-clamp-2 text-lg font-bold text-white transition-colors group-hover:text-[#C6A43F] md:text-xl">
      {{ $event->title }}
    </h3>

    <p class="mb-2 line-clamp-2 text-xs text-gray-200 opacity-90 md:text-sm">
      {{ $event->subtitle }}
    </p>

    <div class="mb-2 space-y-1.5 text-xs text-[#C6A43F]">
      <p>
        <i class="fas fa-calendar w-3.5" aria-hidden="true"></i>
        {{ $eventDate }}
      </p>
      <div class="flex items-center gap-1.5 text-xs">
        <i class="fas fa-clock w-3.5" aria-hidden="true"></i>

        @if ($isSameTimezone || !$userEventTime)
          <span>
            {{ $eventTime }} ({{ $eventTz }})
          </span>
        @else
          <span title="Event timezone: {{ $timezoneDetails['event_timezone'] }} (UTC{{ $eventOffset }})">
            {{ $eventTime }} ({{ $eventCity ?? $eventTz }})
          </span>

          <span class="text-gray-500">•</span>

          <span class="text-gray-300" title="Your timezone: {{ $timezoneDetails['user_timezone'] }} (UTC{{ $userOffset }})">
            {{ $userTime }} ({{ $userTz }})
          </span>
        @endif
      </div>

      <!-- Location -->
      <div class="flex items-center gap-1.5">
        <i class="fas fa-map-marker-alt w-3.5" aria-hidden="true"></i>
        <span class="line-clamp-1">{{ $event->location }}</span>
      </div>

      <div id="event-card-meta-{{ $eventCardId }}" class="sr-only">
        {{ $eventDate }}.
        @if ($isSameTimezone || !$userEventTime)
          {{ $eventTime }} {{ $eventTz }}.
        @else
          {{ $eventTime }} ({{ $eventCity }}), local time {{ $userTime }} ({{ $userTz }}).
        @endif
        {{ $event->location }}.
      </div>
    </div>

    <!-- Status Badge -->
    <div
      class="@if ($event->status == 'upcoming') bg-green-500 
      @elseif($event->status == 'ongoing') bg-amber-500
      @else bg-gray-500 @endif absolute -top-2 right-3 rounded-full px-2.5 py-1 text-xs font-semibold text-white shadow-md">
      @if ($event->status == 'upcoming')
        <i class="fas fa-clock mr-1" aria-hidden="true"></i> Upcoming
      @elseif($event->status == 'ongoing')
        <i class="fas fa-play mr-1" aria-hidden="true"></i> Live
      @else
        <i class="fas fa-check-circle mr-1" aria-hidden="true"></i> Past
      @endif
    </div>
  </div>
</a>

<x-slot:styles>
  <style>
    .line-clamp-1 {
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
</x-slot:styles>