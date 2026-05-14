@props(['pageTitle' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $styles ?? '' }}
  </head>

  <body class="text-primary overflow-x-hidden scroll-smooth bg-[#FEFCF8]">
    <!-- Hero Section -->
    <x-layouts.header />
    {{ $slot }}
    <x-layouts.footer />
    <div class="z-2000 fixed right-6 top-6 flex flex-col gap-3" id="toastContainer"></div>

    <!-- Smooth scroll and navbar script -->
    <script>
      function setUserTimezoneCookie() {
        const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        if (userTimezone) {
          document.cookie =
          `user_timezone=${userTimezone}; path=/; max-age=${60 * 60 * 24 * 30}`;
        }
      }

      document.addEventListener('DOMContentLoaded', setUserTimezoneCookie);

      // Smooth scroll for "Explore Services" button
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });

      document.querySelectorAll('.datepicker-input').forEach(input => {
        flatpickr(input, {
          dateFormat: "Y-m-d",
          allowInput: true,
          placeholder: input.placeholder
        });
      });

      function showToast(type = 'success', message = '') {
        const container = document.getElementById('toastContainer');

        const toast = document.createElement('div');

        toast.className = `
          flex items-center gap-3 rounded-xl px-4 py-3 text-sm shadow-lg backdrop-blur-xl border
          transition-all duration-300 opacity-0 translate-y-[-10px]
          ${type === 'success' 
            ? 'bg-green-500/20 border-green-400/30 text-green-500 dark:text-green-200' 
            : 'bg-red-500/20 border-red-400/30 text-red-800 dark:text-red-200'}
        `;

        toast.innerHTML = `
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
        }, 6000);
      }
    </script>
    {{ $scripts ?? '' }}
  </body>

</html>
