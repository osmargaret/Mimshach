<x-app-layout pageTitle="Consultation | Mimshach">
  <x-page-header subtitle="Let's discuss your goals and create a personalized study abroad plan"
    title="Start Your Study Abroad Journey" />

  <!-- Consultation Section -->
  <div class="container mx-auto my-12 max-w-[1200px] px-4 md:my-16">
    <div class="md:rounded-4xl overflow-hidden rounded-3xl bg-white shadow-lg">
      <div class="flex flex-col lg:grid lg:grid-cols-2">

        <!-- Left: Form Section -->
        <div class="p-6 md:p-8 lg:p-10 xl:p-12">
          <h2 class="text-2xl font-bold text-[#0A192F] md:text-3xl">Tell us about yourself</h2>
          <p class="mt-2 text-sm text-[#4a5568] md:text-base">We'll get back to you within 24 hours.
          </p>

          <form action="{{ route('consultation.submit') }}" class="mt-6 space-y-5"
            id="consultationForm" method="POST">
            @csrf

            <!-- Add a container for dynamic messages -->
            <div class="mb-4 hidden rounded-2xl p-4 text-sm" id="formMessages"></div>

            <!-- Your form fields (without required attributes) -->
            <!-- Full Name -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="fullname">Full
                Name *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="fullname" name="fullname" type="text" value="{{ old('fullname') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="fullname">
              </div>
            </div>

            <!-- Email -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="email">Email
                *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="email" name="email" type="email" value="{{ old('email') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="email"></div>
            </div>

            <!-- Phone -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="phone">Phone
                *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="phone" name="phone" type="tel" value="{{ old('phone') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="phone"></div>
            </div>

            <!-- Education Level -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="education">Level
                of Education *</label>
              <select
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="education" name="education">
                <option value="">Select...</option>
                <option value="high_school">High School</option>
                <option value="bachelor">Bachelor's Degree</option>
                <option value="master">Master's Degree</option>
                <option value="phd">PhD / Doctorate</option>
                <option value="diploma">Diploma / Certificate</option>
              </select>
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="education">
              </div>
            </div>

            <!-- Programmes of Interest -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]"
                for="programmes">Programmes of Interest (multiple) *</label>
              <select
                class="w-full rounded-2xl border border-gray-200 bg-[#F9F7F5] p-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="programmes" multiple name="programmes[]" size="4">
                <option value="business">Business & Management</option>
                <option value="engineering">Engineering</option>
                <option value="computer_science">Computer Science</option>
                <option value="medicine">Medicine & Health</option>
                <option value="law">Law</option>
                <option value="arts">Arts & Humanities</option>
                <option value="social_sciences">Social Sciences</option>
                <option value="natural_sciences">Natural Sciences</option>
              </select>
              <small class="mt-1 block text-xs text-gray-500">Hold Ctrl/Cmd to select
                multiple</small>
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="programmes">
              </div>
            </div>

            <!-- Preferred Countries -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]"
                for="countries">Preferred Countries (multiple) *</label>
              <select
                class="w-full rounded-2xl border border-gray-200 bg-[#F9F7F5] p-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="countries" multiple name="countries[]" size="4">
                <option value="uk">United Kingdom</option>
                <option value="usa">United States</option>
                <option value="canada">Canada</option>
                <option value="australia">Australia</option>
                <option value="germany">Germany</option>
                <option value="france">France</option>
                <option value="netherlands">Netherlands</option>
                <option value="ireland">Ireland</option>
              </select>
              <small class="mt-1 block text-xs text-gray-500">Hold Ctrl/Cmd to select
                multiple</small>
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="countries">
              </div>
            </div>

            <!-- Tuition Budget -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]" for="tuition">Tuition
                Budget (USD) *</label>
              <input
                class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20"
                id="tuition" max="100000" min="0" name="tuition" step="1000"
                type="number" value="{{ old('tuition') }}">
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="tuition">
              </div>
            </div>

            <!-- Terms Checkbox -->
            <div class="flex flex-col items-start gap-3">
              <div class='flex items-center gap-3'>
                <input
                  class="h-5 w-5 rounded border-gray-300 text-[#C6A43F] focus:ring-2 focus:ring-[#C6A43F]"
                  id="terms" name="terms" type="checkbox" value="1">
                <label class="text-sm text-[#4a5568]" for="terms">
                  I agree to the
                  <a class="text-[#C6A43F] hover:underline" href="#">Terms and
                    Conditions</a>
                  and
                  <a class="text-[#C6A43F] hover:underline" href="#">Privacy Policy</a> *
                </label>
              </div>
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="terms">
              </div>
            </div>

            <!-- Submit Button -->
            <button
              class="w-full rounded-full bg-[#C6A43F] px-6 py-3 text-lg font-semibold text-[#0A192F] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#b38f2e] hover:shadow-lg disabled:cursor-not-allowed disabled:opacity-50"
              id="submitBtn" type="submit">
              Request Consultation
            </button>
          </form>
        </div>

        <!-- Right: Image Section -->
        <div class="relative order-first h-64 lg:order-last lg:h-auto">
          <img alt="Diverse students studying together in a library"
            class="h-full w-full object-cover lg:rounded-r-3xl"
            src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80">
          <div
            class="absolute inset-0 bg-gradient-to-t from-[#0A192F]/20 to-transparent lg:hidden">
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.getElementById('consultationForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const formMessages = document.getElementById('formMessages');

        formMessages.className = 'mb-4 hidden rounded-2xl p-4 text-sm';
        formMessages.innerHTML = '';

        document.querySelectorAll('.error-message').forEach(error => {
          error.textContent = '';
          error.classList.add('hidden');
        });

        document.querySelectorAll('input, select').forEach(field => {
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

            formMessages.innerHTML = `
                Please fix the errors below.
            `;

            Object.entries(data.errors).forEach(([field, messages]) => {

              const errorElement = document.querySelector(
                `.error-message[data-field="${field}"]`
              );

              if (errorElement) {
                errorElement.textContent = messages[0];
                errorElement.classList.remove('hidden');
              }

              let fieldElement =
                document.querySelector(`[name="${field}"]`) ||
                document.querySelector(`[name="${field}[]"]`);

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
            'Something went wrong. Please try again.';

        } finally {

          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Request Consultation';
        }
      });

      document.querySelectorAll('input, select').forEach(field => {
        field.addEventListener('input', function() {

          this.classList.remove('border-red-500');

          const fieldName = this.name.replace('[]', '');

          const errorElement = document.querySelector(
            `.error-message[data-field="${fieldName}"]`
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
