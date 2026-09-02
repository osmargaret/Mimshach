@extends('layouts.app')

@section('title', 'Events | Mimshach')

@section('content')
  @include('components.page-header', [
    'subtitle' => 'Join webinars, university fairs, and networking sessions around the world',
    'title' => 'Upcoming Events'
  ])

  <main id="main-content" class="container mx-auto max-w-[1400px] px-4">
    @include('components.filter-bar', [
      'filters' => $filters,
      'contentId' => 'eventsList',
      'paginationId' => 'paginationContainer',
      'classes' => '-mt-10',
      'disableDark' => 'true'
    ])

    <!-- Events Grid - 4 columns on desktop -->
    @if ($events->isEmpty())
      <div class="my-12 rounded-3xl bg-white px-6 py-12 text-center shadow-sm md:my-16 md:px-10 md:py-16">
        <i class="fas fa-calendar-times mb-5 block text-5xl text-[#C6A43F] md:text-6xl" aria-hidden="true"></i>
        <h2 class="mb-3 text-xl font-bold text-[#0A192F] md:text-2xl">No events found</h2>
        <p class="text-sm text-[#4a5568] md:text-base">Please adjust your filters to see more results.</p>
      </div>
    @else
      <ul role="list" class="my-12 flex flex-col gap-6" id="eventsList">
        @foreach ($events as $event)
          <li role="listitem">
            @include('components.event.event-card', ['event' => $event])
          </li>
        @endforeach
      </ul>
    @endif

    <!-- Pagination -->
    <div id="paginationContainer" class="my-12 flex justify-center md:my-16">
      @if ($events->hasPages())
        {{ $events->links('vendor.pagination.custom') }}
      @endif
    </div>
  </main>
@endsection