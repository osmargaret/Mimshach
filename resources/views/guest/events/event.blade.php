@php
  $pageTitle = $event->title . ' | Events | Mimshach';

  // Get user timezone from cookie
  $userTimezone = $_COOKIE['user_timezone'] ?? date_default_timezone_get();

  // Event times in event's timezone
$eventStartInEventTz = $event->start_time->setTimezone($event->timezone);
$eventEndInEventTz = $event->end_time->setTimezone($event->timezone);

// Event times in user's timezone
  $eventStartInUserTz = $event->start_time->setTimezone($userTimezone);
  $eventEndInUserTz = $event->end_time->setTimezone($userTimezone);

  // Check if dates are the same for display
  $isSameDayInUserTz = $eventStartInUserTz->format('Y-m-d') === $eventEndInUserTz->format('Y-m-d');

  // For the countdown timer - use the event's original UTC time or event timezone
// Countdown should count to the actual event time, not user's converted time
  $countdownTarget = $event->start_time; // This is already a Carbon instance

  // Get timezone abbreviations
  $eventTzAbbr = $eventStartInEventTz->format('T');
  $userTzAbbr = $eventStartInUserTz->format('T');

  // Get city names from timezone
  $eventCity = str_replace('_', ' ', last(explode('/', $event->timezone)));
  $userCity = str_replace('_', ' ', last(explode('/', $userTimezone)));
@endphp

<x-app-layout :$pageTitle>
  <!-- Hero Section -->
  <div
    class="bg-linear-to-br relative overflow-hidden from-[#0A192F] to-[#1a2f4a] py-28 pb-20 text-white md:py-[140px]">
    <div class="container relative mx-auto max-w-[1200px] px-4">
      <!-- Back Button -->
      <a class="back-button mb-6 inline-flex items-center gap-2 font-medium text-white transition-all duration-300 hover:gap-3 hover:text-[#C6A43F]"
        href="{{ route('events.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Events
      </a>

      <!-- Status Badge -->
      <div
        class="@if ($event->status == 'upcoming') bg-green-500 text-white
        @elseif($event->status == 'ongoing') bg-amber-500 text-white
        @else bg-gray-500 text-white @endif absolute right-4 top-0 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-semibold shadow-lg md:right-5">
        @if ($event->status == 'upcoming')
          <i class="fas fa-clock"></i> Upcoming Event
        @elseif($event->status == 'ongoing')
          <i class="fas fa-play"></i> Happening Now
        @else
          <i class="fas fa-check-circle"></i> Past Event
        @endif
      </div>

      <!-- Title -->
      <h1 class="mb-5 text-3xl leading-tight md:text-5xl lg:text-6xl">{{ $event->title }}</h1>

      <!-- Subtitle -->
      @if ($event->subtitle)
        <p class="max-w-[800px] text-base opacity-90 md:text-lg">{{ $event->subtitle }}</p>
      @endif

      <!-- Meta Information with Both Timezones -->
      <div class="mt-8 flex flex-wrap gap-6 md:gap-8">
        <!-- Event Timezone -->
        <div class="flex items-start gap-3">
          <i class="fas fa-calendar-alt text-2xl text-[#C6A43F]"></i>
          <div>
            <div class="text-base font-medium">
              {{ $eventStartInEventTz->format('F j, Y') }}
            </div>
            <div class="text-sm opacity-80">
              {{ $eventStartInEventTz->format('g:i A') }} -
              {{ $eventEndInEventTz->format('g:i A') }}
              <span class="ml-1 inline-block rounded-full bg-white/20 px-2 py-0.5 text-xs">
                {{ $eventTzAbbr }} ({{ $eventCity }})
              </span>
            </div>
          </div>
        </div>

        <!-- User Local Timezone (if different) -->
        @if ($userTimezone !== $event->timezone)
          <div class="flex items-start gap-3">
            <i class="fas fa-clock text-2xl text-[#C6A43F]"></i>
            <div>
              <div class="text-base font-medium">Your Local Time</div>
              <div class="text-sm opacity-80">
                @if ($isSameDayInUserTz)
                  {{ $eventStartInUserTz->format('F j, Y') }} •
                  {{ $eventStartInUserTz->format('g:i A') }} -
                  {{ $eventEndInUserTz->format('g:i A') }}
                @else
                  {{ $eventStartInUserTz->format('F j, Y g:i A') }} -
                  {{ $eventEndInUserTz->format('F j, Y g:i A') }}
                @endif
                <span class="ml-1 inline-block rounded-full bg-white/20 px-2 py-0.5 text-xs">
                  {{ $userTzAbbr }} ({{ $userCity }})
                </span>
              </div>
            </div>
          </div>
        @endif

        <!-- Location -->
        <div class="flex items-start gap-3">
          <i class="fas fa-map-marker-alt text-2xl text-[#C6A43F]"></i>
          <div>
            <div class="text-base font-medium">{{ $event->location }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="bg-[#F9F7F5] py-12 md:py-20">
    <div class="container mx-auto max-w-[1200px] px-4">
      <div class="flex flex-col gap-8 lg:grid lg:grid-cols-[2fr_1fr] xl:gap-16">

        <!-- Left Column - Main Content -->
        <div class="rounded-3xl bg-white p-6 shadow-md md:p-8 lg:p-12">
          @isset($event->image)
            <img alt="{{ $event->title }}" class="mb-8 w-full rounded-2xl shadow-lg"
              src="{{ $event->image }}">
          @endisset

          <div class="prose prose-lg max-w-none leading-relaxed text-[#4a5568]">
            {!! nl2br(e($event->description)) !!}
          </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-8">
          <!-- Event Details Card -->
          <div
            class="sticky top-[100px] max-h-[calc(100vh-120px)] overflow-y-auto rounded-2xl bg-white p-6 shadow-md md:p-8">
            <h3 class="mb-6 text-2xl font-bold text-[#0A192F]">Event Details</h3>

            <div class="space-y-0 divide-y divide-gray-100">
              <!-- Event Timezone Details -->
              <div class="py-4">
                <div class="mb-3 font-semibold text-[#0A192F]">Event Time ({{ $eventTzAbbr }})
                </div>
                <div class="space-y-2 text-sm text-[#4a5568]">
                  <div class="flex justify-between">
                    <span>Date:</span>
                    <span
                      class="font-medium">{{ $eventStartInEventTz->format('l, F j, Y') }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Time:</span>
                    <span class="font-medium">{{ $eventStartInEventTz->format('g:i A') }} -
                      {{ $eventEndInEventTz->format('g:i A') }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Timezone:</span>
                    <span class="font-medium">{{ $event->timezone }} ({{ $eventTzAbbr }})</span>
                  </div>
                </div>
              </div>

              <!-- User Local Time (if different) -->
              @if ($userTimezone !== $event->timezone)
                <div class="py-4">
                  <div class="mb-3 font-semibold text-[#0A192F]">Your Local Time
                    ({{ $userTzAbbr }})</div>
                  <div class="space-y-2 text-sm text-[#4a5568]">
                    <div class="flex justify-between">
                      <span>Date:</span>
                      <span
                        class="font-medium">{{ $eventStartInUserTz->format('l, F j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span>Time:</span>
                      <span class="font-medium">
                        {{ $eventStartInUserTz->format('g:i A') }}
                        @if (!$isSameDayInUserTz)
                          (Starts)
                        @endif
                        -
                        {{ $eventEndInUserTz->format('g:i A') }}
                        @if (
                            !$isSameDayInUserTz &&
                                $eventStartInUserTz->format('Y-m-d') !== $eventEndInUserTz->format('Y-m-d')
                        )
                          (Ends on {{ $eventEndInUserTz->format('F j, Y') }})
                        @endif
                      </span>
                    </div>
                    <div class="flex justify-between">
                      <span>Timezone:</span>
                      <span class="font-medium">{{ $userTimezone }} ({{ $userTzAbbr }})</span>
                    </div>
                  </div>
                </div>
              @endif

              <!-- Common Details -->
              <div class="py-4">
                <div class="flex justify-between">
                  <span class="font-semibold text-[#0A192F]">Location</span>
                  <span class="text-right text-[#4a5568]">{{ $event->location }}</span>
                </div>
              </div>
              <div class="py-4">
                <div class="flex justify-between">
                  <span class="font-semibold text-[#0A192F]">Duration</span>
                  <span class="text-right text-[#4a5568]">{{ $event->duration_hours }} hours</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Countdown and Registration -->
          @if (!$event->end_time->isPast())
            <div class="sticky top-[100px] rounded-2xl bg-white p-6 shadow-md md:px-4 md:py-8">
              @if ($event->status == 'upcoming')
                <!-- Countdown Timer -->
                <div class="mb-6">
                  <x-countdown-timer :target="$countdownTarget" label='Event Starts In' />


                </div>

                <button
                  class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#C6A43F] px-6 py-3 font-semibold text-[#0A192F] transition-all duration-300 hover:-translate-y-0.5 hover:cursor-pointer hover:bg-[#b38f2e] hover:shadow-lg"
                  onclick="openRegistrationModal()">
                  <i class="fas fa-ticket-alt"></i> Register for Event
                </button>
              @endif

              <!-- Add to Calendar -->
              <div class="mt-4 text-center">
                <button
                  class="text-accent border-accent/30 hover:bg-accent/30 rounded-lg border px-4 py-2 font-semibold transition-all duration-300 hover:cursor-pointer"
                  onclick="addToCalendar()">
                  <i class="fas fa-calendar-plus"></i> Add to Calendar
                </button>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Registration Modal (same as before) -->
  <div class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60"
    id="registrationModal">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl md:p-8">
      <h3 class="mb-4 text-2xl font-bold text-[#0A192F]">Register for Event</h3>

      <form id="eventRegistrationForm">
        @csrf
        <div class="mb-4 text-sm text-red-600" id="formErrors"></div>

        <input name="event_id" type="hidden" value="{{ $event->id }}">

        <div class="mb-4">
          <label class="mb-2 block text-sm font-semibold text-[#0A192F]">Full Name *</label>
          <input
            class="w-full rounded-lg border border-gray-200 p-3 focus:border-[#C6A43F] focus:outline-none"
            name="name" required type="text">
        </div>

        <div class="mb-4">
          <label class="mb-2 block text-sm font-semibold text-[#0A192F]">Email Address *</label>
          <input
            class="w-full rounded-lg border border-gray-200 p-3 focus:border-[#C6A43F] focus:outline-none"
            name="email" required type="email">
        </div>

        <div class="mb-4">
          <label class="mb-2 block text-sm font-semibold text-[#0A192F]">Phone Number *</label>
          <input
            class="w-full rounded-lg border border-gray-200 p-3 focus:border-[#C6A43F] focus:outline-none"
            name="phone" required type="tel">
        </div>

        <div class="mb-4">
          <label class="mb-2 block text-sm font-semibold text-[#0A192F]">Date of Birth *</label>
          <input
            class="w-full rounded-lg border border-gray-200 p-3 focus:border-[#C6A43F] focus:outline-none"
            name="date_of_birth" required type="date">
        </div>

        <div class="flex gap-3">
          <button
            class="flex-1 rounded-full border border-gray-300 px-6 py-3 font-semibold text-[#4a5568] transition-all hover:bg-gray-50"
            onclick="closeRegistrationModal()" type="button">Cancel</button>
          <button
            class="flex-1 rounded-full bg-[#C6A43F] px-6 py-3 font-semibold text-[#0A192F] transition-all hover:bg-[#b38f2e]"
            id="submitBtn" type="submit">Submit Registration</button>
        </div>
      </form>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      // Set user timezone cookie if not set
      if (!document.cookie.includes('user_timezone=')) {
        const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        if (userTimezone) {
          document.cookie = `user_timezone=${userTimezone}; path=/; max-age=${60 * 60 * 24 * 30}`;
        }
      }

      const eventRegistrationForm = document.getElementById('eventRegistrationForm');
      const errorsBox = document.getElementById('formErrors');
      const submitBtn = document.getElementById('submitBtn');
      const modal = document.getElementById('registrationModal');

      function addToCalendar() {
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
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
      }

      function closeRegistrationModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        errorsBox.innerHTML = '';
        eventRegistrationForm.reset();
      }

      eventRegistrationForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        errorsBox.innerHTML = '';
        submitBtn.disabled = true;
        submitBtn.innerHTML =
          '<div class="mx-auto h-5 w-5 animate-spin rounded-full border-2 border-white border-t-transparent"></div>';

        const formData = new FormData(eventRegistrationForm);

        try {
          const response = await fetch("{{ route('events.register', $event) }}", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
              "Accept": "application/json"
            },
            body: formData
          });

          const data = await response.json();

          if (!response.ok) {
            throw data;
          }

          showToast(data.message, 'success');
          closeRegistrationModal();

        } catch (error) {
          if (error.errors) {
            Object.values(error.errors).forEach(messages => {
              messages.forEach(msg => {
                const errorDiv = document.createElement('div');
                errorDiv.textContent = msg;
                errorsBox.appendChild(errorDiv);
              });
            });
          } else if (error.message) {
            showToast(error.message, 'error');
          }
        }

        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Submit Registration';
      });

      // Close modal when clicking outside
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeRegistrationModal();
        }
      });

      // Close modal on escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
          closeRegistrationModal();
        }
      });

      document.addEventListener('DOMContentLoaded', () => {
        const timer = document.querySelector('.deadline-timer');
        if (!timer) return;

        const deadline = new Date(timer.dataset.deadline);

        const els = {
          months: timer.querySelector('#months'),
          days: timer.querySelector('#days'),
          hours: timer.querySelector('#hours'),
          minutes: timer.querySelector('#minutes'),
          seconds: timer.querySelector('#seconds'),
        };

        function updateCountdown() {
          const now = new Date();

          if (deadline <= now) {
            timer.innerHTML = '<div class="timer-label">Event Started!</div>';
            clearInterval(loop);
            // Reload page to update status
            setTimeout(() => window.location.reload(), 2000);
            return;
          }

          let months = (deadline.getFullYear() - now.getFullYear()) * 12 +
            (deadline.getMonth() - now.getMonth());

          let compare = new Date(now);
          compare.setDate(1);
          compare.setMonth(compare.getMonth() + months);

          compare.setDate(
            Math.min(now.getDate(),
              new Date(compare.getFullYear(), compare.getMonth() + 1, 0).getDate())
          );

          if (compare > deadline) {
            months--;
            compare = new Date(now);
            compare.setDate(1);
            compare.setMonth(compare.getMonth() + months);
            compare.setDate(
              Math.min(now.getDate(),
                new Date(compare.getFullYear(), compare.getMonth() + 1, 0).getDate())
            );
          }

          let remaining = deadline - compare;
          remaining = Math.max(0, remaining);

          const days = Math.floor(remaining / 86400000);
          const hours = Math.floor((remaining / 3600000) % 24);
          const minutes = Math.floor((remaining / 60000) % 60);
          const seconds = Math.floor((remaining / 1000) % 60);

          if (els.months) els.months.textContent = String(months).padStart(2, '0');
          if (els.days) els.days.textContent = String(days).padStart(2, '0');
          if (els.hours) els.hours.textContent = String(hours).padStart(2, '0');
          if (els.minutes) els.minutes.textContent = String(minutes).padStart(2, '0');
          if (els.seconds) els.seconds.textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        const loop = setInterval(updateCountdown, 1000);
      });
    </script>
  </x-slot:scripts>
</x-app-layout>
