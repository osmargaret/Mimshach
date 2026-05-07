<x-app-layout pageTitle="Blog & Resources | Mimshach">
  <x-page-header 
    subtitle="Expert advice, guides, and resources for your study abroad journey"
    title="Blog & Resources" 
  />

  <div class="container mx-auto max-w-[1400px] px-4">
    <!-- Blog Grid - 4 columns on large screens -->
    <div class="my-12 grid grid-cols-1 gap-6 md:my-16 md:grid-cols-2 md:gap-8 lg:grid-cols-3 xl:grid-cols-4" id="blogGrid">
      @if ($blogs->isEmpty())
        <div class="col-span-full rounded-3xl bg-white px-6 py-12 text-center shadow-sm md:px-10 md:py-16">
          <i class="fas fa-newspaper mb-5 block text-5xl text-[#C6A43F] md:text-6xl"></i>
          <h3 class="mb-3 text-xl font-bold text-[#0A192F] md:text-2xl">No blog posts found</h3>
          <p class="text-sm text-[#4a5568] md:text-base">Check back later for new articles and resources.</p>
        </div>
      @else
        @foreach ($blogs as $blog)
          <x-blog.blog-card :$blog />
        @endforeach
      @endif
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="my-12 flex justify-center md:my-16">
      @if ($blogs->hasPages())
        {{ $blogs->links('vendor.pagination.custom') }}
      @endif
    </div>
  </div>
</x-app-layout>