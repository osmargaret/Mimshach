<x-app-layout pageTitle="Consultation | Mimshach">
  <x-page-header 
    subtitle="Let's discuss your goals and create a personalized study abroad plan"
    title="Start Your Study Abroad Journey" 
  />

  <!-- Consultation Section -->
  <div class="container mx-auto max-w-[1200px] px-4 my-12 md:my-16">
    <div class="overflow-hidden rounded-3xl bg-white shadow-lg md:rounded-4xl">
      <div class="flex flex-col lg:grid lg:grid-cols-2">
        
        <!-- Left: Form Section -->
        <div class="p-6 md:p-8 lg:p-10 xl:p-12">
          <h2 class="text-2xl font-bold text-[#0A192F] md:text-3xl">Tell us about yourself</h2>
          <p class="mt-2 text-sm text-[#4a5568] md:text-base">We'll get back to you within 24 hours.</p>

          <form action="{{ route('consultation.submit') }}" id="consultationForm" method="POST" class="mt-6 space-y-5">
            @csrf
            
            @if ($errors->any())
              <div class="rounded-2xl bg-red-50 p-4 text-sm text-red-600">
                <ul class="list-inside list-disc space-y-1">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Full Name -->
            <div>
              <label for="fullname" class="mb-2 block text-sm font-semibold text-[#0A192F]">Full Name *</label>
              <input type="text" id="fullname" name="fullname" required 
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="mb-2 block text-sm font-semibold text-[#0A192F]">Email *</label>
              <input type="email" id="email" name="email" required 
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <!-- Phone -->
            <div>
              <label for="phone" class="mb-2 block text-sm font-semibold text-[#0A192F]">Phone *</label>
              <input type="tel" id="phone" name="phone" required 
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <!-- Education Level -->
            <div>
              <label for="education" class="mb-2 block text-sm font-semibold text-[#0A192F]">Level of Education *</label>
              <select id="education" name="education" required 
                      class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
                <option value="">Select...</option>
                <option value="high_school">High School</option>
                <option value="bachelor">Bachelor's Degree</option>
                <option value="master">Master's Degree</option>
                <option value="phd">PhD / Doctorate</option>
                <option value="diploma">Diploma / Certificate</option>
              </select>
            </div>

            <!-- Programmes of Interest -->
            <div>
              <label for="programmes" class="mb-2 block text-sm font-semibold text-[#0A192F]">Programmes of Interest (multiple) *</label>
              <select id="programmes" name="programmes[]" required multiple size="4" 
                      class="w-full rounded-2xl border border-gray-200 bg-[#F9F7F5] p-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
                <option value="business">Business & Management</option>
                <option value="engineering">Engineering</option>
                <option value="computer_science">Computer Science</option>
                <option value="medicine">Medicine & Health</option>
                <option value="law">Law</option>
                <option value="arts">Arts & Humanities</option>
                <option value="social_sciences">Social Sciences</option>
                <option value="natural_sciences">Natural Sciences</option>
              </select>
              <small class="mt-1 block text-xs text-gray-500">Hold Ctrl/Cmd to select multiple</small>
            </div>

            <!-- Preferred Countries -->
            <div>
              <label for="countries" class="mb-2 block text-sm font-semibold text-[#0A192F]">Preferred Countries (multiple) *</label>
              <select id="countries" name="countries[]" required multiple size="4" 
                      class="w-full rounded-2xl border border-gray-200 bg-[#F9F7F5] p-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
                <option value="uk">United Kingdom</option>
                <option value="usa">United States</option>
                <option value="canada">Canada</option>
                <option value="australia">Australia</option>
                <option value="germany">Germany</option>
                <option value="france">France</option>
                <option value="netherlands">Netherlands</option>
                <option value="ireland">Ireland</option>
              </select>
              <small class="mt-1 block text-xs text-gray-500">Hold Ctrl/Cmd to select multiple</small>
            </div>

            <!-- Tuition Budget -->
            <div>
              <label for="tuition" class="mb-2 block text-sm font-semibold text-[#0A192F]">Tuition Budget (USD) *</label>
              <input type="number" id="tuition" name="tuition" required min="0" max="100000" step="1000"
                     class="w-full rounded-full border border-gray-200 bg-[#F9F7F5] px-5 py-3 text-base transition-all focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
            </div>

            <!-- Terms Checkbox -->
            <div class="flex items-start gap-3">
              <input type="checkbox" id="terms" name="terms" required value="1"
                     class="mt-1 h-5 w-5 rounded border-gray-300 text-[#C6A43F] focus:ring-2 focus:ring-[#C6A43F]">
              <label for="terms" class="text-sm text-[#4a5568]">
                I agree to the 
                <a href="#" class="text-[#C6A43F] hover:underline">Terms and Conditions</a> 
                and 
                <a href="#" class="text-[#C6A43F] hover:underline">Privacy Policy</a> *
              </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="btn-submit w-full rounded-full bg-[#C6A43F] px-6 py-3 text-lg font-semibold text-[#0A192F] transition-all duration-300 hover:bg-[#b38f2e] hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
              Request Consultation
            </button>
          </form>
        </div>

        <!-- Right: Image Section -->
        <div class="relative order-first h-64 lg:order-last lg:h-auto">
          <img alt="Diverse students studying together in a library"
               src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80"
               class="h-full w-full object-cover lg:rounded-r-3xl">
          <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F]/20 to-transparent lg:hidden"></div>
        </div>
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('consultationForm');
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

          const programmesSelect = document.getElementById('programmes');
          const programmes = Array.from(programmesSelect.selectedOptions).map(option => option.value);

          const countriesSelect = document.getElementById('countries');
          const countries = Array.from(countriesSelect.selectedOptions).map(option => option.value);

          const formData = {
            fullname: document.getElementById('fullname').value.trim(),
            email: document.getElementById('email').value.trim(),
            phone: document.getElementById('phone').value.trim(),
            education: document.getElementById('education').value,
            programmes: programmes,
            countries: countries,
            tuition: parseInt(document.getElementById('tuition').value) || 0,
            terms: document.getElementById('terms').checked ? 'on' : null,
            _token: '{{ csrf_token() }}'
          };

          // Validation
          if (!formData.fullname) {
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
          if (!formData.phone) {
            showToast('Please enter your phone number.', 'error');
            return;
          }
          if (!formData.education) {
            showToast('Please select your level of education.', 'error');
            return;
          }
          if (formData.programmes.length === 0) {
            showToast('Please select at least one programme of interest.', 'error');
            return;
          }
          if (formData.countries.length === 0) {
            showToast('Please select at least one preferred country.', 'error');
            return;
          }
          if (!formData.terms) {
            showToast('You must agree to the Terms and Conditions and Privacy Policy.', 'error');
            return;
          }

          const originalText = submitBtn.innerHTML;
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<div class="mx-auto h-5 w-5 animate-spin rounded-full border-2 border-white border-t-transparent"></div>';

          try {
            const response = await fetch('{{ route('consultation.submit') }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token,
                'Accept': 'application/json'
              },
              body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (!response.ok) {
              if (result.errors) {
                const errorMessages = Object.values(result.errors).flat().join('\n');
                showToast(errorMessages, 'error');
              } else if (result.message) {
                showToast(result.message, 'error');
              } else {
                showToast('Failed to submit your request. Please try again.', 'error');
              }
              return;
            }

            if (result.success) {
              showToast('Thank you! Your consultation request has been submitted successfully.', 'success');
              form.reset();
              programmesSelect.selectedIndex = -1;
              countriesSelect.selectedIndex = -1;
              document.getElementById('terms').checked = false;
            } else {
              showToast(result.message || 'Failed to submit your request. Please try again.', 'error');
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