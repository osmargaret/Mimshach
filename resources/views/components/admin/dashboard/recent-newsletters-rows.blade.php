@forelse ($recentNewsletters ?? [] as $newsletter)
  <tr class="table-row-hover transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
      {{ $newsletter->email }}
    </td>
    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
      {{ $newsletter->subscribed_at ? $newsletter->subscribed_at->format('M d, Y H:i') : $newsletter->created_at->format('M d, Y H:i') }}
    </td>
    <td class="whitespace-nowrap px-6 py-4">
      @include('components.admin.dashboard.status-badge', ['type' => 'active'])
    </td>
  </tr>
@empty
  <tr>
    <td class="px-6 py-12 text-center text-gray-500 dark:text-gray-400" colspan="3">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
      </svg>
      <p class="mt-2">No subscribers yet</p>
    </td>
  </tr>
@endforelse
