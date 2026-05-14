@php
  // Filters and universities are provided by the controller
@endphp

<x-app-layout pageTitle="Partner Universities | Mimshach">
  <x-page-header
    subtitle="Explore top institutions around the world offering programs for international students"
    title="Partner Universities" />

  <div class="container mx-auto max-w-[1400px] px-4">
    <x-filter-bar :$filters contentId="uniGrid" paginationId="paginationContainer" classes='-mt-10' disableDark="true" />

    <!-- Universities Grid - 4 columns on large screens -->
    <div class="my-12 grid grid-cols-1 gap-6 md:my-16 md:grid-cols-2 md:gap-8 lg:grid-cols-3 xl:grid-cols-4" id="uniGrid">
      @if ($universities->isEmpty())
        <div class="col-span-full rounded-3xl bg-white px-6 py-12 text-center shadow-sm md:px-10 md:py-16">
          <i class="fas fa-search mb-5 block text-5xl text-[#C6A43F] md:text-6xl"></i>
          <h3 class="mb-3 text-xl font-bold text-[#0A192F] md:text-2xl">No universities found</h3>
          <p class="text-sm text-[#4a5568] md:text-base">Please adjust your filters to see more results.</p>
        </div>
      @else
        @foreach ($universities as $university)
          <x-university.university-card :$university />
        @endforeach
      @endif
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="my-12 flex justify-center md:my-16">
      @if ($universities->hasPages())
        {{ $universities->links('vendor.pagination.custom') }}
      @endif
    </div>
  </div>
</x-app-layout>