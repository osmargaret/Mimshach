@props([
  'label',
  'value',
  'icon' => null,
  'color' => 'primary',
  'change' => null,  // New prop for growth/change text
])

<div class="stat-card group relative overflow-hidden rounded-2xl bg-white p-6 shadow-lg transition-all hover:-translate-y-1 duration-300 hover:shadow-xl dark:bg-gray-800">
  <div class="bg-{{ $color }}/10 group-hover:bg-{{ $color }}/20 absolute right-0 top-0 h-32 w-32 -translate-y-8 translate-x-8 transform rounded-full blur-2xl transition-all duration-300"></div>
  <div class="relative">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</p>
        <p class="mt-2 text-4xl font-bold text-gray-800 dark:text-white">{{ $value }}</p>
      </div>
      <div class="bg-{{ $color }}/10 group-hover:bg-{{ $color }}/20 rounded-2xl p-3 transition-all duration-300 group-hover:scale-110">
        @if ($icon)
          {!! $icon !!}
        @endif
      </div>
    </div>
    @if ($change)
      <div class="mt-4 flex items-center space-x-2">
        <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
        </svg>
        <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ $change }}</span>
      </div>
    @endif
  </div>
</div>