@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="space-y-6">
    <!-- Welcome Banner -->
    @include('components.admin.dashboard.welcome-banner')

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
      @foreach ($stats as $stat)
        @include('components.admin.dashboard.stat-card', [
          'change' => $stat['change'] ?? null,
          'color' => $stat['color'],
          'icon' => $stat['icon'],
          'label' => $stat['label'],
          'value' => $stat['value']
        ])
      @endforeach
    </div>

    <!-- Recent Data Tables -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <!-- Recent Consultations Table -->
      @include('components.admin.dashboard.data-table', [
        'type' => 'consultations',
        'title' => 'Recent Consultation Requests',
        'subtitle' => 'Latest inquiries from students',
        'headers' => ['Name', 'Email', 'Date', 'Status'],
        'rows' => $recentConsultations ?? [],
        'emptyIcon' => 'inbox',
        'emptyMessage' => 'No consultations yet',
      ])

      <!-- Recent Newsletters Table -->
      @include('components.admin.dashboard.data-table', [
        'type' => 'newsletters',
        'title' => 'Recent Newsletter Subscriptions',
        'subtitle' => 'New subscribers',
        'headers' => ['Email', 'Subscribed Date', 'Status'],
        'rows' => $recentNewsletters ?? [],
        'emptyIcon' => 'email',
        'emptyMessage' => 'No subscribers yet',
      ])
    </div>

    <!-- Recent Events Table -->
    @include('components.admin.dashboard.data-table', [
      'type' => 'events',
      'title' => 'Upcoming Events',
      'subtitle' => 'Scheduled events and activities',
      'headers' => ['Title', 'Location', 'Date', 'Time', 'Status'],
      'rows' => $recentEvents ?? [],
      'emptyIcon' => 'calendar',
      'emptyMessage' => 'No upcoming events',
    ])
  </div>
@endsection
