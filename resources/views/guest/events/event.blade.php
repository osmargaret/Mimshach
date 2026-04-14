@php
  $pageTitle = $event->title . ' | Events | Mimshach';
@endphp

<x-app-layout :$pageTitle>
  <x-slot:styles>
    <style>
      .event-hero {
        background: linear-gradient(135deg, #0A192F 0%, #1a2f4a 100%);
        padding: 140px 0 80px;
        color: white;
        position: relative;
      }

      .event-hero h1 {
        font-size: 48px;
        margin-bottom: 20px;
        line-height: 1.2;
      }

      .event-meta {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
        margin-top: 32px;
      }

      .event-meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .event-meta-item i {
        font-size: 24px;
        color: #C6A43F;
      }

      .event-content {
        padding: 80px 0;
        background: #F9F7F5;
      }

      .event-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 60px;
      }

      .event-main {
        background: white;
        border-radius: 30px;
        padding: 48px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      }

      .event-image {
        width: 100%;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      }

      .event-description {
        font-size: 18px;
        line-height: 1.8;
        color: #4a5568;
      }

      .event-description p {
        margin-bottom: 24px;
      }

      .sidebar-card {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 32px;
        position: sticky;
        top: 20px;
      }

      .sidebar-card h3 {
        font-size: 22px;
        margin-bottom: 20px;
        color: #0A192F;
      }

      .info-item {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
      }

      .info-item:last-child {
        border-bottom: none;
      }

      .info-label {
        font-weight: 600;
        color: #0A192F;
      }

      .info-value {
        color: #4a5568;
        text-align: right;
      }

      .register-btn {
        display: block;
        background: #C6A43F;
        color: #0A192F;
        padding: 16px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        text-align: center;
        transition: 0.3s;
        margin-top: 24px;
        font-size: 18px;
      }

      .register-btn:hover {
        background: #b38f2e;
        transform: translateY(-2px);
        cursor: pointer;
      }

      .event-status {
        display: inline-block;
        padding: 6px 16px;
        position: absolute;
        right: 10px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
      }

      .status-upcoming {
        background: #10b981;
        color: white;
      }

      .status-ongoing {
        background: #f59e0b;
        color: white;
      }

      .status-past {
        background: #6b7280;
        color: white;
      }

      .calendar-add {
        margin-top: 16px;
        text-align: center;
      }

      .calendar-add a {
        color: #C6A43F;
        text-decoration: none;
        font-size: 14px;
      }

      .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        text-decoration: none;
        margin-bottom: 32px;
        font-weight: 500;
        transition: 0.2s;
      }

      .back-button:hover {
        gap: 12px;
        color: #C6A43F;
      }

      .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
      }

      .modal-box {
        background: white;
        padding: 32px;
        border-radius: 20px;
        width: 100%;
        max-width: 500px;
      }

      .form-group {
        margin-bottom: 16px;
      }

      .form-group input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
      }

      .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
      }

      .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #10b981;
        color: white;
        padding: 14px 20px;
        border-radius: 10px;
        opacity: 0;
        transition: 0.3s;
      }

      .toast.show {
        opacity: 1;
      }

      @media (max-width: 992px) {
        .event-layout {
          grid-template-columns: 1fr;
        }

        .sidebar-card {
          position: static;
        }
      }

      @media (max-width: 768px) {
        .event-hero {
          padding: 100px 0 60px;
        }

        .event-hero h1 {
          font-size: 32px;
        }

        .event-main {
          padding: 32px;
        }

        .event-meta {
          gap: 20px;
        }
      }
    </style>
  </x-slot:styles>

  <div class="event-hero">
    <div class="container">
      <a class="back-button" href="{{ route('events.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Events
      </a>



      <div class="event-status status-{{ $event->status }}">
        @if ($event->status == 'upcoming')
          <i class="fas fa-clock"></i> Upcoming Event
        @elseif($event->status == 'ongoing')
          <i class="fas fa-play"></i> Happening Now
        @else
          <i class="fas fa-check-circle"></i> Past Event
        @endif
      </div>

      <h1>{{ $event->title }}</h1>
      @if ($event->subtitle)
        <p style="font-size: 18px; opacity: 0.9; max-width: 800px;">{{ $event->subtitle }}</p>
      @endif

      <div class="event-meta">
        <div class="event-meta-item">
          <i class="fas fa-calendar-alt"></i>
          <div>
            <div>{{ $event->start_date }}</div>
            <div style="font-size: 14px; opacity: 0.8;">
              {{ $event->formatted_start_time }} -
              {{ $event->formatted_end_time }}
            </div>
          </div>
        </div>
        <div class="event-meta-item">
          <i class="fas fa-map-marker-alt"></i>
          <span>{{ $event->location }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="event-content">
    <div class="container">
      <div class="event-layout">
        <div class="event-main">
          @isset($event->image)
            <img alt="{{ $event->title }}" class="event-image" src="{{ $event->image }}">
          @endisset

          <div class="event-description">
            {!! nl2br(e($event->description)) !!}
          </div>
        </div>

        <div>
          <div class="sidebar-card">
            <h3>Event Details</h3>

            <div class="info-item">
              <span class="info-label">Date</span>
              <span class="info-value">{{ $event->start_date }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Time</span>
              <span class="info-value">{{ $event->formatted_start_time }} -
                {{ $event->formatted_end_time }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Timezone</span>
              <span class="info-value">{{ $event->timezone_abbr }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Location</span>
              <span class="info-value">{{ $event->location }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Duration</span>
              <span class="info-value">{{ $event->duration_hours }} hours</span>
            </div>

            @if ($event->status == 'upcoming')
              <x-countdown-timer :target="$event->start_time" :timezone="$event->timezone" label='Event Starts In' />
              <button class="register-btn" onclick="openRegistrationModal()">
                <i class="fas fa-ticket-alt"></i> Register for Event
              </button>
            @elseif($event->status == 'ongoing')
              <a class="register-btn" href="#">
                <i class="fas fa-video"></i> Join Event Now
              </a>
            @endif
          </div>

          <div class="sidebar-card">
            <h3>What to Expect</h3>
            <ul style="list-style: none; padding: 0;">
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-chalkboard-teacher" style="color: #C6A43F; width: 24px;"></i>
                <span>Expert presentations and insights</span>
              </li>
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-users" style="color: #C6A43F; width: 24px;"></i>
                <span>Networking opportunities</span>
              </li>
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-question-circle" style="color: #C6A43F; width: 24px;"></i>
                <span>Q&A sessions with experts</span>
              </li>
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-download" style="color: #C6A43F; width: 24px;"></i>
                <span>Resource materials and guides</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Registration Modal -->
  <div class="modal-overlay" id="registrationModal" style="display:none;">
    <div class="modal-box">

      <h3>Register for Event</h3>

      <form id='eventRegistrationForm'>
        @csrf

        <div id="formErrors" style="color:red;margin-bottom:15px;"></div>

        <input name="event_id" type="hidden" value="{{ $event->id }}">
        <div class="form-group">
          <label>Name</label>
          <input name="name" required type="text">
        </div>

        <div class="form-group">
          <label>Email</label>
          <input name="email" required type="email">
        </div>

        <div class="form-group">
          <label>Phone Number</label>
          <input name="phone" required type="text">
        </div>

        <div class="form-group">
          <label>Date of Birth</label>
          <input name="date_of_birth" required type="date">
        </div>

        <div class="modal-actions">
          <button class="register-btn" id='submitBtn' type="submit">Submit Registration</button>
          <button class='register-btn' onclick="closeRegistrationModal()"
            type="button">Cancel</button>
        </div>
      </form>

    </div>
  </div>

  <x-slot:scripts>
    <script>
      const form = document.getElementById('eventRegistrationForm');
      const errorsBox = document.getElementById('formErrors');
      const submitBtn = document.getElementById('submitBtn');

      function addToCalendar() {
        // Create calendar event URL
        const event = {
          title: '{{ addslashes($event->title) }}',
          description: '{{ addslashes(strip_tags($event->description)) }}',
          location: '{{ addslashes($event->location) }}',
          start: '{{ $event->start_iso }}',
          end: '{{ $event->end_iso }}'
        };

        const startDate = new Date(event.start);
        const endDate = new Date(event.end);

        const googleCalendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE' +
          '&text=' + encodeURIComponent(event.title) +
          '&dates=' + startDate.toISOString().replace(/-|:|\./g, '') + '/' + endDate.toISOString()
          .replace(/-|:|\./g, '') +
          '&details=' + encodeURIComponent(event.description) +
          '&location=' + encodeURIComponent(event.location);

        window.open(googleCalendarUrl, '_blank');
      }

      function openRegistrationModal() {
        document.getElementById('registrationModal').style.display = 'flex';
      }

      function closeRegistrationModal() {
        document.getElementById('registrationModal').style.display = 'none';
      }

      form.addEventListener('submit', async function(e) {
        e.preventDefault();

        errorsBox.innerHTML = '';
        submitBtn.disabled = true;
        submitBtn.innerText = 'Registering...';

        const formData = new FormData(form);

        try {
          const response = await fetch(
            "{{ route('events.register', $event) }}", {
              method: "POST",
              headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
                "Accept": "application/json"
              },
              body: formData
            }
          );

          const data = await response.json();

          if (!response.ok) {
            throw data;
          }

          window.showToast(data.message, 'success');

          form.reset();
          closeRegistrationModal();

        } catch (error) {

          if (error.errors) {
            Object.values(error.errors).forEach(messages => {
              messages.forEach(msg => {
                errorsBox.innerHTML += `<div>${msg}</div>`;
              });
            });
          } else if (error.message) {
            window.showToast(error.message, 'error');
          }
        }

        submitBtn.disabled = false;
        submitBtn.innerText = 'Submit Registration';
      });

      document.getElementById('registrationModal')
        .addEventListener('click', function(e) {
          if (e.target === this) {
            closeRegistrationModal();
          }
        });
    </script>
  </x-slot:scripts>
</x-app-layout>
