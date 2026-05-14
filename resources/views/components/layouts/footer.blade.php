<footer class="mt-10 bg-[#0A192F] pb-8 pt-16 text-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Footer Grid -->
    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">

      <!-- About Column -->
      <div>
        <div class="mb-4 font-['Playfair_Display',serif] text-2xl font-bold text-[#C6A43F]">
          MIMSHACH
        </div>
        <p class="mb-4 text-sm leading-relaxed text-white/70">
          Empowering global education dreams with personalized guidance and unmatched support.
        </p>

        <!-- Social Icons -->
        <div class="flex gap-3">
          @foreach ([
        'instagram' => 'fab fa-instagram',
        'linkedin' => 'fab fa-linkedin-in',
        'facebook' => 'fab fa-facebook-f',
        'youtube' => 'fab fa-youtube'
    ] as $name => $icon)
            <a class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white/80 transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#C6A43F] hover:text-[#0A192F]"
              href="{{ settings($name . '_url', '#') }}">
              <i class="{{ $icon }} text-sm"></i>
            </a>
          @endforeach
        </div>
      </div>

      <!-- Quick Links Column -->
      <div>
        <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">
          Quick Links
        </h4>
        <ul class="space-y-2">
          <li><a class="text-sm text-white/70 transition-colors duration-200 hover:text-[#C6A43F]"
              href="{{ route('home') }}">Home</a></li>
          <li><a class="text-sm text-white/70 transition-colors duration-200 hover:text-[#C6A43F]"
              href="{{ route('admissions.index') }}">Admission</a></li>
          <li><a class="text-sm text-white/70 transition-colors duration-200 hover:text-[#C6A43F]"
              href="{{ route('fundings.index') }}">Student Funding</a></li>
          <li><a class="text-sm text-white/70 transition-colors duration-200 hover:text-[#C6A43F]"
              href="{{ route('universities.index') }}">Universities</a></li>
          <li><a class="text-sm text-white/70 transition-colors duration-200 hover:text-[#C6A43F]"
              href="{{ route('events.index') }}">Events</a></li>
          <li><a class="text-sm text-white/70 transition-colors duration-200 hover:text-[#C6A43F]"
              href="{{ route('contact.index') }}">Contact</a></li>
        </ul>
      </div>

      <!-- Contact Column -->
      <div>
        <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">
          Contact
        </h4>
        <ul class="space-y-3">
          <li class="flex items-start gap-3 text-sm text-white/70">
            <i class="fas fa-map-marker-alt mt-0.5 text-[#C6A43F]"></i>
            <span>{{ settings('address') }}</span>
          </li>
          <li class="flex items-center gap-3 text-sm text-white/70">
            <i class="fas fa-phone text-[#C6A43F]"></i>
            <span>{{ settings('phone') }}</span>
          </li>
          <li class="flex items-center gap-3 text-sm text-white/70">
            <i class="fas fa-envelope text-[#C6A43F]"></i>
            <span>{{ settings('email') }}</span>
          </li>
        </ul>
      </div>

      <!-- Newsletter Column -->
      <div>
        <h4 class="mb-4 text-sm font-semibold uppercase tracking-wider text-white">
          Subscribe
        </h4>
        <p class="mb-3 text-sm text-white/70">
          Get free study abroad guides and updates.
        </p>

        <form action="{{ route('newsletter.subscribe') }}" class="flex flex-col gap-3" method=fST"
          id="newsletterForm">
          @csrf

          <input
            class="w-full rounded-full border border-white/20 bg-white/10 px-4 py-3 text-sm text-white transition-all placeholder:text-white/50 focus:border-[#C6A43F] focus:outline-none focus:ring-1 focus:ring-[#C6A43F]"
            name="email" placeholder="Email..." type="email" value="{{ old('email') }}" />

          <div class="newsletter-error hidden text-xs text-red-400"></div>

          <button
            class="w-full cursor-pointer rounded-full bg-[#C6A43F] py-3 font-semibold text-[#0A192F] transition-all duration-200 hover:bg-[#dbb14f]"
            id="newsletterSubmitBtn" type="submit">
            Subscribe
          </button>
        </form>
      </div>

    </div>

    <!-- Copyright -->
    <div class="mt-8 border-t border-white/10 pt-8 text-center text-sm text-white/50">
      © 2025 Mimshach Education Centre. All rights reserved.
    </div>
  </div>
</footer>

<script>
  const newsletterForm = document.getElementById('newsletterForm');

  if (newsletterForm) {

    const newsletterInput =
      newsletterForm.querySelector('input[name="email"]');

    const newsletterError =
      newsletterForm.querySelector('.newsletter-error');

    const newsletterSubmitBtn =
      document.getElementById('newsletterSubmitBtn');

    newsletterForm.addEventListener('submit', async function(e) {

      e.preventDefault();

      newsletterError.textContent = '';
      newsletterError.classList.add('hidden');

      newsletterInput.classList.remove('border-red-500');

      newsletterSubmitBtn.disabled = true;

      newsletterSubmitBtn.innerHTML = `
        <div class="mx-auto h-5 w-5 animate-spin rounded-full border-2 border-[#0A192F] border-t-transparent"></div>
      `;

      try {

        const response = await fetch(newsletterForm.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector(
              'meta[name="csrf-token"]'
            ).content,
            'Accept': 'application/json',
          },
          body: new FormData(newsletterForm)
        });

        const data = await response.json();

        if (response.status === 422) {

          newsletterInput.classList.add('border-red-500');

          newsletterError.textContent =
            data.errors.email[0];

          newsletterError.classList.remove('hidden');

          return;
        }

        showToast('success', data.message);

        newsletterForm.reset();

      } catch (error) {

        console.error(error);

        showToast(
          'error',
          'Something went wrong. Please try again later.'
        );

      } finally {

        newsletterSubmitBtn.disabled = false;

        newsletterSubmitBtn.innerHTML = 'Subscribe';
      }
    });

    newsletterInput.addEventListener('input', function() {

      this.classList.remove('border-red-500');

      newsletterError.textContent = '';
      newsletterError.classList.add('hidden');
    });
  }
</script>
