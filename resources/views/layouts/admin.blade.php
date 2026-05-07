@props(['pageTitle' => ''])

<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>{{ $pageTitle }}</title>
    <!-- Add to your layout head section -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $styles ?? '' }}
  </head>

  <body
    class="bg-linear-to-br h-full overflow-hidden from-gray-50 to-gray-100 font-sans antialiased dark:from-gray-900 dark:to-gray-950">
    <div class="flex h-full">
      <x-layouts.admin.navbar />

      <!-- Main Content -->
      <div class="flex flex-1 flex-col overflow-hidden">
        <!-- Top Navigation -->
        <x-layouts.admin.header />

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
          {{ $slot }}
        </main>

        <div class="z-2000 fixed right-6 top-6 flex flex-col gap-3" id="toastContainer"></div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
      // Mobile sidebar functionality
      const sidebar = document.getElementById('sidebar');
      const openBtn = document.getElementById('openSidebarBtn');
      const closeBtn = document.getElementById('closeSidebarBtn');
      const overlay = document.getElementById('mobileOverlay');

      function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100', 'pointer-events-auto');
        document.body.classList.add('menu-open');
      }

      function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        overlay.classList.remove('opacity-100', 'pointer-events-auto');
        document.body.classList.remove('menu-open');
      }

      if (openBtn) openBtn.addEventListener('click', openSidebar);
      if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
      if (overlay) overlay.addEventListener('click', closeSidebar);

      // Theme toggle
      const themeToggle = document.getElementById('themeToggle');
      if (themeToggle) {
        themeToggle.addEventListener('click', () => {
          if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
          } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
          }
        });
      }

      // Check for saved theme preference
      if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window
          .matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      }

      // Close sidebar on window resize if open
      let resizeTimer;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          if (window.innerWidth >= 1024 && sidebar.classList.contains('translate-x-0')) {
            closeSidebar();
          }
        }, 250);
      });

      function showToast(type = 'success', message = '') {
        const container = document.getElementById('toastContainer');

        const toast = document.createElement('div');

        toast.className = `
            flex items-center gap-3 rounded-xl px-4 py-3 text-sm shadow-lg backdrop-blur-xl border
            transition-all duration-300 opacity-0 translate-y-[-10px] mb-3
            ${type === 'success' 
                ? 'bg-green-500/20 border-green-400/30 text-green-800 dark:text-green-200' 
                : 'bg-red-500/20 border-red-400/30 text-red-800 dark:text-red-200'}
        `;

        toast.innerHTML = `
            <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' 
                    ? '<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>'
                    : '<path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>'}
            </svg>
            <span>${message}</span>
        `;

        container.appendChild(toast);

        // animate in
        requestAnimationFrame(() => {
          toast.classList.remove('opacity-0', 'translate-y-[-10px]');
        });

        // remove after 3s
        setTimeout(() => {
          toast.classList.add('opacity-0', 'translate-y-[-10px]');
          setTimeout(() => toast.remove(), 300);
        }, 3000);
      }

      // Initialize all date pickers
      document.querySelectorAll('.datepicker-input').forEach(input => {
        flatpickr(input, {
          dateFormat: "Y-m-d",
          allowInput: true,
          placeholder: input.placeholder
        });
      });

      // Initialize Charts with sample data (replace with your actual data)
      document.addEventListener('DOMContentLoaded', function() {
        // Consultation Chart
        const consultationCtx = document.getElementById('consultationChart');
        if (consultationCtx) {
          @php
            $consultationLabels = $consultationChart['labels'] ?? ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $consultationValues = $consultationChart['values'] ?? [12, 19, 15, 17, 14, 23, 28];
          @endphp
          const consultationLabels = @json($consultationLabels);
          const consultationValues = @json($consultationValues);

          new Chart(consultationCtx.getContext('2d'), {
            type: 'line',
            data: {
              labels: consultationLabels,
              datasets: [{
                label: 'Consultations',
                data: consultationValues,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.4,
                fill: true
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false
                },
                tooltip: {
                  backgroundColor: 'rgba(0, 0, 0, 0.8)',
                  titleColor: '#fff',
                  bodyColor: '#e5e5e5',
                  padding: 10,
                  cornerRadius: 8
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                  }
                },
                x: {
                  grid: {
                    display: false
                  }
                }
              }
            }
          });
        }

        // Newsletter Chart
        const newsletterCtx = document.getElementById('newsletterChart');
        if (newsletterCtx) {
          @php
            $newsletterLabels = $newsletterChart['labels'] ?? ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $newsletterValues = $newsletterChart['values'] ?? [8, 12, 10, 15, 18, 22, 25];
          @endphp
          const newsletterLabels = @json($newsletterLabels);
          const newsletterValues = @json($newsletterValues);

          new Chart(newsletterCtx.getContext('2d'), {
            type: 'line',
            data: {
              labels: newsletterLabels,
              datasets: [{
                label: 'Subscriptions',
                data: newsletterValues,
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgb(34, 197, 94)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.4,
                fill: true
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false
                },
                tooltip: {
                  backgroundColor: 'rgba(0, 0, 0, 0.8)',
                  titleColor: '#fff',
                  bodyColor: '#e5e5e5',
                  padding: 10,
                  cornerRadius: 8
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                  }
                },
                x: {
                  grid: {
                    display: false
                  }
                }
              }
            }
          });
        }
      });
    </script>
    {{ $scripts ?? '' }}
  </body>

</html>
