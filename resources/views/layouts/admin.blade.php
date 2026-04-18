@props(['pageTitle' => ''])

<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>{{ $pageTitle }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      /* Custom scrollbar for modern look */
      ::-webkit-scrollbar {
        width: 0;
        height: 0;
      }

      ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
      }

      ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
      }

      ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
      }

      /* Smooth transitions */
      .sidebar-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }

      /* Card hover effects */
      /* .stat-card {
        transition: all 0.3s ease;
      }

      .stat-card:hover {
        transform: translateY(-4px);
      } */

      /* Chart container */
      .chart-container {
        position: relative;
        height: 250px;
        width: 100%;
      }

      /* Mobile menu overlay */
      .mobile-menu-overlay {
        transition: opacity 0.3s ease;
      }

      /* Hide scrollbar on mobile when menu is open */
      body.menu-open {
        overflow: hidden;
      }

      /* Skeleton loading animation */
      @keyframes pulse {

        0%,
        100% {
          opacity: 1;
        }

        50% {
          opacity: 0.5;
        }
      }

      .skeleton {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
      }

      /* Table row hover effect */
      .table-row-hover {
        transition: background-color 0.2s ease;
      }
    </style>

    {{ $styles ?? '' }}
  </head>

  <body
    class="h-full overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 font-sans antialiased dark:from-gray-900 dark:to-gray-950">
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
  </body>

</html>
