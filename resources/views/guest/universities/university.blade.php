@php
  $pageTitle = $university->name . ' | Partner Universities | Mimshach';
@endphp

<x-app-layout :$pageTitle>
  <x-slot:styles>
    <style>
      .uni-detail-hero {
        background: linear-gradient(135deg, rgba(10, 25, 47, 0.92) 0%, rgba(10, 25, 47, 0.85) 100%),
          url('{{ $university->image ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}') center/cover no-repeat;
        padding: 160px 0 80px;
        color: white;
        position: relative;
      }

      .uni-badge {
        display: inline-block;
        background: rgba(198, 164, 63, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 24px;
        border: 1px solid rgba(198, 164, 63, 0.4);
      }

      .uni-detail-hero h1 {
        font-size: 56px;
        margin-bottom: 20px;
        line-height: 1.2;
      }

      .uni-location {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 18px;
        margin-bottom: 24px;
        opacity: 0.9;
      }

      .uni-stats {
        display: flex;
        gap: 40px;
        margin-top: 40px;
        flex-wrap: wrap;
      }

      .uni-stat {
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .uni-stat i {
        font-size: 28px;
        color: #C6A43F;
      }

      .uni-stat span {
        display: flex;
        flex-direction: column;
      }

      .uni-stat strong {
        font-size: 24px;
        font-family: 'Playfair Display', serif;
      }

      .uni-stat small {
        font-size: 14px;
        opacity: 0.8;
      }

      .uni-content {
        padding: 80px 0;
        background: #F9F7F5;
      }

      .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 60px;
      }

      .main-content {
        background: white;
        border-radius: 30px;
        padding: 48px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      }

      .section-block {
        margin-bottom: 48px;
      }

      .section-block:last-child {
        margin-bottom: 0;
      }

      .section-block h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: #0A192F;
        position: relative;
        padding-bottom: 12px;
      }

      .section-block h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: #C6A43F;
      }

      .section-block p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 20px;
      }

      .info-card {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 32px;
        position: sticky;
        top: 100px;
      }

      .info-card h3 {
        font-size: 24px;
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

      .admissions-list {
        display: grid;
        gap: 16px;
        margin-top: 20px;
      }

      .admission-item {
        background: #F9F7F5;
        padding: 20px;
        border-radius: 16px;
        transition: 0.3s;
        border-left: 4px solid #C6A43F;
        text-decoration: none;
        display: block;
      }

      .admission-item:hover {
        transform: translateX(8px);
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      }

      .admission-item h4 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #0A192F;
      }

      .admission-item p {
        color: #4a5568;
        font-size: 14px;
        margin-bottom: 8px;
      }

      .admission-deadline {
        font-size: 13px;
        color: #C6A43F;
        display: flex;
        align-items: center;
        gap: 6px;
      }

      .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #C6A43F;
        text-decoration: none;
        margin-bottom: 24px;
        font-weight: 500;
        transition: 0.2s;
      }

      .back-button:hover {
        gap: 12px;
      }

      @media (max-width: 992px) {
        .content-grid {
          grid-template-columns: 1fr;
        }

        .uni-detail-hero h1 {
          font-size: 40px;
        }

        .info-card {
          position: static;
        }
      }

      @media (max-width: 768px) {
        .uni-detail-hero {
          padding: 120px 0 60px;
        }

        .main-content {
          padding: 32px;
        }

        .uni-stats {
          gap: 20px;
        }
      }
    </style>
  </x-slot:styles>

  <div class="uni-detail-hero">
    <div class="container">
      <a class="back-button" href="{{ route('universities.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Universities
      </a>
      @if ($university->logo)
        <img alt="{{ $university->name }}" src="{{ $university->logo }}"
          style="height: 60px; margin-bottom: 20px; position: absolute; right: 5px;">
      @endif
      <h1>{{ $university->name }}</h1>
      @if ($university->subtitle)
        <p style="font-size: 18px; opacity: 0.9; max-width: 700px;">{{ $university->subtitle }}</p>
      @endif
      <div class="uni-location">
        <i class="fas fa-map-marker-alt"></i>
        <span>{{ $university->city }}, {{ $university->country }}</span>
      </div>
    </div>
  </div>

  <div class="uni-content">
    <div class="container">
      <div class="content-grid">
        <div class="main-content">
          <div class="section-block">
            <h2>About the University</h2>
            <div class="section-block-content">
              {!! nl2br(e($university->content)) !!}
            </div>
          </div>

          @if ($university->admissions && count($university->admissions) > 0)
            <div class="section-block">
              <h2>Admission Opportunities</h2>
              <div class="admissions-list">
                @foreach ($university->admissions as $admission)
                  <a class="admission-item" href="{{ route('admissions.admission', $admission) }}">
                    <h4>{{ $admission->title }}</h4>
                    <p>{{ $admission->subtitle ?? Str::limit($admission->content, 100) }}</p>
                    <div class="admission-deadline">
                      <i class="fas fa-calendar-alt"></i>
                      <span>Deadline:
                        {{ \Carbon\Carbon::parse($admission->deadline)->format('F j, Y') }}</span>
                    </div>
                    <div class="admission-deadline" style="margin-top: 4px;">
                      <i class="fas fa-graduation-cap"></i>
                      <span>Program: {{ $admission->program }}</span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          @endif
        </div>

        <div class="sidebar">
          <div class="info-card">
            <h3>Quick Information</h3>
            <div class="info-item">
              <span class="info-label">Location</span>
              <span class="info-value">{{ $university->city }}, {{ $university->country }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">University Type</span>
              <span class="info-value">Partner Institution</span>
            </div>
            @if ($university->admissions->count() > 0)
              <div class="info-item">
                <span class="info-label">Open Admissions</span>
                <span class="info-value">{{ $university->admissions->count() }} Programs</span>
              </div>
            @endif
          </div>

          <div class="info-card">
            <h3>Get in Touch</h3>
            <p style="color: #4a5568; margin-bottom: 20px;">Interested in studying at
              {{ $university->name }}? Contact us for more information about programs,
              scholarships, and application process.</p>
            <a class="apply-btn" href="{{ route('contact.index') }}"
              style="display: inline-block; background: #C6A43F; color: #0A192F; padding: 14px 28px; border-radius: 50px; text-decoration: none; font-weight: 600; text-align: center; width: 100%;">
              <i class="fas fa-envelope"></i> Request Information
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
