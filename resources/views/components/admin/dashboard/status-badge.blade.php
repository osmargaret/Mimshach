@props(['type' => 'default'])

@php
    $classes = [
        'new' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'active' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'upcoming' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'completed' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        'default' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    ];
    
    $labels = [
        'new' => 'New',
        'active' => 'Active',
        'upcoming' => 'Upcoming',
        'pending' => 'Pending',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'default' => $slot,
    ];
@endphp

<span class="inline-flex rounded-full {{ $classes[$type] }} px-2.5 py-0.5 text-xs font-semibold">
    {{ $labels[$type] ?? $slot }}
</span>