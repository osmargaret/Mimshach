{{-- resources/views/guest/fundings/show.blade.php --}}
@php
  $pageTitle = $funding->name . ' | Funding | Study Abroad';
@endphp

<x-app-layout :$pageTitle>
  <x-slot:styles>
    <style>
      .funding-hero {
        background: linear-gradient(135deg, #0A192F 0%, #1a2f4a 100%);
        padding: 140px 0 80px;
        color: white;
        position: relative;
      }

      .funding-hero h1 {
        font-size: 48px;
        margin-bottom: 20px;
        line-height: 1.2;
      }

      .funding-type-badge {
        display: inline-block;
        position: absolute;
        right: 15px;
        background: #C6A43F;
        color: #0A192F;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
      }

      .funding-meta {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
        margin-top: 32px;
      }

      .funding-meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .funding-meta-item i {
        font-size: 24px;
        color: #C6A43F;
      }

      .funding-content {
        padding: 80px 0;
        background: #F9F7F5;
      }

      .funding-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 60px;
      }

      .funding-main {
        background: white;
        border-radius: 30px;
        padding: 48px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      }

      .funding-image {
        width: 100%;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      }

      .funding-description {
        font-size: 18px;
        line-height: 1.8;
        color: #4a5568;
      }

      .funding-description p {
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

      .apply-btn {
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

      .apply-btn:hover {
        background: #b38f2e;
        transform: translateY(-2px);
        cursor: pointer;
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

      .related-section {
        margin-top: 60px;
      }

      .related-section h2 {
        font-size: 28px;
        margin-bottom: 30px;
        font-family: 'Playfair Display', serif;
        color: #0A192F;
      }

      .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
      }

      .related-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
        display: block;
      }

      .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      }

      .related-image {
        height: 160px;
        overflow: hidden;
      }

      .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .related-content {
        padding: 20px;
      }

      .related-card h4 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #0A192F;
      }

      .related-university {
        font-size: 13px;
        color: #C6A43F;
        margin-bottom: 12px;
      }

      .related-description {
        font-size: 13px;
        color: #4a5568;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }

      .share-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 20px;
      }

      .share-btn {
        background: #f0f3ff;
        border: none;
        padding: 8px 16px;
        border-radius: 30px;
        text-decoration: none;
        color: #0A192F;
        font-size: 14px;
        transition: all 0.2s;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
      }

      .share-btn:hover {
        background: #C6A43F;
        color: #0A192F;
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

      .modal-box h3 {
        margin-bottom: 20px;
        color: #0A192F;
      }

      .form-group {
        margin-bottom: 16px;
      }

      .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #0A192F;
      }

      .form-group input,
      .form-group textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
      }

      .form-group input:focus,
      .form-group textarea:focus {
        outline: none;
        border-color: #C6A43F;
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
        z-index: 10000;
      }

      .toast.show {
        opacity: 1;
      }

      @media (max-width: 992px) {
        .funding-layout {
          grid-template-columns: 1fr;
        }

        .sidebar-card {
          position: static;
        }
      }

      @media (max-width: 768px) {
        .funding-hero {
          padding: 100px 0 60px;
        }

        .funding-hero h1 {
          font-size: 32px;
        }

        .funding-main {
          padding: 32px;
        }

        .funding-meta {
          gap: 20px;
        }
      }
    </style>
  </x-slot:styles>

  <div class="funding-hero">
    <div class="container">
      <a class="back-button" href="{{ route('fundings.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Fundings
      </a>

      <div class="funding-type-badge">
        {{ $funding->name }}
      </div>

      <h1>{{ $funding->name }}</h1>
      @if($funding->university)
        <p style="font-size: 18px; opacity: 0.9; max-width: 800px;">
          Offered by {{ $funding->university->name }}
        </p>
      @endif

      <div class="funding-meta">
        <div class="funding-meta-item">
          <i class="fas fa-graduation-cap"></i>
          <div>
            <div>Education Level</div>
            <div style="font-size: 14px; opacity: 0.8;">{{ $funding->education_level }}</div>
          </div>
        </div>
        <div class="funding-meta-item">
          <i class="fas fa-university"></i>
          <div>
            <div>Institution</div>
            <div style="font-size: 14px; opacity: 0.8;">{{ $funding->university->name ?? 'Multiple Partner Universities' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="funding-content">
    <div class="container">
      <div class="funding-layout">
        <div class="funding-main">
          @if($funding->image)
            <img alt="{{ $funding->name }}" class="funding-image" src="{{ $funding->image }}">
          @endif

          <div class="funding-description">
            {!! nl2br(e($funding->description)) !!}
          </div>
        </div>

        <div>
          <div class="sidebar-card">
            <h3>Funding Details</h3>

            <div class="info-item">
              <span class="info-label">Funding Type</span>
              <span class="info-value">{{ $funding->name }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Education Level</span>
              <span class="info-value">{{ $funding->education_level }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Study Destination</span>
              <span class="info-value">{{ $funding->university->country ?? 'International' }}</span>
            </div>
          </div>

          <div class="sidebar-card">
            <h3>Why Choose This Funding?</h3>
            <ul style="list-style: none; padding: 0;">
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-check-circle" style="color: #C6A43F; width: 24px;"></i>
                <span>Competitive benefits and support</span>
              </li>
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-globe" style="color: #C6A43F; width: 24px;"></i>
                <span>Available for international students</span>
              </li>
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-clock" style="color: #C6A43F; width: 24px;"></i>
                <span>Flexible application process</span>
              </li>
              <li style="padding: 12px 0; display: flex; gap: 12px; align-items: center;">
                <i class="fas fa-users" style="color: #C6A43F; width: 24px;"></i>
                <span>Access to global alumni network</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      @if($relatedFundings->count() > 0)
        <div class="related-section">
          <h2>You Might Also Like</h2>
          <div class="related-grid">
            @foreach($relatedFundings as $related)
              <a href="{{ route('fundings.funding', $related->slug) }}" class="related-card">
                <div class="related-image">
                  <img src="{{ $related->image ?? 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80' }}" 
                       alt="{{ $related->name }}">
                </div>
                <div class="related-content">
                  <h4>{{ $related->name }}</h4>
                  <div class="related-university">
                    <i class="fas fa-university"></i> {{ $related->university->name ?? 'Multiple Universities' }}
                  </div>
                  <p class="related-description">{{ Str::limit($related->description, 80) }}</p>
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
      function shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
      }

      function shareOnTwitter() {
        const text = encodeURIComponent('Check out this funding opportunity: {{ $funding->name }}');
        const url = encodeURIComponent(window.location.href);
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank', 'width=600,height=400');
      }

      function shareByEmail() {
        const subject = encodeURIComponent('Funding Opportunity: {{ $funding->name }}');
        const body = encodeURIComponent(`Check out this funding opportunity:\n\n${window.location.href}`);
        window.location.href = `mailto:?subject=${subject}&body=${body}`;
      }
    </script>
  </x-slot:scripts>
</x-app-layout>