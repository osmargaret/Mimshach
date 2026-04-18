<x-admin-layout pageTitle='Admin Dashboard'>
  <div class="space-y-6">
    <!-- Welcome Banner -->
    <x-admin.dashboard.welcome-banner />

    <!-- Stats Grid -->
    <x-admin.dashboard.dashboard-grid :columns="4">
      @foreach ($stats as $stat)
        <x-admin.dashboard.stat-card :change="$stat['change'] ?? null" :color="$stat['color']" :icon="$stat['icon']"
          :label="$stat['label']" :value="$stat['value']" />
      @endforeach
    </x-admin.dashboard.dashboard-grid>

    <!-- Charts Section -->
    <x-admin.dashboard.dashboard-grid :columns="2">
      <x-admin.dashboard.chart-card chartId="consultationChart" subtitle="Last 7 days activity"
        title="Consultations Trend" />
      <x-admin.dashboard.chart-card chartId="newsletterChart" subtitle="Subscription trends"
        title="Newsletter Growth" />
    </x-admin.dashboard.dashboard-grid>

    <!-- Recent Data Tables -->
    <x-admin.dashboard.dashboard-grid :columns="2">
      <!-- Recent Consultations Table -->
      <x-admin.dashboard.data-table :headers="['Name', 'Email', 'Date', 'Status']" :rows="$recentConsultations ?? []" emptyIcon="inbox"
        emptyMessage="No consultations yet" subtitle="Latest inquiries from students"
        title="Recent Consultation Requests" :fields="['name', 'email', 'created_at']" />
      <!-- Recent Newsletters Table -->
      <x-admin.dashboard.data-table :headers="['Email', 'Subscribed Date', 'Status']" :rows="$recentNewsletters ?? []" emptyIcon="email"
        emptyMessage="No subscribers yet" subtitle="New subscribers"
        title="Recent Newsletter Subscriptions">
        @foreach ($recentNewsletters ?? [] as $newsletter)
          <tr class="table-row-hover transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
              {{ $newsletter->email }}
            </td>
            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
              {{ $newsletter->subscribed_at->format('M d, Y H:i') }}
            </td>
            <td class="whitespace-nowrap px-6 py-4">
              <x-admin.dashboard.status-badge type="active" />
            </td>
          </tr>
        @endforeach
      </x-admin.dashboard.data-table>
    </x-admin.dashboard.dashboard-grid>

    <!-- Recent Events Table -->
    <x-admin.dashboard.data-table :headers="['Title', 'Location', 'Date', 'Time', 'Status']" :rows="$recentEvents ?? []" emptyIcon="calendar"
      emptyMessage="No upcoming events" subtitle="Scheduled events and activities"
      title="Upcoming Events">
      @foreach ($recentEvents ?? [] as $event)
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
            <x-admin.dashboard.status-badge type="upcoming" />
          </td>
        </tr>
      @endforeach
    </x-admin.dashboard.data-table>
  </div>
</x-admin-layout>
