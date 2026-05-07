<x-app-layout pageTitle="Contact Us | Mimshach">
  <x-page-header 
    subtitle="Get in touch with our team - we're here to help you achieve your global education dreams"
    title="Contact Us" 
  />

  <!-- Contact Section -->
  <div class="container mx-auto max-w-[1200px] px-4 my-12 md:my-16">
    <div class="overflow-hidden rounded-3xl bg-white p-6 shadow-lg md:p-8 lg:p-10">
      <div class="flex flex-col gap-10 lg:grid lg:grid-cols-2 lg:gap-12">
        
        <!-- Left: Contact Info -->
        <div class="order-2 lg:order-1">
          <h2 class="text-2xl font-bold text-[#0A192F] md:text-3xl">Let's Connect</h2>
          <p class="mt-2 text-sm text-[#4a5568] md:text-base">
            Whether you have questions about admissions, funding, or our services, we're ready to assist you.
          </p>

          <div class="mt-8 space-y-6">
            <!-- Address -->
            <div class="flex gap-4">
              <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#F9F7F5] text-[#C6A43F]">
                <i class="fas fa-map-marker-alt text-lg"></i>
              </div>
              <div>
                <h4 class="font-semibold text-[#0A192F]">Visit Us</h4>
                <p class="text-sm text-[#4a5568]">{{ settings('address') }}</p>
              </div>
            </div>

            <!-- Phone -->
            <div class="flex gap-4">
              <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#F9F7F5] text-[#C6A43F]">
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
              <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#F9F7F5] text-[#C6A43F]">
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
            <a href="{{ settings('instagram_url') }}" 
               class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="{{ settings('linkedin_url') }}" 
               class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="{{ settings('facebook_url') }}" 
               class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ settings('youtube_url') }}" 
               class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F9F7F5] text-[#0A192F] transition-all hover:bg-[#C6A43F] hover:text-white">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="order-1 lg:order-2">
          <h2 class="text-2xl font-bold text-[#0A192F] md:text-3xl">Send a Message</h2>
          
          <form id="contactForm" class="mt-6 space-y-5">
            @csrf
            
            <div>
              <label for="name" class="mb-2 block text-sm font-semibold text-[#0A192F]">Full Name *</label>
              <input type="text" id="name" name="name" required 
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <div>
              <label for="email" class="mb-2 block text-sm font-semibold text-[#0A192F]">Email *</label>
              <input type="email" id="email" name="email" required 
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <div>
              <label for="subject" class="mb-2 block text-sm font-semibold text-[#0A192F]">Subject *</label>
              <input type="text" id="subject" name="subject" required 
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <div>
              <label for="message" class="mb-2 block text-sm font-semibold text-[#0A192F]">Message *</label>
              <textarea id="message" name="message" required rows="5" 
                        class="w-full rounded-2xl border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20 resize-y"></textarea>
            </div>

            <button type="submit" 
                    class="btn-submit w-full rounded-full bg-[#C6A43F] px-6 py-3 text-lg font-semibold text-[#0A192F] transition-all duration-300 hover:bg-[#b38f2e] hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="mt-12 overflow-hidden rounded-3xl shadow-lg md:mt-16">
      <div class="h-80 md:h-96">
        <iframe 
          src="{{ settings('map_embed_url') }}" 
          class="h-full w-full border-0"
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const submitBtn = form.querySelector('.btn-submit');

        function showToast(message, type = 'success') {
          if (window.showToast) {
            window.showToast(message, type);
          } else {
            alert(message);
          }
        }

        form.addEventListener('submit', async function(e) {
          e.preventDefault();

          const formData = {
            name: document.getElementById('name').value.trim(),
            email: document.getElementById('email').value.trim(),
            subject: document.getElementById('subject').value.trim(),
            message: document.getElementById('message').value.trim(),
            _token: '{{ csrf_token() }}'
          };

          // Validation
          if (!formData.name) {
            showToast('Please enter your full name.', 'error');
            return;
          }
          if (!formData.email) {
            showToast('Please enter your email address.', 'error');
            return;
          }
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(formData.email)) {
            showToast('Please enter a valid email address.', 'error');
            return;
          }
          if (!formData.subject) {
            showToast('Please enter a subject.', 'error');
            return;
          }
          if (!formData.message) {
            showToast('Please enter your message.', 'error');
            return;
          }

          const originalText = submitBtn.innerHTML;
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<div class="mx-auto h-5 w-5 animate-spin rounded-full border-2 border-white border-t-transparent"></div>';

          try {
            const response = await fetch('{{ route('contact.submit') }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token
              },
              body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.success) {
              showToast('Thank you for your message! We\'ll get back to you soon.', 'success');
              form.reset();
            } else {
              showToast(result.message || 'Failed to send message. Please try again.', 'error');
            }
          } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred. Please try again later.', 'error');
          } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
          }
        });
      });
    </script>
  </x-slot:scripts>
</x-app-layout>