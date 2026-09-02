@props(['blog' => []])

@php
  $fallbackImage = 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80';
  $imageUrl = $blog->featured_image_url ?: $fallbackImage;
@endphp

<div class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
  <!-- Thumbnail Image -->
  <a href="{{ route('blogs.article', $blog) }}" class="relative block h-48 w-full overflow-hidden bg-gray-100 sm:h-52">
    <img
      src="{{ $imageUrl }}"
      alt="{{ $blog->title }}"
      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
      loading="lazy"
    >
  </a>

  <!-- Card Body -->
  <div class="flex flex-1 flex-col p-5 sm:p-6">
    <div class="mb-3 flex items-center justify-between text-xs text-gray-500">
      <span class="font-medium text-[#C6A43F]">{{ $blog->created_at->format('M j, Y') }}</span>
      @if ($blog->user)
        <span class="inline-flex items-center gap-1.5 text-gray-600">
          <i class="fas fa-user text-[10px] text-[#C6A43F]"></i>
          {{ $blog->user->name }}
        </span>
      @endif
    </div>

    <h3 class="mb-2 line-clamp-2 font-['Playfair_Display',serif] text-xl font-bold text-[#0A192F] transition-colors group-hover:text-[#C6A43F]">
      <a href="{{ route('blogs.article', $blog) }}">
        {{ $blog->title }}
      </a>
    </h3>

    @if ($blog->subtitle)
      <p class="mb-4 line-clamp-2 text-sm text-[#4a5568] leading-relaxed">
        {{ $blog->subtitle }}
      </p>
    @endif

    <!-- Card Footer -->
    <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-4">
      <a href="{{ route('blogs.article', $blog) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#C6A43F] transition-all group-hover:gap-3">
        Read More <i class="fas fa-arrow-right text-xs"></i>
      </a>
    </div>
  </div>
</div>
