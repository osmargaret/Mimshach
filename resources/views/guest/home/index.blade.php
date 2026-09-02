@php
  $partners = config('data.partners');
  $stats = config('data.stats');
  $services = config('data.services');
  $process_steps = config('data.process_steps');
  $testimonials = config('data.testimonials');
  $benefits = config('data.benefits');
@endphp

@extends('layouts.app')

@section('title', 'Mimshach | Empowering Global Education Dreams')

@section('content')

  <!-- HERO -->
  <section class="relative min-h-screen flex items-center bg-cover bg-center bg-no-repeat text-white"
    data-navbar-theme="light" id='hero'
    style="background-image: linear-gradient(135deg, rgba(10, 25, 47, 0.85) 0%, rgba(10, 25, 47, 0.6) 100%), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80')">
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-2xl animate-fade-up">
        <h1 class="font-['Playfair_Display',serif] text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
          Unlock a World of Opportunities
        </h1>

        <p class="mt-6 text-lg md:text-xl text-white/80 max-w-2xl animate-fade-up animation-delay-200">
          Personalized guidance for your international education journey – from application to arrival and beyond.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-4 animate-fade-up animation-delay-400">
          <a class="bg-[#C6A43F] hover:bg-[#dbb14f] text-[#0A192F] rounded-full px-8 py-3 font-semibold transition-all duration-200 hover:shadow-lg hover:-translate-y-1 text-center"
            href="{{ route('consultation.index') }}">
            Start Your Journey
          </a>

          <a class="rounded-full border-2 border-white px-8 py-3 font-semibold text-white transition-all duration-200 hover:bg-white/10 hover:-translate-y-1 text-center"
            href="#services">
            Explore Services
          </a>
        </div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
      <i class="fas fa-chevron-down text-white/60 text-2xl"></i>
    </div>
  </section>

  <!-- PARTNERS -->
  <section class="border-y border-black/5 bg-white py-6" data-navbar-theme="dark" id='partners'>
    <div class="max-w-350 mx-auto w-[94%] overflow-hidden">
      <div
        class="partners-marquee text-primary/60 flex items-center gap-10 whitespace-nowrap text-sm font-medium">
        @foreach ($partners as $partner)
          <span class="hover:text-accent transition">{{ $partner }}</span>
        @endforeach
        <!-- Duplicate for seamless loop -->
        @foreach ($partners as $partner)
          <span class="hover:text-accent transition">{{ $partner }}</span>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section class="py-20 bg-white" data-navbar-theme="dark" id='about'>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

        <!-- Left Content -->
        <div>
          <span class="text-[#C6A43F] text-sm font-semibold uppercase tracking-wider">
            About Mimshach
          </span>

          <h2 class="font-['Playfair_Display',serif] text-3xl md:text-4xl font-bold text-[#0A192F] mt-3">
            Bridging Dreams & Destinations
          </h2>

          <p class="text-[#4a5568] text-lg mt-6 leading-relaxed">
            For over a decade, Mimshach Education Centre has been the trusted companion for thousands of students.
            We don't just process applications; we mentor, guide, and celebrate every acceptance.
          </p>

          <!-- Stats -->
          <div class="flex flex-wrap gap-8 mt-8">
            @foreach ($stats as $stat)
              <div>
                <div class="font-['Playfair_Display',serif] text-4xl font-bold text-[#C6A43F]">{{ $stat['number'] }}</div>
                <div class="text-[#4a5568] text-sm">{{ $stat['label'] }}</div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Right Images Collage -->
        <div class="grid grid-cols-2 gap-4">
          <img class="col-span-2 w-full h-72 object-cover rounded-2xl shadow-lg hover:scale-105 transition-transform duration-300" src="grad.jpg" alt="Students smiling">
          <img class="w-full h-52 object-cover rounded-2xl shadow-lg hover:scale-105 transition-transform duration-300" src="chri.jpg" alt="Graduation">
          <img class=" w-full h-52 object-cover rounded-2xl shadow-lg hover:scale-105 transition-transform duration-300" src="christy.jpg" alt="Campus library">
        </div>

      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="py-20 bg-[#F0EEE9]" data-navbar-theme="dark" id="services">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

      <span class="text-[#C6A43F] text-sm font-semibold uppercase tracking-wider mb-5">
        Our Services
      </span>

      <h2 class="font-['Playfair_Display',serif] text-3xl md:text-4xl font-bold text-[#0A192F] mt-3">
        Comprehensive Support for International Education
      </h2>

      <p class="text-[#4a5568] text-[18px] mt-6 max-w-2xl">
        We guide you through every stage with personalized care and expertise.
      </p>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
        @foreach ($services as $service)
          <div class="bg-white rounded-2xl px-8 py-10 shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl text-center">

            <div class="text-[#C6A43F] text-5xl mb-4">
              <i class="{{ $service['icon'] }}"></i>
            </div>

            <h3 class="font-['Playfair_Display',serif] text-2xl mb-4 font-semibold text-[#0A192F]">
              {{ $service['title'] }}
            </h3>

            <p class="text-[#4a5568] mt-3 leading-relaxed">
              {{ $service['description'] }}
            </p>

            <a class="text-[#C6A43F] mt-4 flex items-center justify-center gap-2 font-semibold hover:gap-3 transition-all"
              href="{{ route($service['link']) }}">
              Learn More <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        @endforeach
      </div>

      <div class="mt-10 w-full justify-center flex">
        <a href="{{ route('consultation.index') }}" class="text-[#0A192F] font-semibold border-b-2 border-[#C6A43F] pb-1 hover:pb-2 transition-all">
          View all services →
        </a>
      </div>

    </div>
  </section>

  <!-- PROCESS -->
  <section class="py-20 bg-white" data-navbar-theme="dark" id='process'>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

      <span class="text-[#C6A43F] text-sm font-semibold uppercase tracking-wider">
        How We Operate
      </span>

      <h2 class="font-['Playfair_Display',serif] text-3xl md:text-4xl font-bold text-[#0A192F] mt-3">
        Your Journey, Step by Step
      </h2>

      <div class="grid md:grid-cols-3 gap-8 mt-12 relative">
        <!-- Connecting Line (Desktop) -->
        <div class="hidden md:block absolute top-10 left-[9%] right-[9%] h-0.5 bg-[#C6A43F]/30"></div>
        
        @foreach ($process_steps as $index => $step)
          <div class="relative z-10 text-center">
            <div class="w-20 h-20 mx-auto rounded-full border-4 border-[#C6A43F] bg-[#F9F7F5] flex items-center justify-center text-2xl font-bold text-[#0A192F] transition-all duration-300 hover:bg-[#C6A43F] hover:text-white">
              {{ $step['number'] }}
            </div>
            <h4 class="font-['Playfair_Display',serif] text-2xl font-semibold text-[#0A192F] mt-4">{{ $step['title'] }}</h4>
            <p class="text-[#4a5568] mt-2 max-w-[220px] mx-auto">{{ $step['description'] }}</p>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="py-20 bg-[#0A192F] text-white" data-navbar-theme="light" id='testimonials'>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

      <span class="text-white font-semibold uppercase tracking-wider">
        Client Praise
      </span>

      <h2 class="font-['Playfair_Display',serif] text-4xl md:text-5xl font-bold text-white mt-3">
        What Our Students Say
      </h2>

      <div class="grid md:grid-cols-2 gap-10 mt-12">
        @foreach ($testimonials as $testimonial)
          <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 text-left transition-all duration-300 hover:bg-white/10">
            <i class="fas fa-quote-right text-[#C6A43F] text-3xl mb-4 block"></i>
            <p class="text-white/90 leading-relaxed">"{{ $testimonial['quote'] }}"</p>
            <div class="flex items-center gap-4 mt-6">
              <img class="w-12 h-12 rounded-full object-cover border-2 border-[#C6A43F]" src="{{ $testimonial['image'] }}" alt="{{ $testimonial['author'] }}">
              <div>
                <div class="font-semibold text-[#C6A43F]">{{ $testimonial['author'] }}</div>
                <div class="text-white/60 text-sm">{{ $testimonial['position'] }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- WHY CHOOSE US -->
  <section class="py-20 bg-white" data-navbar-theme="dark" id='why'>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

      <span class="text-[#C6A43F] font-semibold uppercase tracking-wider">
        Why Mimshach
      </span>

      <h2 class="font-['Playfair_Display',serif] text-4xl md:text-5xl font-bold text-[#0A192F] mt-3">
        The Difference We Make
      </h2>

      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
        @foreach ($benefits as $benefit)
          <div class="bg-white rounded-xl p-6 transition-all duration-300 hover:bg-[#F0EEE9] hover:-translate-y-1 text-center">
            <div class="text-[#C6A43F] text-4xl mb-3">
              <i class="{{ $benefit['icon'] }}"></i>
            </div>
            <h4 class="font-semibold text-[#0A192F] text-xl">{{ $benefit['title'] }}</h4>
            <p class="text-[#4a5568] text-sm mt-2">{{ $benefit['description'] }}</p>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- Sub-Agent Partnership CTA -->
  <section class="bg-linear-to-r from-[#C6A43F] to-[#dbb14f] py-20 md:py-24" data-navbar-theme="dark" id='cta'>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center text-[#0A192F]">
        <!-- Badge -->
        <span class="inline-flex items-center gap-2 rounded-full bg-[#0A192F]/10 px-4 py-1.5 text-xs md:text-sm font-semibold uppercase tracking-wider text-[#0A192F]">
          🤝 Partnership Opportunity
        </span>

        <!-- Main Title -->
        <h2 class="mt-4 font-['Playfair_Display',serif] text-3xl font-bold md:text-4xl lg:text-5xl">
          Become an MEC Sub-Agent 🌍
        </h2>

        <!-- Subheading -->
        <p class="mt-4 text-lg font-medium opacity-95 md:text-xl">
          Are you an education consultant, student recruiter, or passionate about helping students study abroad?
        </p>

        <!-- Description -->
        <p class="mt-4 text-sm leading-relaxed text-[#0A192F]/85 md:text-base">
          Mimshach Education Centre (MEC) is inviting partners to join our growing sub-agent network. With over 10 years of experience and partnerships across Canada, the USA, Europe, Asia, and beyond, we provide direct access to global admissions and end-to-end recruitment support.
        </p>

        <!-- Benefits Highlights -->
        <div class="mt-8 grid grid-cols-1 gap-4 text-left sm:grid-cols-2 md:grid-cols-3">
          <div class="rounded-2xl bg-white/40 p-4 backdrop-blur-xs transition-all hover:bg-white/60">
            <div class="mb-2 flex items-center gap-2 font-bold text-[#0A192F]">
              <i class="fas fa-university text-[#0A192F]"></i>
              <span class="text-sm">Global Admissions</span>
            </div>
            <p class="text-xs leading-relaxed text-[#0A192F]/80">
              Access trusted university & college partnerships across Canada, the USA, Europe, and Asia.
            </p>
          </div>

          <div class="rounded-2xl bg-white/40 p-4 backdrop-blur-xs transition-all hover:bg-white/60">
            <div class="mb-2 flex items-center gap-2 font-bold text-[#0A192F]">
              <i class="fas fa-passport text-[#0A192F]"></i>
              <span class="text-sm">Visa & Admissions Support</span>
            </div>
            <p class="text-xs leading-relaxed text-[#0A192F]/80">
              Dedicated assistance with applications, documentation, programme selection, and visa processing.
            </p>
          </div>

          <div class="rounded-2xl bg-white/40 p-4 backdrop-blur-xs transition-all hover:bg-white/60 sm:col-span-2 md:col-span-1">
            <div class="mb-2 flex items-center gap-2 font-bold text-[#0A192F]">
              <i class="fas fa-plane-departure text-[#0A192F]"></i>
              <span class="text-sm">Pre-Departure Services</span>
            </div>
            <p class="text-xs leading-relaxed text-[#0A192F]/80">
              Student travel insurance, international SIM cards, and discounted airfares for your clients.
            </p>
          </div>
        </div>

        <p class="mt-8 text-sm font-semibold text-[#0A192F]">
          Partner with MEC and grow your education recruitment opportunities.
        </p>

        <!-- CTA Link -->
        <div class="mt-8">
          <a class="inline-flex items-center gap-2 rounded-full bg-[#0A192F] px-8 py-3.5 text-base font-semibold text-white transition-all duration-200 hover:-translate-y-1 hover:bg-[#1a2f4a] hover:shadow-xl"
            href="{{ route('contact.index') }}">
            <span>📩 Contact Us to Register</span>
            <i class="fas fa-arrow-right text-xs text-[#C6A43F]"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

@endsection

<style>
  /* Animations */
  @keyframes fade-up {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .partners-marquee {
    animation: scroll-left 20s linear infinite;
  }

  @keyframes scroll-left {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-50%);
    }
  }

  .animate-fade-up {
    animation: fade-up 1s ease-out forwards;
    opacity: 0;
  }

  .animation-delay-200 {
    animation-delay: 0.2s;
  }

  .animation-delay-400 {
    animation-delay: 0.4s;
  }

  .animate-bounce {
    animation: bounce 2s infinite;
  }

  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateX(-50%) translateY(0);
    }
    40% {
      transform: translateX(-50%) translateY(-20px);
    }
    60% {
      transform: translateX(-50%) translateY(-10px);
    }
  }

  /* Smooth scrolling */
  html {
    scroll-behavior: smooth;
  }
</style>