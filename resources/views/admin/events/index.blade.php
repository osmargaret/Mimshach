<x-admin-layout pageTitle="Events Management">
  <div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h2
          class="from-primary to-accent bg-gradient-to-r bg-clip-text text-2xl font-bold text-transparent">
          Events
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your events and event
          registrations</p>
      </div>
      <a class="from-primary to-accent inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:shadow-xl"
        href="{{ route('admin.events.create') }}">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
          </path>
        </svg>
        Create Event
      </a>
    </div>

    <!-- Events Table -->
    <div class="overflow-hidden rounded-2xl bg-white shadow-lg dark:bg-gray-800">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead
            class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
            <tr>
              <th
                class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 dark:text-gray-300">
                Image</th>
              <th
                class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 dark:text-gray-300">
                Title</th>
              <th
                class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 dark:text-gray-300">
                Date</th>
              <th
                class="hidden px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 md:table-cell dark:text-gray-300">
                Location</th>
              <th
                class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 dark:text-gray-300">
                Registrations</th>
              <th
                class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 dark:text-gray-300">
                Status</th>
              <th
                class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 sm:px-6 dark:text-gray-300">
                Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
            @php
              $hasEvents = isset($events) && $events->count() > 0;
            @endphp

            @if ($hasEvents)
              @foreach ($events as $event)
                @php
                  $now = now();
                  $eventDate = null;
                  $startDateTime = null;
                  $endDateTime = null;
                  $isPast = false;
                  $statusColor = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                  $statusLabel = 'Draft';
                  $formattedDate = 'Date not set';
                  $daysUntil = null;

                  // Handle date properly - it should be a simple Y-m-d date
                  if (isset($event->date) && !empty($event->date)) {
                      try {
                          // Parse just the date (Y-m-d format)
                          $eventDate = \Carbon\Carbon::parse($event->date);
                          $formattedDate = $eventDate->format('M d, Y');

                          // Create start and end datetimes for status calculation
                          $startTime = $event->start_time ?? '00:00:00';
                          $endTime = $event->end_time ?? '23:59:59';

                          $startDateTime = \Carbon\Carbon::parse($event->date . ' ' . $startTime);
                          $endDateTime = \Carbon\Carbon::parse($event->date . ' ' . $endTime);

                          // Calculate days until event
                          $daysUntil = $now->diffInDays($eventDate, false);

                          // Status determination
                          if ($now->gt($endDateTime)) {
                              $statusColor =
                                  'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                              $statusLabel = 'Completed';
                              $isPast = true;
                          } elseif ($now->between($startDateTime, $endDateTime)) {
                              $statusColor =
                                  'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                              $statusLabel = 'Ongoing';
                              $isPast = false;
                          } else {
                              $statusColor =
                                  'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                              $statusLabel = 'Upcoming';
                              $isPast = false;
                          }
                      } catch (\Exception $e) {}
                  }
                @endphp
                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                    @if (!empty($event->image))
                      <img alt="{{ $event->title }}" class="h-12 w-12 rounded-lg object-cover"
                        src="{{ $event->image }}">
                    @else
                      <div
                        class="from-primary/10 to-accent/10 flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br">
                        <svg class="text-primary h-6 w-6" fill="none" stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                      </div>
                    @endif
                  </td>
                  <td class="px-4 py-4 sm:px-6">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                      {{ $event->title ?? 'Untitled' }}</div>
                    @if (!empty($event->subtitle))
                      <div class="text-xs text-gray-500 dark:text-gray-400">{{ $event->subtitle }}
                      </div>
                    @endif
                  </td>
                  <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                    @if ($eventDate)
                      <div class="flex flex-col">
                        <span
                          class="{{ $isPast ? 'text-gray-500' : 'text-gray-900 dark:text-white' }} text-sm font-medium">
                          {{ $formattedDate }}
                        </span>
                        @if ($statusLabel === 'Upcoming' && $daysUntil !== null && $daysUntil >= 0)
                          <span class="text-xs text-green-600 dark:text-green-400">
                            @if ($daysUntil == 0)
                              Tomorrow
                            @elseif($daysUntil == 1)
                              Tomorrow
                            @else
                              {{ $daysUntil }} days away
                            @endif
                          </span>
                        @elseif($statusLabel === 'Ongoing')
                          <span class="text-xs text-green-600 dark:text-green-400">
                            Happening now!
                          </span>
                        @elseif($statusLabel === 'Completed')
                          <span class="text-xs text-gray-500">
                            Ended
                          </span>
                        @endif
                      </div>
                    @else
                      <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Date not set</span>
                        <span class="text-xs text-red-500">Please edit to add date</span>
                      </div>
                    @endif
                  </td>
                  <td
                    class="hidden px-4 py-4 text-sm text-gray-600 sm:px-6 md:table-cell dark:text-gray-300">
                    {{ $event->location ?? 'N/A' }}
                  </td>
                  <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                    <span
                      class="bg-primary/10 text-primary inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-semibold">
                      <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                      </svg>
                      {{ $event->registrations->count() }}
                    </span>
                  </td>
                  <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                    <span
                      class="{{ $statusColor }} inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold">
                      {{ $statusLabel }}
                    </span>
                  </td>
                  <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                    <div class="flex items-center space-x-2">
                      <a class="rounded-lg p-1.5 text-blue-600 transition-colors hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/20"
                        href="{{ route('admin.events.edit', $event) }}" title="Edit">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                      </a>
                      <form action="{{ route('admin.events.destroy', $event) }}" class="inline"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button
                          class="rounded-lg p-1.5 text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20"
                          title="Delete" type="submit">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            </path>
                          </svg>
                        </button>
                      </form>
                      <button
                        class="rounded-lg p-1.5 text-green-600 transition-colors hover:bg-green-50 dark:text-green-400 dark:hover:bg-green-900/20"
                        onclick="viewRegistrations({{ $event->id }})"
                        title="View Registrations">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                          viewBox="0 0 24 24">
                          <path
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td class="px-4 py-12 text-center sm:px-6" colspan="7">
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  </svg>
                  <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No events found</p>
                  <a class="bg-primary hover:bg-primary/90 mt-4 inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white transition"
                    href="{{ route('admin.events.create') }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"></path>
                    </svg>
                    Create your first event
                  </a>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
      @if (isset($events) && method_exists($events, 'hasPages') && $events->hasPages())
        <div class="border-t border-gray-200 px-4 py-4 sm:px-6 dark:border-gray-700">
          {{ $events->links() }}
        </div>
      @endif
    </div>
  </div>

  <!-- Registrations Modal -->
  <div class="fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-black/50 backdrop-blur-sm"
    id="registrationsModal">
    <div
      class="relative mx-auto my-10 w-full max-w-4xl rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
      <div
        class="flex items-center justify-between border-b border-gray-200 p-6 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Event Registrations</h3>
        <button
          class="rounded-lg p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-700"
          onclick="closeModal()">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"></path>
          </svg>
        </button>
      </div>
      <div class="overflow-x-auto p-6" id="registrationsContent">
        <div class="flex items-center justify-center py-8">
          <div
            class="border-primary h-8 w-8 animate-spin rounded-full border-4 border-t-transparent">
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      function viewRegistrations(eventId) {
        const modal = document.getElementById('registrationsModal');
        const content = document.getElementById('registrationsContent');

        content.innerHTML =
          '<div class="flex items-center justify-center py-8"><div class="h-8 w-8 animate-spin rounded-full border-4 border-primary border-t-transparent"></div></div>';
        modal.classList.remove('hidden');

        fetch(`/admin/events/${eventId}/registrations`)
          .then(response => response.json())
          .then(data => {
            if (data.length === 0) {
              content.innerHTML = `
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No registrations yet</p>
                            </div>
                        `;
            } else {
              let html = `
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Date of Birth</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Registered On</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                        `;

              data.forEach(reg => {
                html += `
                                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">${escapeHtml(reg.full_name)}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">${escapeHtml(reg.email)}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">${reg.date_of_birth || 'N/A'}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">${new Date(reg.created_at).toLocaleDateString()}</td>
                                </tr>
                            `;
              });

              html += `
                                </tbody>
                            </table>
                        `;
              content.innerHTML = html;
            }
          })
          .catch(error => {
            console.error('Error:', error);
            content.innerHTML = `
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">Error loading registrations</p>
                        </div>
                    `;
          });
      }

      function closeModal() {
        document.getElementById('registrationsModal').classList.add('hidden');
      }

      function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
      }

      // Close modal when clicking outside
      document.getElementById('registrationsModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
          closeModal();
        }
      });
    </script>
  </x-slot:scripts>
</x-admin-layout>
