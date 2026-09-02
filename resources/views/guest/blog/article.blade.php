@php
  $pageTitle = $article->title . ' | Blog | Mimshach';
  $fallbackHeroImage = 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80';
  $heroImageUrl = $article->featured_image_url ?: $fallbackHeroImage;
  $currentUrl = urlencode(url()->current());
  $shareTitle = urlencode($article->title);
@endphp

@extends('layouts.app')

@section('title', $pageTitle)

@section('styles')
  <style>
    .blog-body {
      font-size: 18px;
      line-height: 1.8;
      color: #4a5568;
    }

    .blog-body p {
      margin-bottom: 24px;
    }

    .blog-body h2 {
      font-size: 28px;
      margin: 40px 0 20px;
      color: #0A192F;
      font-family: 'Playfair Display', serif;
      font-weight: 700;
    }

    .blog-body h3 {
      font-size: 24px;
      margin: 32px 0 16px;
      color: #0A192F;
      font-weight: 600;
    }

    .blog-body ul,
    .blog-body ol {
      margin: 20px 0;
      padding-left: 24px;
    }

    .blog-body li {
      margin-bottom: 10px;
    }

    .blog-body blockquote {
      border-left: 4px solid #C6A43F;
      padding: 20px 30px;
      margin: 30px 0;
      background: #F9F7F5;
      font-style: italic;
      border-radius: 0 16px 16px 0;
    }

    .hero-text-shadow {
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
    }

    .share-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      border-radius: 0.75rem;
      padding: 0.625rem 0.875rem;
      font-size: 0.75rem;
      font-weight: 600;
      color: #ffffff !important;
      text-decoration: none;
      transition: all 0.2s ease-in-out;
      flex: 1 1 0%;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .share-btn:hover {
      opacity: 0.9;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      color: #ffffff !important;
    }

    .share-btn.facebook {
      background-color: #1877F2 !important;
    }

    .share-btn.twitter {
      background-color: #000000 !important;
    }

    .share-btn.linkedin {
      background-color: #0A66C2 !important;
    }

    .share-btn.whatsapp {
      background-color: #25D366 !important;
    }

    .blog-layout-grid {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    @media (min-width: 1024px) {
      .blog-layout-grid {
        display: grid !important;
        grid-template-columns: 9fr 3fr !important;
        gap: 3rem !important;
        align-items: start !important;
      }

      .blog-main-col {
        grid-column: 1 / 2 !important;
        min-width: 0 !important;
      }

      .blog-sidebar-col {
        grid-column: 2 / 3 !important;
        min-width: 0 !important;
      }
    }
  </style>
@endsection

@section('content')

  <!-- Hero Section with Reduced Gradient so Image Shows Clearly -->
  <div class="relative bg-cover bg-center bg-no-repeat text-white" 
       style="background-image: linear-gradient(180deg, rgba(10, 25, 47, 0.45) 0%, rgba(10, 25, 47, 0.65) 100%), url('{{ $heroImageUrl }}');">
    <div class="py-28 pb-20 md:py-[150px]">
      <div class="container mx-auto max-w-[1200px] px-4">
        <!-- Back Button -->
        <a class="hero-text-shadow mb-6 inline-flex items-center gap-2 font-medium text-white transition-all duration-300 hover:gap-3 hover:text-[#C6A43F]"
          href="{{ route('blogs.index') }}">
          <i class="fas fa-arrow-left"></i> Back to Blog
        </a>

        <!-- Title -->
        <h1 class="hero-text-shadow mb-5 max-w-[950px] font-['Playfair_Display',serif] text-3xl font-bold leading-tight md:text-5xl lg:text-6xl">
          {{ $article->title }}
        </h1>

        <!-- Subtitle -->
        @if ($article->subtitle)
          <p class="hero-text-shadow max-w-[800px] text-lg text-white/90 md:text-xl">{{ $article->subtitle }}</p>
        @endif

        <!-- Meta Information -->
        <div class="hero-text-shadow mt-8 flex flex-wrap items-center gap-6 text-sm text-white/90 md:text-base">
          <div class="flex items-center gap-2">
            <i class="fas fa-user text-[#C6A43F]"></i>
            <span>{{ $article->user->name ?? 'Admin' }}</span>
          </div>
          <div class="flex items-center gap-2">
            <i class="fas fa-calendar-alt text-[#C6A43F]"></i>
            <span>{{ $article->created_at->format('F j, Y') }}</span>
          </div>
          <div class="flex items-center gap-2">
            <i class="fas fa-clock text-[#C6A43F]"></i>
            <span>{{ $article->created_at->diffForHumans() }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content Section with Restored Sidebar -->
  <div class="bg-[#F9F7F5] py-12 md:py-20">
    <div class="container mx-auto max-w-[1200px] px-4">
      <div class="blog-layout-grid">
        
        <!-- Left Column: Main Article Body (9 cols / 75%) -->
        <div class="blog-main-col space-y-10">
          <article class="rounded-3xl bg-white p-6 shadow-md md:p-10 lg:p-12">
            <div class="blog-body">
              {!! nl2br(e($article->content)) !!}
            </div>

            <!-- Author Card -->
            <div class="mt-12 flex flex-col items-center gap-6 border-t-2 border-gray-100 pt-8 sm:flex-row sm:items-center">
              <div class="flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-full bg-[#C6A43F] text-2xl font-bold text-white shadow-md">
                {{ strtoupper(substr($article->user->name ?? 'A', 0, 1)) }}
              </div>
              <div class="text-center sm:text-left">
                <h4 class="font-['Playfair_Display',serif] text-xl font-bold text-[#0A192F]">
                  {{ $article->user->name ?? 'Mimshach Team' }}
                </h4>
                <p class="text-sm text-gray-500">Education Consultant & Content Contributor</p>
              </div>
            </div>
          </article>
        </div>

        <!-- Right Column: Sidebar (3 cols / 25%) -->
        <aside class="blog-sidebar-col space-y-8">
          <!-- Share Card -->
          <div class="rounded-3xl bg-white p-6 shadow-md md:p-8">
            <h3 class="mb-4 font-['Playfair_Display',serif] text-xl font-bold text-[#0A192F]">
              Share this Article
            </h3>
            <div class="grid grid-cols-2 gap-2.5 sm:flex sm:flex-wrap">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener noreferrer"
                class="share-btn facebook" style="background-color: #1877F2 !important; color: #ffffff !important;"
                title="Share on Facebook">
                <i class="fab fa-facebook-f"></i> Facebook
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener noreferrer"
                class="share-btn twitter" style="background-color: #000000 !important; color: #ffffff !important;"
                title="Share on X / Twitter">
                <i class="fab fa-x-twitter"></i> Twitter
              </a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}" target="_blank" rel="noopener noreferrer"
                class="share-btn linkedin" style="background-color: #0A66C2 !important; color: #ffffff !important;"
                title="Share on LinkedIn">
                <i class="fab fa-linkedin-in"></i> LinkedIn
              </a>
              <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $currentUrl }}" target="_blank" rel="noopener noreferrer"
                class="share-btn whatsapp" style="background-color: #25D366 !important; color: #ffffff !important;"
                title="Share on WhatsApp">
                <i class="fab fa-whatsapp"></i> WhatsApp
              </a>
            </div>
          </div>

          <!-- Recent Posts Card -->
          @if ($recentBlogs && count($recentBlogs) > 0)
            <div class="sticky top-24 rounded-3xl bg-white p-6 shadow-md md:p-8">
              <h3 class="mb-6 font-['Playfair_Display',serif] text-2xl font-bold text-[#0A192F]">
                Recent Posts
              </h3>
              <ul class="divide-y divide-gray-100">
                @foreach ($recentBlogs as $recent)
                  <li class="py-4 first:pt-0 last:pb-0">
                    <a class="group block" href="{{ route('blogs.article', $recent) }}">
                      <h4 class="text-base font-semibold text-[#0A192F] transition-colors group-hover:text-[#C6A43F]">
                        {{ $recent->title }}
                      </h4>
                      <span class="mt-1 block text-xs font-medium text-[#C6A43F]">
                        {{ $recent->created_at->format('M d, Y') }}
                      </span>
                    </a>
                  </li>
                @endforeach
              </ul>

              <!-- Consultation CTA Banner in Sidebar -->
              <div class="mt-8 rounded-2xl bg-linear-to-br from-[#0A192F] to-[#1a2f4a] p-6 text-center text-white shadow-lg">
                <i class="fas fa-graduation-cap mb-3 text-3xl text-[#C6A43F]"></i>
                <h4 class="mb-2 font-['Playfair_Display',serif] text-lg font-bold text-white">
                  Need Study Abroad Guidance?
                </h4>
                <p class="mb-5 text-xs text-white/80">
                  Book a personalized one-on-one session with our experienced consultants.
                </p>
                <a href="{{ route('consultation.index') }}"
                  class="inline-block w-full rounded-full bg-[#C6A43F] px-4 py-2.5 text-xs font-semibold text-[#0A192F] transition-all duration-200 hover:bg-[#dbb14f] hover:shadow-md">
                  Book Free Consultation
                </a>
              </div>
            </div>
          @endif
        </aside>

      </div>
    </div>
  </div>

@endsection
