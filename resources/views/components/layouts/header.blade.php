@php
  $links = config('data.links');
@endphp

<!-- Navigation - Premium Design from Index (TailwindCSS + Vanilla JS) -->
<nav class="fixed top-0 left-0 z-[1000] w-full px-5 py-3 transition-all duration-300 md:px-10 md:py-3" id="navbar">
  <div class="container mx-auto flex items-center justify-between">
    <!-- Logo -->
    <div class="logo font-['Playfair_Display',serif] text-2xl font-bold tracking-wide text-[#C6A43F] md:text-3xl">
      MIMSHACH
    </div>

    <!-- Desktop Menu - hidden on lg and below -->
    <ul class="hidden items-center gap-6 xl:gap-8 lg:flex">
      @foreach ($links as $link)
        <li class="group relative">
          <a class="{{ request()->routeIs($link['route']) ? 'text-[#C6A43F]' : 'text-white/90' }} flex items-center gap-1 py-2 text-sm font-medium transition-colors duration-200 hover:text-[#C6A43F] lg:text-base" href="{{ route($link['route']) }}">
            {{ $link['label'] }}
          </a>
        </li>
      @endforeach
    </ul>

    <!-- Mobile Menu Button (visible on lg and below) -->
    <button class="block text-2xl text-white focus:outline-none lg:hidden" id="menuBtn">
      <i class="fa-solid fa-bars" id="menuIcon"></i>
    </button>
  </div>

  <!-- Mobile Menu Overlay -->
  <div class="fixed inset-0 z-[1001] bg-black/50 backdrop-blur-sm transition-all duration-300 lg:hidden" id="mobileOverlay" style="display: none; opacity: 0;"></div>

  <!-- Mobile Menu Panel - Slide from right -->
  <div class="fixed right-0 top-0 z-[1002] h-full w-3/4 max-w-sm transform overflow-y-auto px-6 py-8 shadow-2xl backdrop-blur-md transition-transform duration-300 ease-out lg:hidden" id="mobileMenu" style="transform: translateX(100%);">
    <!-- Close button inside menu -->
    <button class="absolute right-4 top-4 text-2xl text-white/80 hover:text-white" id="closeMenuBtn">
      <i class="fa-solid fa-times"></i>
    </button>

    <!-- Mobile Logo -->
    <div class="mb-8 border-b border-white/20 pb-4">
      <div class="logo font-['Playfair_Display',serif] text-2xl font-bold tracking-wide text-[#C6A43F]">
        MIMSHACH
      </div>
    </div>

    <ul class="flex flex-col gap-2">
      @foreach ($links as $link)
        <li>
          <a class="{{ request()->routeIs($link['route']) ? 'text-[#C6A43F] bg-white/10' : 'text-white/90' }} block rounded-lg px-4 py-3 text-base font-medium transition-all duration-200 hover:bg-white/10 hover:text-[#C6A43F]" href="{{ route($link['route']) }}" data-mobile-link>
            {{ $link['label'] }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</nav>

<style>
  /* Additional custom styles for navbar transitions */
  #navbar {
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }

  /* Scrolled state styles */
  #navbar.scrolled {
    background-color: #0A192F;
  }

  /* Container utility if not present in your Tailwind config */
  .container {
    max-width: 1280px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 1rem;
    padding-right: 1rem;
  }

  @media (min-width: 640px) {
    .container {
      padding-left: 1.5rem;
      padding-right: 1.5rem;
    }
  }

  /* Hide scrollbar for mobile menu but keep functionality */
  #mobileMenu {
    scrollbar-width: thin;
    background-image: linear-gradient(135deg, rgba(10, 25, 47, 0.85) 0%, rgba(10, 25, 47, 0.6) 100%);
  }

  #mobileMenu::-webkit-scrollbar {
    width: 4px;
  }

  #mobileMenu::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
  }

  #mobileMenu::-webkit-scrollbar-thumb {
    background: rgba(198, 164, 63, 0.5);
    border-radius: 4px;
  }

  /* Ensure dropdowns work on hover for desktop (1025px and above) */
  @media (min-width: 1025px) {
    .group:hover .group-hover\:block {
      display: block !important;
    }
  }

  /* Prevent body scroll when menu is open */
  body.menu-open {
    overflow: hidden;
  }
</style>

<script>
  (function() {
    // DOM Elements
    const navbar = document.getElementById('navbar');
    const menuBtn = document.getElementById('menuBtn');
    const menuIcon = document.getElementById('menuIcon');
    const closeMenuBtn = document.getElementById('closeMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const mobileLinks = document.querySelectorAll('[data-mobile-link]');
    const heroSection = document.querySelector('#hero');

    let isMenuOpen = false;

    // Function to update navbar based on scroll position
    function updateNavbarScroll() {
      if (!navbar) return;

      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }

    // Function to open mobile menu
    function openMenu() {
      if (!mobileMenu || !mobileOverlay) return;

      // Show overlay and menu
      mobileOverlay.style.display = 'block';
      mobileMenu.style.transform = 'translateX(0)';
      
      // Trigger reflow for transition
      setTimeout(() => {
        mobileOverlay.style.opacity = '1';
      }, 10);
      
      if (menuIcon) {
        menuIcon.classList.remove('fa-bars');
        menuIcon.classList.add('fa-times');
      }
      
      // Prevent body scroll
      document.body.classList.add('menu-open');
      isMenuOpen = true;
    }

    // Function to close mobile menu
    function closeMenu() {
      if (!mobileMenu || !mobileOverlay) return;

      // Animate out
      mobileMenu.style.transform = 'translateX(100%)';
      mobileOverlay.style.opacity = '0';
      
      // Hide overlay after animation
      setTimeout(() => {
        mobileOverlay.style.display = 'none';
      }, 300);
      
      if (menuIcon) {
        menuIcon.classList.remove('fa-times');
        menuIcon.classList.add('fa-bars');
      }
      
      // Restore body scroll
      document.body.classList.remove('menu-open');
      isMenuOpen = false;
    }

    // Toggle mobile menu
    function toggleMenu() {
      isMenuOpen ? closeMenu() : openMenu();
    }

    // Close menu when clicking overlay
    function handleOverlayClick(e) {
      if (e.target === mobileOverlay) {
        closeMenu();
      }
    }

    // Close menu on Escape key
    function handleEscapeKey(e) {
      if (e.key === 'Escape' && isMenuOpen) {
        closeMenu();
      }
    }

    // Close menu when a mobile link is clicked
    function handleMobileLinkClick() {
      closeMenu();
    }

    // Handle window resize - close mobile menu if screen becomes larger than 1024px
    function handleResize() {
      if (window.innerWidth > 1024 && isMenuOpen) {
        closeMenu();
      }
    }

    // Throttled scroll handler for performance
    let ticking = false;
    function handleScroll() {
      if (!ticking) {
        requestAnimationFrame(() => {
          updateNavbarScroll();
          ticking = false;
        });
        ticking = true;
      }
    }

    // Event listeners
    if (menuBtn) {
      menuBtn.addEventListener('click', toggleMenu);
    }

    if (closeMenuBtn) {
      closeMenuBtn.addEventListener('click', closeMenu);
    }

    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', handleOverlayClick);
    }

    document.addEventListener('keydown', handleEscapeKey);
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', handleResize);

    // Add click listeners to mobile links
    if (mobileLinks) {
      mobileLinks.forEach(link => {
        link.addEventListener('click', handleMobileLinkClick);
      });
    }

    // Initial call to set navbar state
    updateNavbarScroll();

    // Optional: If hero section exists, you can add logic to handle transparent navbar
    if (heroSection) {
      function updateHeroMode() {
        const heroBottom = heroSection.getBoundingClientRect().bottom;
        const navbarHeight = navbar?.offsetHeight || 80;
        const scrolledPast = heroBottom <= navbarHeight + 10;

        if (!scrolledPast && window.scrollY < 50) {
          navbar.classList.remove('scrolled');
        } else {
          navbar.classList.add('scrolled');
        }
      }

      let heroTicking = false;
      function handleHeroScroll() {
        if (!heroTicking) {
          requestAnimationFrame(() => {
            updateHeroMode();
            heroTicking = false;
          });
          heroTicking = true;
        }
      }

      window.addEventListener('scroll', handleHeroScroll);
      updateHeroMode();
    }
  })();
</script>