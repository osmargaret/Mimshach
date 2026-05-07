<x-app-layout pageTitle="Funding Opportunities | Study Abroad">
  <x-page-header 
    subtitle="Discover scholarships, grants, and loans to support your study abroad journey"
    title="Funding Opportunities" 
  />

  <div class="container mx-auto max-w-[1200px] px-4">
    <!-- Fundings Grid -->
    <div class="my-12 grid grid-cols-1 gap-6 md:my-16 md:gap-8 lg:grid-cols-2 xl:grid-cols-3" id="fundingsGrid">
      @if ($fundings->isEmpty())
        <div class="col-span-full rounded-3xl bg-white px-6 py-12 text-center shadow-sm md:px-10 md:py-16">
          <i class="fas fa-search mb-5 block text-5xl text-[#C6A43F] md:text-6xl"></i>
          <h3 class="mb-3 text-xl font-bold text-[#0A192F] md:text-2xl">No funding opportunities found</h3>
          <p class="text-sm text-[#4a5568] md:text-base">Please adjust your filters to see more results.</p>
        </div>
      @else
        @foreach ($fundings as $funding)
          <x-funding.funding-card :$funding />
        @endforeach
      @endif
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="my-12 flex justify-center md:my-16">
      @if ($fundings->hasPages())
        {{ $fundings->links('vendor.pagination.custom') }}
      @endif
    </div>
  </div>
</x-app-layout>