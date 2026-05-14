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

<a aria-describedby="event-card-meta-{{ $eventCardId }}"
  aria-labelledby="event-card-title-{{ $eventCardId }}"
  class="group relative block h-80 overflow-hidden rounded-2xl shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#C6A43F]/80 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0A192F]"
  href="{{ route('events.event', $event) }}">

  <!-- Background Image -->
  <div aria-hidden="true"
    class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
    style="background-image: url('{{ Storage::url($event->image) }}');">
  </div>

  <!-- Gradient Overlay -->
  <div aria-hidden="true"
    class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-[#0A192F]/60 to-[#0A192F]/20">
  </div>

  <!-- Content -->
  <div class="absolute bottom-0 left-0 right-0 p-4 md:p-5">
    <h3
      class="mb-4 line-clamp-2 text-lg font-[Playfair_Display] font-bold text-white transition-colors group-hover:text-[#C6A43F] md:text-2xl"
      id="event-card-title-{{ $eventCardId }}">
      {{ $event->title }}
    </h3>

    <div>
      <div class="mb-4 flex gap-5 text-[#C6A43F]">

        <div class="flex items-center gap-1.5 text-sm">
          <p>
            <i aria-hidden="true" class="fas fa-calendar w-3.5"></i>
            {{ $eventDate }} at
          </p>

          @if ($isSameTimezone || !$userEventTime)
            <span>
              {{ $eventTime }} ({{ $eventTz }})
            </span>
          @else
            <span
              title="Event timezone: {{ $timezoneDetails['event_timezone'] }} (UTC{{ $eventOffset }})">
              {{ $eventTime }} {{ $eventTz }}
            </span>

            <span class="text-gray-500">•</span>

            <span class="text-gray-300"
              title="Your timezone: {{ $timezoneDetails['user_timezone'] }} (UTC{{ $userOffset }})">
              {{ $userTime }} ({{ $userTz }})
            </span>
          @endif
        </div>

        <!-- Location -->
        <div class="flex items-center gap-1.5 text-sm">
          <i aria-hidden="true" class="fas fa-map-marker-alt w-3.5"></i>
          <span class="line-clamp-1">{{ $event->location }}</span>
        </div>

        <div class="sr-only" id="event-card-meta-{{ $eventCardId }}">
          {{ $eventDate }}.
          @if ($isSameTimezone || !$userEventTime)
            {{ $eventTime }} {{ $eventTz }}.
          @else
            {{ $eventTime }} ({{ $eventCity }}), local time {{ $userTime }}
            ({{ $userTz }}).
          @endif
          {{ $event->location }}.
        </div>
      </div>
      
      <p class="mb-2 line-clamp-2 block text-sm text-gray-200 opacity-90 md:text-base">
        {{ $event->subtitle }}
      </p>
    </div>

    <!-- Status Badge -->
    <div
      class="@if ($event->status == 'upcoming') bg-green-500 
      @elseif($event->status == 'ongoing') bg-amber-500
      @else bg-gray-500 @endif absolute -top-2 right-3 rounded-full px-2.5 py-1 text-xs font-semibold text-white shadow-md">
      @if ($event->status == 'upcoming')
        <i aria-hidden="true" class="fas fa-clock mr-1"></i> Upcoming
      @elseif($event->status == 'ongoing')
        <i aria-hidden="true" class="fas fa-play mr-1"></i> Live
      @else
        <i aria-hidden="true" class="fas fa-check-circle mr-1"></i> Past
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
