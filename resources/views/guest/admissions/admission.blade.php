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
      /* Your existing styles remain the same */
      .admission-hero {
        background: linear-gradient(135deg, #0A192F 0%, #1a2f4a 100%);
        padding: 140px 0 80px;
        color: white;
        position: relative;
        overflow: hidden;
      }

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

      .admission-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(198, 164, 63, 0.2);
        backdrop-filter: blur(10px);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 24px;
        border: 1px solid rgba(198, 164, 63, 0.4);
        position: absolute;
        right: 5px;
      }

      .admission-hero h1 {
        font-size: 48px;
        margin-bottom: 20px;
        line-height: 1.2;
      }

      .admission-meta {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        margin-top: 32px;
      }

      .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .meta-item i {
        font-size: 20px;
        color: #C6A43F;
      }

      .deadline-urgent {
        background: #dc2626;
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 8px;
      }

      .deadline-open {
        background: #33ff00;
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 8px;
      }

      .deadline-expired {
        background: #6b7280;
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 8px;
      }

      .admission-content {
        padding: 80px 0;
        background: #F9F7F5;
      }

      .content-layout {
        display: grid;
        grid-template-columns: 2.5fr 1.5fr;
        gap: 60px;
      }

      .main-section {
        background: white;
        border-radius: 30px;
        padding: 48px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      }

      .detail-block {
        margin-bottom: 48px;
      }

      .detail-block:last-child {
        margin-bottom: 0;
      }

      .detail-block h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #0A192F;
        position: relative;
        padding-bottom: 12px;
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

      .detail-block p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 16px;
      }

      .info-box {
        background: #F9F7F5;
        padding: 20px;
        border-radius: 16px;
        margin-bottom: 16px;
      }

      .info-box .label {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #C6A43F;
        font-weight: 600;
        margin-bottom: 8px;
      }

      .info-box .value {
        font-size: 18px;
        font-weight: 600;
        color: #0A192F;
      }

      .sidebar-card {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 32px;
        position: sticky;
        top: 100px;
      }

      .sidebar-card h3 {
        font-size: 22px;
        margin-bottom: 24px;
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

      .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-top: 24px;
      }

      .btn-apply {
        background: #C6A43F;
        color: #0A192F;
        padding: 14px 28px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        text-align: center;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
      }

      .btn-apply:hover {
        background: #b38f2e;
        transform: translateY(-2px);
      }

      .related-posts {
        margin-top: 60px;
        padding-top: 60px;
        border-top: 1px solid #e2e8f0;
      }

      .related-posts h3 {
        font-size: 28px;
        margin-bottom: 32px;
        color: #0A192F;
      }

      .related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
      }

      .related-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: 0.3s;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: block;
      }

      .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
      }

      .related-card-content {
        padding: 20px;
      }

      .related-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #0A192F;
      }

      .related-card p {
        font-size: 14px;
        color: #4a5568;
        margin-bottom: 12px;
      }

      .related-deadline {
        font-size: 12px;
        color: #C6A43F;
      }

      .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        text-decoration: none;
        margin-bottom: 24px;
        font-weight: 500;
        transition: 0.2s;
      }

      .back-button:hover {
        gap: 12px;
        color: #C6A43F;
      }

      @media (max-width: 992px) {
        .content-layout {
          grid-template-columns: 1fr;
        }

        .sidebar-card {
          position: static;
        }

        .related-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 768px) {
        .admission-hero {
          padding: 100px 0 60px;
        }

        .admission-hero h1 {
          font-size: 32px;
        }

        .main-section {
          padding: 32px;
        }

        .related-grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </x-slot:styles>

  <div @class(['admission-hero'])>
    <div @class(['container'])>
      <a @class(['back-button']) href="{{ route('admissions.index') }}">
        <i @class(['fas', 'fa-arrow-left'])></i> Back to Insights
      </a>
      <div @class(['admission-badge'])>
        <i @class(['fas', 'fa-graduation-cap'])></i>
        <span>Admission {{ $admission->year }}</span>
      </div>
      <h1>{{ $admission->title }}</h1>
      @if ($admission->subtitle)
        <p style="font-size: 18px; opacity: 0.9; max-width: 700px;">{{ $admission->subtitle }}</p>
      @endif
      <div @class(['admission-meta'])>
        <div @class(['meta-item'])>
          <i @class(['fas', 'fa-university'])></i>
          <span>{{ $admission->university->name ?? ($admission->university_name ?? 'University') }}</span>
        </div>
        <div @class(['meta-item'])>
          <i @class(['fas', 'fa-map-marker-alt'])></i>
          <span>{{ $admission->country }}</span>
        </div>
        <div @class(['meta-item'])>
          <i @class(['fas', 'fa-calendar-alt'])></i>
          <span>Deadline: {{ \Carbon\Carbon::parse($admission->deadline)->format('F j, Y') }}</span>
          @if ($admission->deadline->isPast())
            <span @class(['deadline-expired'])>Expired</span>
          @elseif ($admission->deadline->greaterThan(now()->addMonths(6)))
            <span @class(['deadline-open'])>Open</span>
          @else
            <span @class(['deadline-urgent'])>Urgent</span>
          @endif
        </div>
        <div @class(['meta-item'])>
          <i @class(['fas', 'fa-book'])></i>
          <span>Program: {{ $admission->program }}</span>
        </div>
      </div>
    </div>
  </div>

  <div @class(['admission-content'])>
    <div @class(['container'])>
      <div @class(['content-layout'])>
        <div @class(['main-section'])>
          <div @class(['detail-block'])>
            <h2>About This Admission</h2>
            <div @class(['detail-block-content'])>
              {!! nl2br(e($admission->content)) !!}
            </div>
          </div>

          <div @class(['detail-block'])>
            <h2>Program Information</h2>
            <div @class(['info-box'])>
              <div @class(['label'])>Program of Study</div>
              <div @class(['value'])>{{ $admission->program }}</div>
            </div>
            <div @class(['info-box'])>
              <div @class(['label'])>Academic Year</div>
              <div @class(['value'])>{{ $admission->year }}</div>
            </div>
            <div @class(['info-box'])>
              <div @class(['label'])>Location</div>
              <div @class(['value'])>{{ $admission->country }}</div>
            </div>
          </div>
        </div>

        <div>
          <div @class(['sidebar-card'])>
            <h3>Key Information</h3>

            <div @class(['info-item'])>
              <span @class(['info-label'])>University</span>
              <span
                @class(['info-value'])>{{ $admission->university->name ?? 'N/A' }}</span>
            </div>
            <div @class(['info-item'])>
              <span @class(['info-label'])>Program</span>
              <span @class(['info-value'])>{{ $admission->program }}</span>
            </div>
            <div @class(['info-item'])>
              <span @class(['info-label'])>Year</span>
              <span @class(['info-value'])>{{ $admission->year }}</span>
            </div>
            <div @class(['info-item'])>
              <span @class(['info-label'])>Country</span>
              <span @class(['info-value'])>{{ $admission->country }}</span>
            </div>
            <div @class(['info-item'])>
              <span @class(['info-label'])>Application Deadline</span>
              <span
                @class(['info-value'])>{{ \Carbon\Carbon::parse($admission->deadline)->format('F j, Y') }}</span>
            </div>

            @if (!\Carbon\Carbon::parse($admission->deadline)->isPast())
              <x-countdown-timer :target="$admission->deadline" label='Time Remaining To Apply' />
            @endif
          </div>

          @if ($admission->university)
            <div @class(['sidebar-card'])>
              <h3>About {{ $admission->university->name }}</h3>
              <p style="color: #4a5568; margin-bottom: 16px; line-height: 1.6;">
                {{ Str::limit(strip_tags($admission->university->content), 150) }}</p>
              <a href="{{ route('universities.university', $admission->university) }}"
                style="color: #C6A43F; text-decoration: none; font-weight: 500;">
                View University Details <i @class(['fas', 'fa-arrow-right'])></i>
              </a>
            </div>
          @endif
        </div>
      </div>

      @if ($relatedAdmissions && count($relatedAdmissions) > 0)
        <div @class(['related-posts'])>
          <h3>Related Admission Opportunities</h3>
          <div @class(['related-grid'])>
            @foreach ($relatedAdmissions as $related)
              <a @class(['related-card'])
                href="{{ route('admissions.admission', $related) }}">
                <div @class(['related-card-content'])>
                  <h4>{{ $related->title }}</h4>
                  <p>{{ Str::limit(strip_tags($related->content), 100) }}</p>
                  <div @class(['related-deadline'])>
                    <i @class(['fas', 'fa-calendar-alt'])></i>
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
