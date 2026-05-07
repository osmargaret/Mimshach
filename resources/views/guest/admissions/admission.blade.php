{{-- resources/views/admission/show.blade.php --}}
@php
  $pageTitle = $admission->title . ' | Admission Insights | Mimshach';

  // Format the deadline in ISO format for JavaScript
  $deadlineIso = $admission->deadline->endOfDay()->toIso8601String();
  // @dd($deadlineIso)
@endphp

<x-app-layout :$pageTitle>
  <x-slot:styles>
    <style>
      /* Only keeping essential styles that can't be easily replaced with Tailwind */
      .admission-hero:before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: linear-gradient(135deg, rgba(198, 164, 63, 0.1) 0%, rgba(198, 164, 63, 0.05) 100%);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
      }

      .detail-block h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: #C6A43F;
      }
    </style>
  </x-slot:styles>

  <div
    class="admission-hero bg-linear-to-br relative overflow-hidden from-[#0A192F] to-[#1a2f4a] py-[140px] pb-20 text-white">
    <div class="container mx-auto max-w-[1200px] px-4">
      <a class="back-button mb-6 inline-flex items-center gap-2 font-medium text-white transition-all duration-200 hover:gap-3 hover:text-[#C6A43F]"
        href="{{ route('admissions.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Insights
      </a>
      <div
        class="absolute right-5 inline-flex items-center gap-2 rounded-full border border-[rgba(198,164,63,0.4)] bg-[rgba(198,164,63,0.2)] px-4 py-1.5 text-sm font-semibold backdrop-blur-[10px]">
        <i class="fas fa-graduation-cap"></i>
        <span>Admission {{ $admission->year }}</span>
      </div>
      <h1 class="mb-5 text-3xl leading-tight md:text-5xl">{{ $admission->title }}</h1>
      @if ($admission->subtitle)
        <p class="max-w-[700px] text-lg opacity-90">{{ $admission->subtitle }}</p>
      @endif
      <div class="mt-8 flex flex-wrap gap-6">
        <div class="flex items-center gap-2.5">
          <i class="fas fa-university text-[#C6A43F]"></i>
          <span>{{ $admission->university->name ?? ($admission->university_name ?? 'University') }}</span>
        </div>
        <div class="flex items-center gap-2.5">
          <i class="fas fa-map-marker-alt text-[#C6A43F]"></i>
          <span>{{ $admission->country }}</span>
        </div>
        <div class="flex items-center gap-2.5">
          <i class="fas fa-calendar-alt text-[#C6A43F]"></i>
          <span>Deadline: {{ \Carbon\Carbon::parse($admission->deadline)->format('F j, Y') }}</span>
          @if ($admission->deadline->isPast())
            <span
              class="ml-2 rounded-full bg-gray-500 px-3 py-1 text-xs font-semibold text-white">Expired</span>
          @elseif ($admission->deadline->greaterThan(now()->addMonths(6)))
            <span
              class="ml-2 rounded-full bg-green-500 px-3 py-1 text-xs font-semibold text-white">Open</span>
          @else
            <span
              class="ml-2 rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white">Urgent</span>
          @endif
        </div>
        <div class="flex items-center gap-2.5">
          <i class="fas fa-book text-[#C6A43F]"></i>
          <span>Program: {{ $admission->program }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-[#F9F7F5] py-20">
    <div class="container mx-auto max-w-[1200px] px-4">
      <div class="grid grid-cols-1 gap-16 lg:grid-cols-[2.5fr_1.5fr]">
        <div class="rounded-[30px] bg-white p-8 shadow-md md:p-12">
          <div class="mb-12">
            <h2 class="relative mb-5 pb-3 text-2xl font-bold text-[#0A192F] md:text-3xl">About This
              Admission</h2>
            <div class="leading-relaxed text-[#4a5568]">
              {!! nl2br(e($admission->content)) !!}
            </div>
          </div>

          <div>
            <h2 class="relative mb-5 pb-3 text-2xl font-bold text-[#0A192F] md:text-3xl">Program
              Information</h2>
            <div class="mb-4 rounded-2xl bg-[#F9F7F5] p-5">
              <div class="mb-2 text-xs font-semibold uppercase tracking-wider text-[#C6A43F]">
                Program of Study</div>
              <div class="text-lg font-semibold text-[#0A192F]">{{ $admission->program }}</div>
            </div>
            <div class="mb-4 rounded-2xl bg-[#F9F7F5] p-5">
              <div class="mb-2 text-xs font-semibold uppercase tracking-wider text-[#C6A43F]">
                Academic Year</div>
              <div class="text-lg font-semibold text-[#0A192F]">{{ $admission->year }}</div>
            </div>
            <div class="mb-4 rounded-2xl bg-[#F9F7F5] p-5">
              <div class="mb-2 text-xs font-semibold uppercase tracking-wider text-[#C6A43F]">
                Location</div>
              <div class="text-lg font-semibold text-[#0A192F]">{{ $admission->country }}</div>
            </div>
          </div>
        </div>

        <div>
          <div class="sticky top-[100px] mb-8 rounded-2xl bg-white p-8 shadow-md">
            <h3 class="mb-6 text-2xl font-bold text-[#0A192F]">Key Information</h3>

            <div class="flex justify-between border-b border-gray-200 py-4">
              <span class="font-semibold text-[#0A192F]">University</span>
              <span
                class="text-right text-[#4a5568]">{{ $admission->university->name ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200 py-4">
              <span class="font-semibold text-[#0A192F]">Program</span>
              <span class="text-right text-[#4a5568]">{{ $admission->program }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200 py-4">
              <span class="font-semibold text-[#0A192F]">Year</span>
              <span class="text-right text-[#4a5568]">{{ $admission->year }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-200 py-4">
              <span class="font-semibold text-[#0A192F]">Country</span>
              <span class="text-right text-[#4a5568]">{{ $admission->country }}</span>
            </div>
            <div class="flex justify-between py-4">
              <span class="font-semibold text-[#0A192F]">Application Deadline</span>
              <span
                class="text-right text-[#4a5568]">{{ \Carbon\Carbon::parse($admission->deadline)->format('F j, Y') }}</span>
            </div>

            @if (!\Carbon\Carbon::parse($admission->deadline)->isPast())
              <x-countdown-timer :target="$admission->deadline" label='Time Remaining To Apply' />
            @endif
          </div>

          @if ($admission->university)
            <div class="sticky top-[100px] mb-8 rounded-2xl bg-white p-8 shadow-md">
              <h3 class="mb-6 text-2xl font-bold text-[#0A192F]">About
                {{ $admission->university->name }}</h3>
              <p class="mb-4 leading-relaxed text-[#4a5568]">
                {{ Str::limit(strip_tags($admission->university->content), 150) }}
              </p>
              <a class="text-accent border-accent/30 hover:bg-accent/30 rounded-lg border px-4 py-2 font-semibold no-underline transition-all duration-300"
                href="{{ route('universities.university', $admission->university) }}">
                View University Details <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          @endif
        </div>
      </div>

      @if ($relatedAdmissions && count($relatedAdmissions) > 0)
        <div class="mt-16 border-t border-gray-200 pt-16">
          <h3 class="mb-8 text-3xl font-bold text-[#0A192F]">Related Admission Opportunities</h3>
          <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($relatedAdmissions as $related)
              <a class="block rounded-2xl bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
                href="{{ route('admissions.admission', $related) }}">
                <div class="p-5">
                  <h4 class="mb-2.5 text-lg font-bold text-[#0A192F]">{{ $related->title }}</h4>
                  <p class="mb-3 text-sm text-[#4a5568]">
                    {{ Str::limit(strip_tags($related->content), 100) }}</p>
                  <div class="text-sm text-[#C6A43F]">
                    <i class="fas fa-calendar-alt"></i>
                    {{ \Carbon\Carbon::parse($related->deadline)->format('M d, Y') }}
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>

  <x-slot:scripts>
    <script>
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
            timer.innerHTML =
              '<div class="timer-label">Deadline Passed</div>';
            clearInterval(loop);
            return;
          }

          // -------- MONTH DIFFERENCE --------
          let months =
            (deadline.getFullYear() - now.getFullYear()) * 12 +
            (deadline.getMonth() - now.getMonth());

          // create comparison date safely
          let compare = new Date(now);
          compare.setDate(1); // prevent overflow
          compare.setMonth(compare.getMonth() + months);

          // restore day safely
          compare.setDate(
            Math.min(now.getDate(),
              new Date(compare.getFullYear(), compare.getMonth() + 1, 0).getDate())
          );

          // adjust if exceeded deadline
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

          // -------- REMAINING TIME --------
          let remaining = deadline - compare;

          // safety clamp (prevents negatives)
          remaining = Math.max(0, remaining);

          const days = Math.floor(remaining / 86400000);
          const hours = Math.floor((remaining / 3600000) % 24);
          const minutes = Math.floor((remaining / 60000) % 60);
          const seconds = Math.floor((remaining / 1000) % 60);

          // -------- UPDATE UI --------
          els.months.textContent = String(months).padStart(2, '0');
          els.days.textContent = String(days).padStart(2, '0');
          els.hours.textContent = String(hours).padStart(2, '0');
          els.minutes.textContent = String(minutes).padStart(2, '0');
          els.seconds.textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        const loop = setInterval(updateCountdown, 1000);
      });
    </script>
  </x-slot:scripts>
</x-app-layout>
