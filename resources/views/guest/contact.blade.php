<x-app-layout pageTitle="Contact Us | Mimshach">
  <x-page-header
    subtitle="Get in touch with our team - we're here to help you achieve your global education dreams"
    title="Contact Us" />

  <!-- Contact Section -->
  <div class="container mx-auto my-12 max-w-[1200px] px-4 md:my-16">
    <div class="overflow-hidden rounded-3xl bg-white p-6 shadow-lg md:p-8 lg:p-10">
      <div class="flex flex-col gap-10 lg:grid lg:grid-cols-2 lg:gap-12">

        <!-- Left: Contact Info -->
        <div class="order-2 lg:order-1">
          <h2 class="text-2xl font-bold text-[#0A192F] md:text-3xl">Let's Connect</h2>
          <p class="mt-2 text-sm text-[#4a5568] md:text-base">
            Whether you have questions about admissions, funding, or our services, we're ready to
            assist you.
          </p>

          <div class="mt-8 space-y-6">
            <!-- Address -->
            <div class="flex gap-4">
              <div
                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#F9F7F5] text-[#C6A43F]">
                <i class="fas fa-map-marker-alt text-lg"></i>
              </div>
              <div>
                <h4 class="font-semibold text-[#0A192F]">Visit Us</h4>
                <p class="text-sm text-[#4a5568]">{{ settings('address') }}</p>
              </div>
            </div>

            <!-- Phone -->
            <div class="flex gap-4">
              <div
                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#F9F7F5] text-[#C6A43F]">
                <i class="fas fa-phone-alt text-lg"></i>
              </div>
              <div>
                <h4 class="font-semibold text-[#0A192F]">Call Us</h4>
                <p class="text-sm text-[#4a5568]">{{ settings('phone') }}</p>
                <p class="text-xs text-gray-500">{{ settings('working_hours') }}</p>
              </div>
            </div>

            <!-- Email -->
            <div class="flex gap-4">
              <div
                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#F9F7F5] text-[#C6A43F]">
                <i class="fas fa-envelope text-lg"></i>
              </div>
              <div>
                <h4 class="font-semibold text-[#0A192F]">Email Us</h4>
                <p class="text-sm text-[#4a5568]">{{ settings('email') }}</p>
              </div>
            </div>
          </div>

          <!-- Social Links -->
          <div class="mt-8 flex flex-wrap gap-3">
            <a class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white"
              href="{{ settings('instagram_url') }}">
              <i class="fab fa-instagram"></i>
            </a>
            <a class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white"
              href="{{ settings('linkedin_url') }}">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white"
              href="{{ settings('facebook_url') }}">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white"
              href="{{ settings('youtube_url') }}">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="order-1 lg:order-2">
          <h2 class="text-2xl font-bold text-[#0A192F] md:text-3xl">Send a Message</h2>

          <form action="{{ route('contact.submit') }}" class="mt-6 space-y-5" id="contactForm"
            method="POST">
            @csrf
            <div class="hidden rounded-2xl p-4 text-sm" id="formMessages">
            </div>
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="name">Full
                Name *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="name" name="name" type="text" value="{{ old('name') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="name"></div>
            </div>

            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="email">Email
                *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="email" name="email" type="email" value="{{ old('email') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="email"></div>
            </div>

            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="subject">Subject
                *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="subject" name="subject" type="text" value="{{ old('subject') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="subject">
              </div>
            </div>

            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="message">Message
                *</label>
              <textarea
                class="w-full resize-y rounded-2xl border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="message" name="message" rows="5">{{ old('message') }}</textarea>
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="message">
              </div>
            </div>

            <button
              class="w-full rounded-full bg-[#C6A43F] px-6 py-3 text-lg font-semibold text-[#0A192F] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#b38f2e] hover:shadow-lg disabled:cursor-not-allowed disabled:opacity-50"
              id="submitBtn" type="submit">
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="mt-12 overflow-hidden rounded-3xl shadow-lg md:mt-16">
      <div class="h-80 md:h-96">
        <iframe allowfullscreen="" class="h-full w-full border-0" loading="lazy"
          src="{{ settings('map_embed_url') }}">
        </iframe>
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.getElementById('contactForm').addEventListener('submit', async function(e) {

        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const formMessages = document.getElementById('formMessages');

        formMessages.className = 'hidden rounded-2xl p-4 text-sm';
        formMessages.innerHTML = '';

        document.querySelectorAll('.error-message').forEach(error => {
          error.textContent = '';
          error.classList.add('hidden');
        });

        document.querySelectorAll('input, textarea').forEach(field => {
          field.classList.remove('border-red-500');
        });

        submitBtn.disabled = true;

        submitBtn.innerHTML = `
        <div class="mx-auto h-5 w-5 animate-spin rounded-full border-2 border-[#0A192F] border-t-transparent"></div>
    `;

        try {

          const response = await fetch(form.action, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept': 'application/json',
            },
            body: new FormData(form)
          });

          const data = await response.json();

          if (response.status === 422) {

            formMessages.classList.remove('hidden');
            formMessages.classList.add('bg-red-50', 'text-red-600');

            formMessages.innerHTML = 'Please fix the errors below.';

            Object.entries(data.errors).forEach(([field, messages]) => {

              const errorElement = document.querySelector(
                `.error-message[data-field="${field}"]`
              );

              if (errorElement) {
                errorElement.textContent = messages[0];
                errorElement.classList.remove('hidden');
              }

              const fieldElement = document.querySelector(
                `[name="${field}"]`
              );

              if (fieldElement) {
                fieldElement.classList.add('border-red-500');
              }
            });

            return;
          }

          formMessages.classList.remove('hidden');
          formMessages.classList.add('bg-green-50', 'text-green-600');

          formMessages.innerHTML = data.message;

          form.reset();

        } catch (error) {

          console.error(error);

          formMessages.classList.remove('hidden');
          formMessages.classList.add('bg-red-50', 'text-red-600');

          formMessages.innerHTML =
            'Something went wrong. Please try again later.';

        } finally {

          submitBtn.disabled = false;

          submitBtn.innerHTML = 'Send Message';
        }
      });

      document.querySelectorAll('input, textarea').forEach(field => {

        field.addEventListener('input', function() {

          this.classList.remove('border-red-500');

          const errorElement = document.querySelector(
            `.error-message[data-field="${this.name}"]`
          );

          if (errorElement) {
            errorElement.textContent = '';
            errorElement.classList.add('hidden');
          }
        });
      });
    </script>
  </x-slot:scripts>
</x-app-layout>
