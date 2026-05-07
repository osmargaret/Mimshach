@props(['university' => []])

<div class="group rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
  <div class="h-44 rounded-t-2xl bg-cover bg-center" style="background-image: url('{{ $university->image ? Storage::url($university->image) : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}'); background-size: cover; background-position: center;">
  </div>
  <div class="p-5">
    <h3 class="mb-2 text-xl font-bold text-[#0A192F] transition-colors group-hover:text-[#C6A43F]">
      <a href="{{ route('universities.university', $university) }}">{{ $university->name }}</a>
    </h3>
    <div class="mb-3 flex items-center gap-2 text-sm font-medium text-[#C6A43F]">
      <i class="fas fa-map-marker-alt"></i>
      <span>{{ $university->country }}</span>
    </div>
    <p class="mb-4 text-sm text-[#4a5568] line-clamp-2">{{ $university->subtitle }}</p>
    
    <!-- Funding Tags - Using the existing fundings relationship -->
    <div class="mb-4 flex flex-wrap gap-2">
      @php
        // Get unique funding types from the university's fundings relationship
        $fundingTypes = $university->fundings->pluck('name')->unique();
      @endphp
      @forelse($fundingTypes as $fundingName)
        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-[#0A192F]">
          @if ($fundingName === 'Grant')
            <i class="fas fa-gift text-[#C6A43F]"></i>
          @elseif($fundingName === 'Scholarship')
            <i class="fas fa-trophy text-[#C6A43F]"></i>
          @elseif($fundingName === 'Loan')
            <i class="fas fa-hand-holding-usd text-[#C6A43F]"></i>
          @elseif($fundingName === 'Fellowship')
            <i class="fas fa-star text-[#C6A43F]"></i>
          @elseif($fundingName === 'Bursary')
            <i class="fas fa-coins text-[#C6A43F]"></i>
          @endif
          {{ $fundingName }}
        </span>
      @empty
        <!-- Optional: Show no funding available badge -->
        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-500">
          <i class="fas fa-info-circle"></i>
          No funding available
        </span>
      @endforelse
    </div>
    
    <!-- Footer -->
    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
      <a href="{{ route('universities.university', $university) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#C6A43F] transition-all group-hover:gap-3">
        Explore <i class="fas fa-arrow-right"></i>
      </a>
      <span class="text-xs font-medium text-[#C6A43F]">Apply now</span>
    </div>
  </div>
</div>