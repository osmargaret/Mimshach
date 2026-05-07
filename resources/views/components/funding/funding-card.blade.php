@props(['funding'])

<a href="{{ route('fundings.funding', $funding) }}" class="group block rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
  <div class="relative h-48 overflow-hidden rounded-t-2xl">
    <img src="{{ Storage::url($funding->image) }}" 
         alt="{{ $funding->name }}"
         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
    <div class="absolute right-3 top-3 rounded-full bg-accent px-3 py-1.5 text-xs font-bold uppercase text-primary shadow-md">
      {{ $funding->name }}
    </div>
  </div>
  <div class="p-5">
    <h3 class="mb-2 text-xl font-bold text-primary transition-colors group-hover:text-accent">
      {{ $funding->name }}
    </h3>
    <div class="mb-3 flex items-center gap-2 text-sm text-accent">
      <i class="fas fa-university"></i>
      <span>{{ $funding->university->name ?? 'Multiple Partner Universities' }}</span>
    </div>
    <p class="mb-4 text-sm text-[#4a5568] line-clamp-3">{{ Str::limit($funding->description, 120) }}</p>
    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
      <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-primary">
        <i class="fas fa-graduation-cap text-accent"></i>
        {{ $funding->education_level }}
      </span>
      <span class="inline-flex items-center gap-2 text-sm font-semibold text-accent transition-all group-hover:gap-3">
        View Details <i class="fas fa-arrow-right"></i>
      </span>
    </div>
  </div>
</a>