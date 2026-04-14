@props(['event' => []])

<a class="event-item" href="{{ route('events.event', $event) }}"
  style="background-image: url('{{ $event->image }}');">
  <div class="event-overlay">
    <div class="event-info">
      <h3 class="event-title">{{ $event->title }}</h3>
      <div class="event-meta">
        <span>
          <i class="fas fa-calendar-alt"></i> {{ $event->date->format('M j, Y') }} at
          {{ $event->display_time }}
        </span>
        <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
      </div>
      <p class="event-description">{{ $event->subtitle }}</p>
    </div>
  </div>
</a>
