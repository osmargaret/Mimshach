@props([
    'title',
    'subtitle',
    'chartId',
    'chartType' => 'line'
])

<div class="rounded-2xl bg-white p-6 shadow-lg transition-all duration-300 hover:shadow-xl dark:bg-gray-800">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $title }}</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $subtitle }}</p>
        </div>
        <select class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
            <option>Last 7 days</option>
            <option>Last 30 days</option>
            <option>Last 90 days</option>
        </select>
    </div>
    <div class="chart-container">
        <canvas id="{{ $chartId }}"></canvas>
    </div>
</div>