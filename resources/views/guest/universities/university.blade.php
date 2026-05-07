@php
  $pageTitle = $university->name . ' | Partner Universities | Mimshach';
@endphp

<x-app-layout :$pageTitle>
  <!-- Hero Section -->
  <div class="relative bg-cover bg-center bg-no-repeat" 
       style="background-image: linear-gradient(135deg, rgba(10, 25, 47, 0.92) 0%, rgba(10, 25, 47, 0.85) 100%), url('{{ Storage::url($university->image) }}');">
    <div class="py-28 pb-20 text-white md:py-[160px]">
      <div class="container mx-auto max-w-[1200px] px-4">
        <!-- Back Button -->
        <a href="{{ route('universities.index') }}" class="back-button mb-6 inline-flex items-center gap-2 font-medium text-[#C6A43F] transition-all duration-300 hover:gap-3">
          <i class="fas fa-arrow-left"></i> Back to Universities
        </a>

        <!-- Logo -->
        @if ($university->logo)
          <div class="flex justify-end">
            <img alt="{{ $university->name }}" src="{{ Storage::url($university->logo) }}" class="h-12 object-contain md:h-20">
          </div>
        @endif

        <!-- Title -->
        <h1 class="mb-5 text-3xl leading-tight md:text-5xl lg:text-6xl">{{ $university->name }}</h1>

        <!-- Subtitle -->
        @if ($university->subtitle)
          <p class="max-w-[700px] text-base opacity-90 md:text-lg">{{ $university->subtitle }}</p>
        @endif

        <!-- Location -->
        <div class="mt-4 flex items-center gap-3 text-base md:text-lg">
          <i class="fas fa-map-marker-alt text-[#C6A43F]"></i>
          <span>{{ $university->city }}, {{ $university->country }}</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="bg-[#F9F7F5] py-12 md:py-20">
    <div class="container mx-auto max-w-[1200px] px-4">
      <div class="flex flex-col gap-12 lg:grid lg:grid-cols-[2fr_1fr] lg:gap-16">
        
        <!-- Left Column - Main Content -->
        <div class="space-y-12">
          <!-- About Section -->
          <div class="rounded-3xl bg-white p-6 shadow-md md:p-8 lg:p-12">
            <h2 class="relative mb-6 pb-3 text-2xl font-bold text-[#0A192F] after:absolute after:bottom-0 after:left-0 after:h-1 after:w-16 after:bg-[#C6A43F] md:text-3xl">
              About the University
            </h2>
            <div class="prose prose-lg max-w-none text-[#4a5568] leading-relaxed">
              {!! nl2br(e($university->content)) !!}
            </div>
          </div>

          <!-- Admissions Section -->
          @if ($university->admissions && count($university->admissions) > 0)
            <div class="rounded-3xl bg-white p-6 shadow-md md:p-8 lg:p-12">
              <h2 class="relative mb-6 pb-3 text-2xl font-bold text-[#0A192F] after:absolute after:bottom-0 after:left-0 after:h-1 after:w-16 after:bg-[#C6A43F] md:text-3xl">
                Admission Opportunities
              </h2>
              <div class="space-y-4">
                @foreach ($university->admissions as $admission)
                  <a href="{{ route('admissions.admission', $admission) }}" 
                     class="group block rounded-xl border-l-4 border-[#C6A43F] bg-[#F9F7F5] p-5 transition-all duration-300 hover:translate-x-2 hover:bg-white hover:shadow-md">
                    <h4 class="mb-2 text-lg font-bold text-[#0A192F] transition-colors group-hover:text-[#C6A43F]">
                      {{ $admission->title }}
                    </h4>
                    <p class="mb-3 text-sm text-[#4a5568]">{{ $admission->subtitle ?? Str::limit($admission->content, 100) }}</p>
                    <div class="flex flex-wrap gap-4 text-xs text-[#C6A43F] md:text-sm">
                      <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Deadline: {{ \Carbon\Carbon::parse($admission->deadline)->format('F j, Y') }}</span>
                      </div>
                      <div class="flex items-center gap-2">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Program: {{ $admission->program }}</span>
                      </div>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          @endif
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-8">
          <!-- Quick Information Card -->
          <div class="sticky top-[100px] max-h-[calc(100vh-120px)] overflow-y-auto rounded-2xl bg-white p-6 shadow-md md:p-8">
            <h3 class="mb-6 text-2xl font-bold text-[#0A192F]">Quick Information</h3>

            <div class="space-y-0 divide-y divide-gray-100">
              <div class="flex justify-between py-4">
                <span class="font-semibold text-[#0A192F]">Location</span>
                <span class="text-right text-[#4a5568]">{{ $university->city }}, {{ $university->country }}</span>
              </div>
              <div class="flex justify-between py-4">
                <span class="font-semibold text-[#0A192F]">University Type</span>
                <span class="text-right text-[#4a5568]">Partner Institution</span>
              </div>
              @if ($university->admissions->count() > 0)
                <div class="flex justify-between py-4">
                  <span class="font-semibold text-[#0A192F]">Open Admissions</span>
                  <span class="text-right text-[#4a5568]">{{ $university->admissions->count() }} Programs</span>
                </div>
              @endif
            </div>
          </div>

          <!-- Contact Card -->
          <div class="sticky top-[100px] max-h-[calc(100vh-120px)] overflow-y-auto rounded-2xl bg-white p-6 shadow-md md:p-8">
            <h3 class="mb-4 text-xl font-bold text-[#0A192F] md:text-2xl">Get in Touch</h3>
            <p class="mb-5 leading-relaxed text-[#4a5568]">
              Interested in studying at {{ $university->name }}? Contact us for more information about programs, scholarships, and application process.
            </p>
            <a href="{{ route('contact.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#C6A43F] px-6 py-3 font-semibold text-[#0A192F] transition-all duration-300 hover:bg-[#b38f2e] hover:-translate-y-0.5 hover:shadow-lg">
              <i class="fas fa-envelope"></i> Request Information
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot:styles>
    <style>
      .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      
      .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      
      /* Custom scrollbar for sidebar */
      .sticky::-webkit-scrollbar {
        width: 6px;
      }
      
      .sticky::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
      }
      
      .sticky::-webkit-scrollbar-thumb {
        background: #C6A43F;
        border-radius: 10px;
      }
      
      .sticky::-webkit-scrollbar-thumb:hover {
        background: #b38f2e;
      }
    </style>
  </x-slot:styles>
</x-app-layout>