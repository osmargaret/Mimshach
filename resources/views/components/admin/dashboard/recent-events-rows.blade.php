@forelse ($recentEvents ?? [] as $event)
  <tr class="table-row-hover transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
      {{ $event->title }}
    </td>
    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
      {{ $event->location }}
    </td>
    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
      {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
    </td>
    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
      {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
    </td>
    <td class="whitespace-nowrap px-6 py-4">
      @include('components.admin.dashboard.status-badge', ['type' => 'upcoming'])
    </td>
  </tr>
@empty
  <tr>
    <td class="px-6 py-12 text-center text-gray-500 dark:text-gray-400" colspan="5">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
      </svg>
      <p class="mt-2">No upcoming events</p>
    </td>
  </tr>
@endforelse
