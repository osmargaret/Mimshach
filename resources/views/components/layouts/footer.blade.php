<div class="relative">
  <div
    class="h-100 bg-linear-to-t from-[--color-accent]/30 pointer-events-none absolute inset-x-0 bottom-0 via-transparent to-transparent">
  </div>


  <footer class="relative z-10 mt-24 px-4">
    <div class="pointer-events-none absolute inset-0">
      <div
        class="bg-linear-to-br absolute inset-0 from-white/20 via-white/5 to-transparent opacity-40">
      </div>
      <div
        class="bg-linear-to-b absolute left-0 top-0 h-24 w-full from-white/30 to-transparent opacity-30">
      </div>
    </div>
    <div
      class="relative mx-auto w-full max-w-[1400px] rounded-3xl border border-white/20 bg-white/10 shadow-[0_20px_60px_rgba(0,0,0,0.12)] backdrop-blur-xl">
      <div
        class="bg-linear-to-br absolute inset-0 from-white/20 via-white/5 to-transparent opacity-40">
      </div>
      <div
        class="bg-linear-to-b absolute left-0 top-0 h-24 w-full from-white/30 to-transparent opacity-30">
      </div>
    </div>

    <div class="relative mx-auto w-[94%] max-w-[1400px] py-12">

      <!-- Grid -->
      <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

        <!-- About -->
        <div>
          <div class="font-display text-accent mb-3 text-xl font-bold tracking-tight">
            MIMSHACH
          </div>
          <p class="text-primary/80 mb-4 text-sm leading-relaxed">
            Empowering global education dreams with personalized guidance and unmatched support.
          </p>

          <!-- Socials -->
          <div class="flex items-center gap-3">
            @foreach ([
        'instagram' => 'fab fa-instagram',
        'linkedin' => 'fab fa-linkedin-in',
        'facebook' => 'fab fa-facebook-f',
        'youtube' => 'fab fa-youtube'
    ] as $name => $icon)
              <a class="hover:bg-accent group relative flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:scale-110"
                href="{{ settings($name . '_url', '#') }}">

                <i
                  class="{{ $icon }} text-primary text-sm transition group-hover:text-white"></i>

                <!-- Glow effect -->
                <span
                  class="bg-accent/30 absolute inset-0 rounded-full opacity-0 blur-md transition group-hover:opacity-100"></span>
              </a>
            @endforeach
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="text-primary mb-4 text-sm font-semibold uppercase tracking-wide">
            Quick Links
          </h4>
          <ul class="space-y-2 text-sm">
            <li><a class="text-primary/80 hover:text-accent transition"
                href="{{ route('home') }}">Home</a></li>
            <li><a class="text-primary/80 hover:text-accent transition"
                href="{{ route('admissions.index') }}">Admission</a></li>
            <li><a class="text-primary/80 hover:text-accent transition"
                href="{{ route('fundings.index') }}">Student Funding</a></li>
            <li><a class="text-primary/80 hover:text-accent transition"
                href="{{ route('universities.index') }}">Universities</a></li>
            <li><a class="text-primary/80 hover:text-accent transition"
                href="{{ route('events.index') }}">Events</a></li>
            <li><a class="text-primary/80 hover:text-accent transition"
                href="{{ route('contact.index') }}">Contact</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div>
          <h4 class="text-primary mb-4 text-sm font-semibold uppercase tracking-wide">
            Contact
          </h4>
          <ul class="text-primary/80 space-y-3 text-sm">
            <li class="flex items-start gap-2">
              <i class="fas fa-map-marker-alt text-accent mt-0.5"></i>
              <span>{{ settings('address') }}</span>
            </li>
            <li class="flex items-center gap-2">
              <i class="fas fa-phone text-accent"></i>
              <span>{{ settings('phone') }}</span>
            </li>
            <li class="flex items-center gap-2">
              <i class="fas fa-envelope text-accent"></i>
              <span>{{ settings('email') }}</span>
            </li>
          </ul>
        </div>

        <!-- Newsletter -->
        <div>
          <h4 class="text-primary mb-4 text-sm font-semibold uppercase tracking-wide">
            Subscribe
          </h4>
          <p class="text-primary/80 mb-3 text-sm">
            Get free study abroad guides and updates.
          </p>

          <form class="flex flex-col gap-2" id="newsletterForm">
            @csrf
            <input
              class="focus:ring-accent w-full rounded-xl border border-white/20 bg-white/20 px-3 py-2 text-sm backdrop-blur-md focus:outline-none focus:ring-2"
              name="email" placeholder="Your email" required type="email">
            <button
              class="bg-accent cursor-pointer rounded-xl px-4 py-2 text-sm font-medium text-white transition hover:bg-[#b8953f]"
              type="submit">
              Subscribe
            </button>
          </form>
        </div>

      </div>

      <!-- Bottom -->
      <div class="text-primary/70 mt-10 border-t border-white/20 pt-6 text-center text-sm">
        © 2025 Mimshach Education Centre. All rights reserved.
      </div>

    </div>
  </footer>
</div>

<script>
  const form = document.getElementById('newsletterForm');

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const submitButton = form.querySelector('button[type="submit"]');
      const originalButtonText = submitButton.innerHTML;
      const emailInput = form.querySelector('input[name="email"]');

      // Get the email value
      const email = emailInput.value.trim();
      console.log('Email value being sent:', email);

      if (!email) {
        showToast('error', 'Please enter your email address.');
        emailInput.focus();
        return;
      }

      // Disable form while submitting
      submitButton.disabled = true;
      submitButton.innerHTML = 'Subscribing...';
      emailInput.disabled = true;

      // Create FormData and explicitly add the email
      const formData = new FormData();
      formData.append('email', email);

      // Add CSRF token
      const csrfToken = document.querySelector('input[name="_token"]')?.value;
      if (csrfToken) {
        formData.append('_token', csrfToken);
      }

      // Debug: Log what's being sent
      console.log('FormData contents:');
      for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
      }

      try {
        const res = await fetch("{{ route('newsletter.subscribe') }}", {
          method: "POST",
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
            // Don't set X-CSRF-TOKEN here since we're sending it in FormData
          },
          body: formData
        });

        const data = await res.json();

        if (res.ok && data.success) {
          showToast('success', data.message || 'Subscribed successfully!');
          form.reset();
        } else {
          const errorMessage = data.message || 'Something went wrong. Please try again.';
          showToast('error', errorMessage);

          if (data.errors && data.errors.email) {
            emailInput.classList.add('border-red-500', 'focus:ring-red-500');
            setTimeout(() => {
              emailInput.classList.remove('border-red-500', 'focus:ring-red-500');
            }, 3000);
          }
        }

      } catch (err) {
        console.error('Newsletter subscription error:', err);
        showToast('error', 'Network error. Please check your connection and try again.');
      } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
        emailInput.disabled = false;
      }
    });
  }
</script>
