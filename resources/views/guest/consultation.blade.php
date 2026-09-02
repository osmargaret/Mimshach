@extends('layouts.app')

@section('title', 'Consultation | Mimshach')

@section('content')
  @include('components.page-header', [
    'subtitle' => "Let's discuss your goals and create a personalized study abroad plan",
    'title' => 'Start Your Study Abroad Journey'
  ])

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
              
              <div class="custom-multiselect relative" id="programmesMultiSelect">
                <!-- Native hidden select so standard FormData serialization and backend validation continue to work seamlessly -->
                <select class="hidden" id="programmes" multiple name="programmes[]">
                  <option value="business">Business & Management</option>
                  <option value="engineering">Engineering</option>
                  <option value="computer_science">Computer Science</option>
                  <option value="medicine">Medicine & Health</option>
                  <option value="law">Law</option>
                  <option value="arts">Arts & Humanities</option>
                  <option value="social_sciences">Social Sciences</option>
                  <option value="natural_sciences">Natural Sciences</option>
                </select>

                <!-- Trigger Input Container -->
                <div class="multiselect-trigger flex min-h-[50px] w-full cursor-pointer items-center justify-between rounded-2xl border border-gray-200 bg-[#F9F7F5] px-4 py-2.5 transition-all hover:border-[#C6A43F] focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
                  <div class="multiselect-selected flex flex-wrap items-center gap-1.5">
                    <span class="multiselect-placeholder text-sm text-gray-400">Select programmes of interest...</span>
                  </div>
                  <i class="fas fa-chevron-down multiselect-arrow ml-2 text-xs text-gray-400 transition-transform duration-200"></i>
                </div>

                <!-- Dropdown Menu -->
                <div class="multiselect-dropdown absolute left-0 right-0 top-full z-30 mt-1.5 hidden max-h-60 overflow-y-auto rounded-2xl border border-gray-100 bg-white p-2 shadow-xl">
                  <div class="mb-1 flex items-center justify-between border-b border-gray-100 px-3 pb-2 pt-1 text-xs text-gray-500">
                    <span class="font-medium">Click to select multiple</span>
                    <button class="multiselect-clear-all font-semibold text-[#C6A43F] hover:underline" type="button">Clear all</button>
                  </div>
                  <div class="multiselect-options space-y-1"></div>
                </div>
              </div>
              <div class="error-message mt-1 hidden text-sm text-red-600" data-field="programmes">
              </div>
            </div>

            <!-- Preferred Countries -->
            <div>
              <label class="mb-2 block text-sm font-semibold text-[#0A192F]"
                for="countries">Preferred Countries (multiple) *</label>

              <div class="custom-multiselect relative" id="countriesMultiSelect">
                <!-- Native hidden select -->
                <select class="hidden" id="countries" multiple name="countries[]">
                  <option value="uk">United Kingdom</option>
                  <option value="usa">United States</option>
                  <option value="canada">Canada</option>
                  <option value="australia">Australia</option>
                  <option value="germany">Germany</option>
                  <option value="france">France</option>
                  <option value="netherlands">Netherlands</option>
                  <option value="ireland">Ireland</option>
                </select>

                <!-- Trigger Input Container -->
                <div class="multiselect-trigger flex min-h-[50px] w-full cursor-pointer items-center justify-between rounded-2xl border border-gray-200 bg-[#F9F7F5] px-4 py-2.5 transition-all hover:border-[#C6A43F] focus:border-[#C6A43F] focus:outline-none focus:ring-2 focus:ring-[#C6A43F]/20">
                  <div class="multiselect-selected flex flex-wrap items-center gap-1.5">
                    <span class="multiselect-placeholder text-sm text-gray-400">Select preferred countries...</span>
                  </div>
                  <i class="fas fa-chevron-down multiselect-arrow ml-2 text-xs text-gray-400 transition-transform duration-200"></i>
                </div>

                <!-- Dropdown Menu -->
                <div class="multiselect-dropdown absolute left-0 right-0 top-full z-30 mt-1.5 hidden max-h-60 overflow-y-auto rounded-2xl border border-gray-100 bg-white p-2 shadow-xl">
                  <div class="mb-1 flex items-center justify-between border-b border-gray-100 px-3 pb-2 pt-1 text-xs text-gray-500">
                    <span class="font-medium">Click to select multiple</span>
                    <button class="multiselect-clear-all font-semibold text-[#C6A43F] hover:underline" type="button">Clear all</button>
                  </div>
                  <div class="multiselect-options space-y-1"></div>
                </div>
              </div>
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

  @endsection

@section('scripts')
    <script>
      function setupMultiSelect(containerId, placeholderText) {
        const container = document.getElementById(containerId);
        if (!container) return null;

        const select = container.querySelector('select');
        const trigger = container.querySelector('.multiselect-trigger');
        const selectedContainer = container.querySelector('.multiselect-selected');
        const dropdown = container.querySelector('.multiselect-dropdown');
        const arrow = container.querySelector('.multiselect-arrow');
        const optionsList = container.querySelector('.multiselect-options');
        const clearAllBtn = container.querySelector('.multiselect-clear-all');

        function renderOptions() {
          optionsList.innerHTML = '';
          Array.from(select.options).forEach((opt, idx) => {
            const item = document.createElement('div');
            item.className =
              'multiselect-item flex items-center gap-3 px-3 py-2.5 rounded-xl cursor-pointer hover:bg-gray-100 transition-colors text-sm text-[#0A192F]';
            item.innerHTML = `
              <div class="checkbox-box flex h-4 w-4 flex-shrink-0 items-center justify-center rounded border border-gray-300 transition-colors ${opt.selected ? 'bg-[#C6A43F] border-[#C6A43F]' : ''}">
                <i class="fas fa-check text-[10px] text-white ${opt.selected ? '' : 'hidden'}"></i>
              </div>
              <span class="flex-1 select-none">${opt.text}</span>
            `;

            item.addEventListener('click', (e) => {
              e.stopPropagation();
              opt.selected = !opt.selected;
              updateUI();
              trigger.classList.remove('border-red-500');
              const errorEl = container.parentElement.querySelector('.error-message');
              if (errorEl) {
                errorEl.textContent = '';
                errorEl.classList.add('hidden');
              }
            });

            optionsList.appendChild(item);
          });
        }

        function updateUI() {
          const selectedOptions = Array.from(select.selectedOptions);
          selectedContainer.innerHTML = '';

          if (selectedOptions.length === 0) {
            selectedContainer.innerHTML = `<span class="multiselect-placeholder text-sm text-gray-400 select-none">${placeholderText}</span>`;
          } else {
            selectedOptions.forEach(opt => {
              const chip = document.createElement('span');
              chip.className =
                'inline-flex items-center gap-1.5 rounded-full bg-[#0A192F] px-3 py-1 text-xs font-medium text-white shadow-xs';
              chip.innerHTML = `
                <span>${opt.text}</span>
                <button type="button" class="ml-0.5 text-gray-300 hover:text-white" title="Remove">&times;</button>
              `;
              chip.querySelector('button').addEventListener('click', (e) => {
                e.stopPropagation();
                opt.selected = false;
                updateUI();
                const errorEl = container.parentElement.querySelector('.error-message');
                if (errorEl && select.selectedOptions.length > 0) {
                  errorEl.textContent = '';
                  errorEl.classList.add('hidden');
                }
              });
              selectedContainer.appendChild(chip);
            });
          }

          // Update checkbox icons in the dropdown
          Array.from(select.options).forEach((opt, idx) => {
            const item = optionsList.children[idx];
            if (!item) return;
            const box = item.querySelector('.checkbox-box');
            const icon = item.querySelector('.fa-check');
            if (opt.selected) {
              box.className =
                'checkbox-box flex h-4 w-4 flex-shrink-0 items-center justify-center rounded border bg-[#C6A43F] border-[#C6A43F] transition-colors';
              icon.classList.remove('hidden');
            } else {
              box.className =
                'checkbox-box flex h-4 w-4 flex-shrink-0 items-center justify-center rounded border border-gray-300 transition-colors';
              icon.classList.add('hidden');
            }
          });
        }

        clearAllBtn?.addEventListener('click', (e) => {
          e.stopPropagation();
          Array.from(select.options).forEach(opt => opt.selected = false);
          updateUI();
        });

        trigger.addEventListener('click', (e) => {
          e.stopPropagation();
          // Close other multiselect dropdowns
          document.querySelectorAll('.multiselect-dropdown').forEach(d => {
            if (d !== dropdown) d.classList.add('hidden');
          });
          document.querySelectorAll('.multiselect-arrow').forEach(a => {
            if (a !== arrow) a.classList.remove('rotate-180');
          });

          const isClosed = dropdown.classList.contains('hidden');
          dropdown.classList.toggle('hidden', !isClosed);
          arrow.classList.toggle('rotate-180', isClosed);
        });

        renderOptions();
        updateUI();

        return {
          updateUI,
          reset: () => {
            Array.from(select.options).forEach(opt => opt.selected = false);
            updateUI();
          }
        };
      }

      // Close dropdowns on outside click
      document.addEventListener('click', (e) => {
        if (!e.target.closest('.custom-multiselect')) {
          document.querySelectorAll('.multiselect-dropdown').forEach(d => d.classList.add('hidden'));
          document.querySelectorAll('.multiselect-arrow').forEach(a => a.classList.remove('rotate-180'));
        }
      });

      const programmesMS = setupMultiSelect('programmesMultiSelect', 'Select programmes of interest...');
      const countriesMS = setupMultiSelect('countriesMultiSelect', 'Select preferred countries...');

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

        document.querySelectorAll('input, select, .multiselect-trigger').forEach(field => {
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

              const cleanField = field.split('.')[0];

              const errorElement = document.querySelector(
                `.error-message[data-field="${cleanField}"]`
              );

              if (errorElement) {
                errorElement.textContent = messages[0];
                errorElement.classList.remove('hidden');
              }

              if (cleanField === 'programmes') {
                document.querySelector('#programmesMultiSelect .multiselect-trigger')?.classList.add('border-red-500');
              } else if (cleanField === 'countries') {
                document.querySelector('#countriesMultiSelect .multiselect-trigger')?.classList.add('border-red-500');
              } else {
                let fieldElement =
                  document.querySelector(`[name="${cleanField}"]`) ||
                  document.querySelector(`[name="${cleanField}[]"]`);

                if (fieldElement) {
                  fieldElement.classList.add('border-red-500');
                }
              }
            });

            return;
          }

          formMessages.classList.remove('hidden');
          formMessages.classList.add('bg-green-50', 'text-green-600');

          formMessages.innerHTML = data.message;

          form.reset();
          programmesMS?.reset();
          countriesMS?.reset();

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
@endsection
