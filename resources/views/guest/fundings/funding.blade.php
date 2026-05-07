{{-- resources/views/guest/fundings/show.blade.php --}}
@php
  $pageTitle = $funding->name . ' | Funding | Study Abroad';
@endphp

<x-app-layout :$pageTitle>
  <!-- Hero Section -->
  <div
    class="bg-linear-to-br relative overflow-hidden from-[#0A192F] to-[#1a2f4a] py-28 pb-20 text-white md:py-[140px]">
    <div class="container relative mx-auto max-w-[1200px] px-4">
      <!-- Back Button -->
      <a class="back-button mb-6 inline-flex items-center gap-2 font-medium text-white transition-all duration-300 hover:gap-3 hover:text-[#C6A43F]"
        href="{{ route('fundings.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Fundings
      </a>

      <!-- Badge -->
      <div
        class="absolute right-4 top-2 inline-flex items-center gap-2 rounded-full bg-[#C6A43F] px-4 py-1.5 text-sm font-semibold text-[#0A192F] shadow-lg md:right-5">
        <i class="fas fa-gift"></i>
        <span>{{ $funding->name }}</span>
      </div>

      <!-- Title -->
      <h1 class="mb-5 text-3xl leading-tight md:text-5xl lg:text-6xl">{{ $funding->name }}</h1>

      <!-- University Info -->
      @if ($funding->university)
        <p class="max-w-[800px] text-base opacity-90 md:text-lg">
          Offered by {{ $funding->university->name }}
        </p>
      @endif

      <!-- Meta Information -->
      <div class="mt-8 flex flex-wrap gap-6 md:gap-8">
        <div class="flex items-start gap-3">
          <i class="fas fa-graduation-cap text-2xl text-[#C6A43F]"></i>
          <div>
            <div class="text-sm opacity-75">Education Level</div>
            <div class="text-base font-medium">{{ $funding->education_level }}</div>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <i class="fas fa-university text-2xl text-[#C6A43F]"></i>
          <div>
            <div class="text-sm opacity-75">Institution</div>
            <div class="text-base font-medium">
              {{ $funding->university->name ?? 'Multiple Partner Universities' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="bg-[#F9F7F5] py-12 md:py-20">
    <div class="container mx-auto max-w-[1200px] px-4">
      <div class="flex flex-col gap-12 lg:grid lg:grid-cols-[2fr_1fr] lg:gap-16">

        <!-- Left Column - Main Content -->
        <div class="rounded-3xl bg-white p-6 shadow-md md:p-8 lg:p-12">
          @if ($funding->image)
            <img alt="{{ $funding->name }}" class="mb-8 w-full rounded-2xl shadow-lg"
              src="{{ Storage::url($funding->image) }}">
          @endif

          <div class="prose prose-lg max-w-none leading-relaxed text-[#4a5568]">
            {!! nl2br(e($funding->description)) !!}
          </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-8">
          <!-- Funding Details Card -->
          <div
            class="sticky top-[100px] max-h-[calc(100vh-120px)] overflow-y-auto rounded-2xl bg-white p-6 shadow-md md:p-8">
            <h3 class="mb-6 text-2xl font-bold text-[#0A192F]">Funding Details</h3>

            <div class="space-y-0 divide-y divide-gray-100">
              <div class="flex justify-between py-4">
                <span class="font-semibold text-[#0A192F]">Funding Type</span>
                <span class="text-right text-[#4a5568]">{{ $funding->name }}</span>
              </div>
              <div class="flex justify-between py-4">
                <span class="font-semibold text-[#0A192F]">Education Level</span>
                <span class="text-right text-[#4a5568]">{{ $funding->education_level }}</span>
              </div>
              <div class="flex justify-between py-4">
                <span class="font-semibold text-[#0A192F]">Study Destination</span>
                <span
                  class="text-right text-[#4a5568]">{{ $funding->university->country ?? 'International' }}</span>
              </div>
            </div>
          </div>

          <!-- Why Choose This Funding Card -->
          <div
            class="sticky top-[100px] max-h-[calc(100vh-120px)] overflow-y-auto rounded-2xl bg-white p-6 shadow-md md:p-8">
            <h3 class="mb-6 text-xl font-bold text-[#0A192F] md:text-2xl">Why Choose This Funding?
            </h3>
            <ul class="space-y-4">
              <li class="flex items-center gap-3">
                <i class="fas fa-check-circle w-6 text-[#C6A43F]"></i>
                <span class="text-[#4a5568]">Competitive benefits and support</span>
              </li>
              <li class="flex items-center gap-3">
                <i class="fas fa-globe w-6 text-[#C6A43F]"></i>
                <span class="text-[#4a5568]">Available for international students</span>
              </li>
              <li class="flex items-center gap-3">
                <i class="fas fa-clock w-6 text-[#C6A43F]"></i>
                <span class="text-[#4a5568]">Flexible application process</span>
              </li>
              <li class="flex items-center gap-3">
                <i class="fas fa-users w-6 text-[#C6A43F]"></i>
                <span class="text-[#4a5568]">Access to global alumni network</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Related Fundings Section -->
      @if ($relatedFundings->count() > 0)
        <div class="relative z-10 mt-16 border-t border-gray-200 pt-12 md:mt-20 md:pt-16">
          <h2 class="mb-8 text-2xl font-bold text-[#0A192F] md:text-3xl">You Might Also Like</h2>
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($relatedFundings as $related)
              <a class="group block rounded-2xl bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                href="{{ route('fundings.funding', $related->slug) }}">
                <div class="h-40 overflow-hidden rounded-t-2xl">
                  <img alt="{{ $related->name }}"
                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                    src="{{ $related->image ?? 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80' }}">
                </div>
                <div class="p-5">
                  <h4
                    class="mb-2 text-lg font-bold text-[#0A192F] transition-colors group-hover:text-[#C6A43F]">
                    {{ $related->name }}
                  </h4>
                  <div class="mb-3 flex items-center gap-2 text-sm text-[#C6A43F]">
                    <i class="fas fa-university"></i>
                    <span>{{ $related->university->name ?? 'Multiple Universities' }}</span>
                  </div>
                  <p class="line-clamp-2 text-sm text-[#4a5568]">
                    {{ Str::limit($related->description, 80) }}</p>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
