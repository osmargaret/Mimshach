@props([
    'title',
    'subtitle',
    'headers',
    'rows',
    'fields' => [],
    'viewAllRoute' => '#',
    'emptyMessage' => 'No data available',
    'emptyIcon' => 'inbox'
])

<div
  class="overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-300 hover:shadow-xl dark:bg-gray-800">
  <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $title }}</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $subtitle }}</p>
      </div>
    </div>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
      <thead class="bg-gray-50 dark:bg-gray-900">
        <tr>
          @foreach ($headers as $header)
            <th
              class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
              {{ $header }}
            </th>
          @endforeach
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
        @if ($slot->isNotEmpty())
          {{ $slot }}
        @else
          @forelse($rows as $row)
            <tr class="table-row-hover transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
              <td
                class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                {{ $row->name }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                {{ $row->email }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                {{ $row->created_at->format('M d, Y') }}
              </td>
              <td class="whitespace-nowrap px-6 py-4">
                <x-admin.dashboard.status-badge type="new" />
              </td>
            </tr>
          @empty
            <tr>
              <td class="px-6 py-12 text-center text-gray-500 dark:text-gray-400"
                colspan="{{ count($headers) }}">
                @if ($emptyIcon === 'inbox')
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  </svg>
                @elseif($emptyIcon === 'calendar')
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  </svg>
                @elseif($emptyIcon === 'email')
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  </svg>
                @endif
                <p class="mt-2">{{ $emptyMessage }}</p>
              </td>
            </tr>
          @endforelse
        @endif
      </tbody>
    </table>
  </div>
</div>
