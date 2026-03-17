@props(['event' => []])

<style>
  /* events list */
  .events-list {
    margin: 60px 0;
  }

  .event-item {
    position: relative;
    border-radius: 30px;
    overflow: hidden;
    margin-bottom: 30px;
    height: 320px;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: flex-end;
    color: white;
    box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .event-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
  }

  .event-overlay {
    width: 100%;
    padding: 40px;
    background: linear-gradient(to top, rgba(10, 25, 47, 0.95) 0%, rgba(10, 25, 47, 0.4) 70%, transparent 100%);
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-end;
  }

  .event-info {
    flex: 2;
    min-width: 280px;
  }

  .event-title {
    font-size: 28px;
    margin-bottom: 8px;
  }

  .event-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    margin-bottom: 12px;
    font-size: 16px;
    color: #C6A43F;
    font-weight: 500;
  }

  .event-meta i {
    margin-right: 6px;
    color: #C6A43F;
  }

  .event-description {
    font-size: 16px;
    opacity: 0.9;
    max-width: 600px;
  }
</style>

<div class="event-item"
  style="cursor: pointer; background-image: linear-gradient(to right, rgba(10,25,47,0.3), rgba(10,25,47,0.3)), url('{{ $event['image'] }}');">
  <div class="event-overlay">
    <div class="event-info">
      <h3 class="event-title">{{ $event['title'] }}</h3>
      <div class="event-meta">
        <span><i class="fas fa-calendar-alt"></i> {{ $event['date'] }} at
          {{ $event['time'] }}</span>
        <span><i class="fas fa-map-marker-alt"></i> {{ $event['venue'] }}</span>
      </div>
      <p class="event-description">{{ $event['description'] }}</p>
    </div>
  </div>
</div>
