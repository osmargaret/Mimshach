@props(['pageTitle' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $pageTitle }}</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
      rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: 'Inter', sans-serif;
        color: #0A192F;
        background-color: #F9F7F5;
        line-height: 1.5;
      }

      .nav-toggle {
        display: none;
        background: transparent;
        border: none;
        color: white;
        font-size: 22px;
        cursor: pointer;
        background-color: #F9F7F5;
        line-height: 1.5;
        overflow-x: hidden;
      }

      h1,
      h2,
      h3,
      h4 {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        letter-spacing: -0.02em;
      }

      .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
      }

      /* navigation */
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: transparent;
        transition: background 0.3s ease, box-shadow 0.3s ease;
        z-index: 1000;
        color: white;
      }

      .navbar.scrolled {
        background: #0A192F;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 12px 40px;
      }

      .logo {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #C6A43F;
      }

      .nav-menu {
        display: flex;
        list-style: none;
        gap: 32px;
        align-items: center;
      }

      .nav-menu li {
        position: relative;
      }

      .nav-menu a {
        text-decoration: none;
        color: inherit;
        font-size: 16px;
        font-weight: 500;
        transition: color 0.2s;
        padding: 8px 0;
      }

      .nav-menu a:hover,
      .nav-menu a.active {
        color: #C6A43F;
      }

      /* dropdown */
      .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        min-width: 180px;
        padding: 8px 0;
        z-index: 10;
      }

      .dropdown-content li {
        display: block;
      }

      .dropdown-content a {
        color: #0A192F !important;
        padding: 10px 20px;
        display: block;
        font-weight: 400;
      }

      .dropdown-content a:hover {
        background: #F0EEE9;
        color: #C6A43F !important;
      }

      .nav-menu li:hover .dropdown-content {
        display: block;
      }

      .nav-cta {
        background: #C6A43F;
        color: #0A192F;
        padding: 8px 24px;
        border-radius: 40px;
        font-weight: 600;
        transition: 0.2s;
        margin-left: 16px;
      }

      .nav-cta:hover {
        background: #b38f2e;
        color: #0A192F !important;
      }

      /* hero */
      .hero {
        height: 100vh;
        background: linear-gradient(135deg, rgba(10, 25, 47, 0.85) 0%, rgba(10, 25, 47, 0.6) 100%), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;
        display: flex;
        align-items: center;
        color: white;
        position: relative;
      }

      /* hero replaced by a full-width image banner */
      .hero-image img {
        width: 100%;
        height: auto;
        display: block;
      }

      .hero-content {
        max-width: 700px;
        margin-left: 10%;
      }

      .hero h1 {
        font-size: 64px;
        line-height: 1.1;
        margin-bottom: 24px;
        animation: fadeUp 1s ease-out;
      }

      .hero p {
        font-size: 20px;
        margin-bottom: 40px;
        opacity: 0.9;
        max-width: 550px;
        animation: fadeUp 1s ease-out 0.2s both;
      }

      .hero-buttons {
        display: flex;
        gap: 24px;
        animation: fadeUp 1s ease-out 0.4s both;
      }

      .btn-primary {
        background: #C6A43F;
        color: #0A192F;
        border: none;
        padding: 14px 42px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 18px;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
      }

      .btn-primary:hover {
        background: #dbb14f;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(198, 164, 63, 0.3);
      }

      .btn-secondary {
        background: transparent;
        color: white;
        border: 2px solid white;
        padding: 12px 40px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 18px;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
      }

      .btn-secondary:hover {
        background: white;
        color: #0A192F;
        transform: translateY(-2px);
      }

      .scroll-down {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-size: 24px;
        animation: bounce 2s infinite;
      }

      @keyframes fadeUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
          transform: translateY(0) translateX(-50%);
        }

        40% {
          transform: translateY(-20px) translateX(-50%);
        }

        60% {
          transform: translateY(-10px) translateX(-50%);
        }
      }

      /* partners */
      .partners {
        background: #F0EEE9;
        padding: 40px 0;
        text-align: center;
      }

      .partner-logos {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 60px;
        flex-wrap: wrap;
        filter: grayscale(1);
        opacity: 0.7;
        transition: 0.3s;
      }

      .partner-logos:hover {
        filter: grayscale(0);
        opacity: 1;
      }

      .partner-logos span {
        font-size: 18px;
        font-weight: 500;
        color: #0A192F;
        background: white;
        padding: 8px 20px;
        border-radius: 40px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      }

      /* section general */
      section {
        padding: 100px 0;
      }

      .section-label {
        color: #C6A43F;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
      }

      .section-title {
        font-size: 42px;
        margin-bottom: 24px;
        color: #0A192F;
      }

      .section-desc {
        font-size: 18px;
        color: #4a5568;
        max-width: 700px;
        margin-bottom: 60px;
      }

      /* about */
      .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
      }

      .about-stats {
        display: flex;
        gap: 40px;
        margin-top: 40px;
      }

      .stat-item {
        text-align: center;
      }

      .stat-number {
        font-family: 'Playfair Display', serif;
        font-size: 40px;
        font-weight: 700;
        color: #C6A43F;
      }

      .stat-label {
        font-size: 14px;
        color: #4a5568;
      }

      .about-collage {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .collage-img {
        border-radius: 16px;
        object-fit: cover;
        width: 100%;
        height: 200px;
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
        transition: 0.3s;
      }

      .collage-img:hover {
        transform: scale(1.02);
      }

      .collage-img:first-child {
        grid-column: span 2;
        height: 280px;
      }

      /* services */
      .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 20px;
      }

      .service-card {
        background: white;
        padding: 40px 30px;
        border-radius: 30px;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
        text-align: center;
      }

      .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 40px -10px rgba(198, 164, 63, 0.2);
      }

      .service-icon {
        font-size: 48px;
        color: #C6A43F;
        margin-bottom: 24px;
      }

      .service-card h3 {
        font-size: 24px;
        margin-bottom: 16px;
      }

      .service-card p {
        color: #4a5568;
        margin-bottom: 24px;
      }

      .learn-more {
        color: #C6A43F;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
      }

      .learn-more i {
        transition: 0.2s;
      }

      .learn-more:hover i {
        transform: translateX(5px);
      }

      /* process */
      .process-timeline {
        display: flex;
        justify-content: space-between;
        margin-top: 60px;
        position: relative;
      }

      .process-timeline::before {
        content: '';
        position: absolute;
        top: 40px;
        left: 10%;
        width: 80%;
        height: 2px;
        background: #C6A43F;
        opacity: 0.3;
        z-index: 0;
      }

      .step {
        text-align: center;
        flex: 1;
        position: relative;
        z-index: 2;
      }

      .step-circle {
        width: 80px;
        height: 80px;
        background: white;
        border: 3px solid #C6A43F;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 28px;
        font-weight: 700;
        color: #0A192F;
        background: #F9F7F5;
        transition: 0.3s;
      }

      .step:hover .step-circle {
        background: #C6A43F;
        color: white;
      }

      .step h4 {
        font-size: 22px;
        margin-bottom: 12px;
      }

      .step p {
        color: #4a5568;
        max-width: 220px;
        margin: 0 auto;
      }

      /* testimonials */
      .testimonials {
        background: #0A192F;
        color: white;
      }

      .testimonials .section-title,
      .testimonials .section-label {
        color: white;
      }

      .testimonial-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
      }

      .testimonial-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(4px);
        padding: 40px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .testimonial-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #C6A43F;
        margin-bottom: 24px;
      }

      .testimonial-card i {
        color: #C6A43F;
        font-size: 28px;
        margin-bottom: 16px;
        display: block;
      }

      .testimonial-card p {
        font-size: 18px;
        font-style: italic;
        margin-bottom: 24px;
      }

      .testimonial-author {
        font-weight: 700;
        color: #C6A43F;
      }

      .testimonial-detail {
        font-size: 14px;
        opacity: 0.7;
      }

      /* why choose us */
      .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        text-align: center;
      }

      .why-item {
        padding: 30px 20px;
        background: white;
        border-radius: 20px;
        transition: 0.3s;
      }

      .why-item:hover {
        background: #F0EEE9;
      }

      .why-icon {
        font-size: 40px;
        color: #C6A43F;
        margin-bottom: 20px;
      }

      .why-item h4 {
        font-size: 20px;
        margin-bottom: 12px;
      }

      .why-item p {
        color: #4a5568;
        font-size: 14px;
      }

      /* cta */
      .cta {
        background: linear-gradient(135deg, #C6A43F, #dbb14f);
        color: #0A192F;
        text-align: center;
        padding: 100px 20px;
      }

      .cta h2 {
        font-size: 48px;
        margin-bottom: 20px;
      }

      .cta p {
        font-size: 20px;
        max-width: 600px;
        margin: 0 auto 40px;
        opacity: 0.9;
      }

      .cta .btn-primary {
        background: #0A192F;
        color: white;
        border: none;
      }

      .cta .btn-primary:hover {
        background: #1a2f4a;
      }

      .deadline-timer {
        background: linear-gradient(135deg, #0A192F, #1a2f4a);
        padding: 24px;
        border-radius: 16px;
        text-align: center;
        margin-top: 24px;
        color: white;
      }

      .deadline-timer .timer-label {
        font-size: 14px;
        color: #C6A43F;
        margin-bottom: 12px;
      }

      .timer-numbers {
        display: flex;
        justify-content: center;
        gap: 16px;
      }

      .timer-unit {
        text-align: center;
      }

      .timer-unit .number {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
        font-size: 32px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 12px;
        border-radius: 12px;
        min-width: 60px;
        display: inline-block;
        font-variant-numeric: tabular-nums;
        text-align: center;
      }

      .timer-unit .label {
        font-size: 11px;
        margin-top: 6px;
        display: block;
        opacity: 0.7;
      }

      /* footer */
      footer {
        background: #0A192F;
        color: #F0EEE9;
        padding: 60px 0 20px;
      }

      .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 40px;
        margin-bottom: 40px;
      }

      .footer-logo {
        font-size: 28px;
        color: #C6A43F;
        margin-bottom: 16px;
      }

      .footer-about p {
        margin-bottom: 24px;
        opacity: 0.8;
      }

      .social-icons {
        display: flex;
        gap: 20px;
      }

      .social-icons a {
        color: #F0EEE9;
        font-size: 24px;
        transition: 0.2s;
      }

      .social-icons a:hover {
        color: #C6A43F;
      }

      .footer-links h4 {
        color: white;
        margin-bottom: 24px;
        font-size: 18px;
      }

      .footer-links ul {
        list-style: none;
      }

      .footer-links li {
        margin-bottom: 12px;
      }

      .footer-links a {
        color: #F0EEE9;
        text-decoration: none;
        opacity: 0.8;
        transition: 0.2s;
      }

      .footer-links a:hover {
        opacity: 1;
        color: #C6A43F;
      }

      .newsletter input {
        width: 100%;
        padding: 14px;
        border-radius: 50px;
        border: none;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        margin-bottom: 12px;
      }

      .newsletter button {
        background: #C6A43F;
        color: #0A192F;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
      }

      .toast {
        position: fixed;
        left: 50%;
        bottom: 24px;
        transform: translateX(-50%) translateY(16px);
        min-width: 280px;
        max-width: calc(100% - 32px);
        background: rgba(15, 23, 42, 0.96);
        color: #f8fafc;
        padding: 14px 18px;
        border-radius: 9999px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.35);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease, background 0.25s ease;
        z-index: 9999;
        text-align: center;
      }

      .toast.success {
        background: #047857;
        color: #f8fafc;
      }

      .toast.error {
        background: #b91c1c;
        color: #ffffff;
      }

      .toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
      }

      .copyright {
        text-align: center;
        padding-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        opacity: 0.6;
        font-size: 14px;
      }

      /* .countdown {
        display: flex;
        gap: 12px;
      }

      .time-box {
        background: #0A192F;
        color: white;
        padding: 12px 16px;
        border-radius: 12px;
        text-align: center;
        min-width: 70px;
      }

      .time-box span {
        font-size: 20px;
        font-weight: bold;
        display: block;
      } */

      /* responsive */
      @media (max-width: 1024px) {
        .hero h1 {
          font-size: 48px;
        }

        .about-grid,
        .testimonial-grid,
        .footer-grid {
          grid-template-columns: 1fr;
          gap: 40px;
        }

        .services-grid,
        .why-grid {
          grid-template-columns: repeat(2, 1fr);
        }

        .process-timeline {
          flex-direction: column;
          gap: 40px;
        }

        .process-timeline::before {
          display: none;
        }

        .nav-menu {
          gap: 16px;
        }
      }

      @media (max-width: 768px) {
        .navbar {
          padding: 20px;
        }

        .nav-menu {
          display: none;
        }

        /* mobile menu not implemented for brevity */
        .hero h1 {
          font-size: 40px;
        }

        .services-grid,
        .why-grid {
          grid-template-columns: 1fr;
        }

        .hero-buttons {
          flex-direction: column;
          gap: 16px;
        }
      }
    </style>
    {{ $styles ?? '' }}
  </head>

  <body>
    <!-- Hero Section -->
    <x-layouts.header />
    {{ $slot }}
    <x-layouts.footer />
    <div aria-atomic="true" aria-live="polite" class="toast" id="app-toast"></div>

    <!-- Smooth scroll and navbar script -->
    <script>
      // Mobile nav toggle and dropdown support
      (function() {
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');

        if (navToggle && navMenu) {
          navToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('open');
          });

          // Close menu when clicking outside
          document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && !navToggle.contains(e.target)) {
              navMenu.classList.remove('open');
              // close any open dropdowns
              navMenu.querySelectorAll('li').forEach(li => li.classList.remove('dropdown-open'));
            }
          });

          // Handle dropdown toggles on touch / small screens
          navMenu.querySelectorAll('li').forEach(li => {
            const dropdown = li.querySelector('.dropdown-content');
            const anchor = li.querySelector('a');
            if (dropdown && anchor) {
              anchor.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                  e.preventDefault();
                  li.classList.toggle('dropdown-open');
                }
              });
            }
          });
        }
      })();

      // Navbar scroll effect
      window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });

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

      document.addEventListener("DOMContentLoaded", () => {
        const newsletterForm = document.getElementById('newsletter-form');
        const toast = document.getElementById('app-toast');

        function showToast(message, type = 'success') {
          if (!toast) {
            alert(message);
            return;
          }

          toast.textContent = message;
          toast.classList.remove('success', 'error');
          toast.classList.add(type, 'show');

          clearTimeout(window.__toastTimeout);
          window.__toastTimeout = setTimeout(() => {
            toast.classList.remove('show');
          }, 3000);
        }

        // Make showToast globally available
        window.showToast = showToast;

        if (newsletterForm) {
          newsletterForm.addEventListener('submit', async event => {
            event.preventDefault();

            const formData = new FormData(newsletterForm);

            try {
              const response = await fetch(newsletterForm.action, {
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                },
                body: formData,
              });

              const data = await response.json();

              if (!response.ok) {
                const message = data.message || 'Subscription failed. Please try again.';
                throw new Error(message);
              }

              showToast(data.message || 'Thank you for subscribing!', 'success');
              newsletterForm.reset();
            } catch (error) {
              showToast(error.message || 'Failed to subscribe. Please try again.', 'error');
            }
          });
        }

        document.querySelectorAll(".deadline-timer").forEach(timer => {

          const deadline = new Date(timer.dataset.deadline);

          const monthsEl = timer.querySelector(".months");
          const daysEl = timer.querySelector(".days");
          const hoursEl = timer.querySelector(".hours");
          const minutesEl = timer.querySelector(".minutes");
          const secondsEl = timer.querySelector(".seconds");

          function updateTimer() {

            const now = new Date();

            if (deadline <= now) {
              timer.innerHTML =
                "<strong style='color:#10b981'>Closed</strong>";
              return;
            }

            // ---- CALENDAR DIFFERENCE ----
            let start = new Date(now);
            let end = new Date(deadline);

            let months =
              (end.getFullYear() - start.getFullYear()) * 12 +
              (end.getMonth() - start.getMonth());

            // adjust if day not reached
            if (end.getDate() < start.getDate()) {
              months--;
            }

            // remaining after removing months
            let tempDate = new Date(start);
            tempDate.setMonth(tempDate.getMonth() + months);

            let diff = end - tempDate;

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            diff %= (1000 * 60 * 60 * 24);

            const hours = Math.floor(diff / (1000 * 60 * 60));
            diff %= (1000 * 60 * 60);

            const minutes = Math.floor(diff / (1000 * 60));
            diff %= (1000 * 60);

            const seconds = Math.floor(diff / 1000);

            monthsEl.textContent = String(months).padStart(2, '0');
            daysEl.textContent = String(days).padStart(2, '0');
            hoursEl.textContent = String(hours).padStart(2, '0');
            minutesEl.textContent = String(minutes).padStart(2, '0');
            secondsEl.textContent = String(seconds).padStart(2, '0');
          }

          updateTimer();
          setInterval(updateTimer, 1000);
        });

      });
    </script>
    {{ $scripts ?? '' }}
  </body>

</html>
