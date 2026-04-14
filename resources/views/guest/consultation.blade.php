<x-app-layout>
  <x-slot:styles>
    <style>
      /* consultation section */
      .consultation-section {
        margin: 60px 0;
      }

      .consultation-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        background: white;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.1);
      }

      /* left side - form */
      .consultation-form {
        padding: 50px;
      }

      .consultation-form h2 {
        font-size: 32px;
        margin-bottom: 10px;
      }

      .consultation-form p {
        color: #4a5568;
        margin-bottom: 30px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #0a192f;
      }

      .form-group input,
      .form-group select,
      .form-group textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid #e0e0e0;
        border-radius: 30px;
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        background: #f9f7f5;
      }

      .form-group select[multiple] {
        height: auto;
        min-height: 100px;
        padding: 10px;
        border-radius: 20px;
      }

      .form-group select[multiple] option {
        padding: 8px 12px;
      }

      .range-container {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
      }

      .range-container input[type='range'] {
        flex: 1;
        padding: 0;
        height: 6px;
        background: #f0eee9;
        border-radius: 10px;
        -webkit-appearance: none;
      }

      .range-container input[type='range']::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 22px;
        height: 22px;
        background: #c6a43f;
        border-radius: 50%;
        cursor: pointer;
      }

      .range-value {
        background: #c6a43f;
        color: #0a192f;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        min-width: 100px;
        text-align: center;
      }

      .checkbox-group {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 20px 0;
      }

      .checkbox-group input[type='checkbox'] {
        width: 20px;
        height: 20px;
        accent-color: #c6a43f;
      }

      .btn-submit {
        background: #c6a43f;
        color: #0a192f;
        border: none;
        padding: 16px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 18px;
        cursor: pointer;
        width: 100%;
        transition: 0.2s;
      }

      .btn-submit:hover {
        background: #b38f2e;
      }

      .success-message {
        background: #d4edda;
        color: #155724;
        padding: 15px 20px;
        border-radius: 20px;
        margin-top: 20px;
        display: none;
        position: absolute;
        top: 70px;
        right: 10px;
        align-items: center;
        gap: 10px;
      }

      .success-message i {
        font-size: 24px;
      }

      /* right side - image */
      .consultation-image {
        background: #0a192f;
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .consultation-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
      }

      @media (max-width: 992px) {
        .consultation-grid {
          grid-template-columns: 1fr;
        }

        .consultation-image {
          order: -1;
          /* image on top for mobile */
          height: 300px;
        }
      }
    </style>
  </x-slot:styles>

  <x-page-header subtitle="Let's discuss your goals and create a personalized study abroad plan"
    title="Start Your Study Abroad Journey" />

  <!-- Consultation Section -->
  <div class="consultation-section container">
    <div class="consultation-grid">
      <!-- Left: Form -->
      <div class="consultation-form">
        <h2>Tell us about yourself</h2>
        <p>We'll get back to you within 24 hours.</p>

        <form action="{{ route('consultation.submit') }}" id="consultationForm" method="POST">
          @csrf
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li style="color: red;">{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="form-group">
            <label for="fullname">Full Name *</label>
            <input id="fullname" name="fullname" required type="text" />
          </div>

          <div class="form-group">
            <label for="email">Email *</label>
            <input id="email" name="email" required type="email" />
          </div>

          <div class="form-group">
            <label for="phone">Phone *</label>
            <input id="phone" name="phone" required type="tel" />
          </div>

          <div class="form-group">
            <label for="education">Level of Education *</label>
            <select id="education" name="education" required>
              <option value="">Select...</option>
              <option value="high_school">
                High School
              </option>
              <option value="bachelor">
                Bachelor's Degree
              </option>
              <option value="master">
                Master's Degree
              </option>
              <option value="phd">PhD / Doctorate</option>
              <option value="diploma">
                Diploma / Certificate
              </option>
            </select>
          </div>

          <div class="form-group">
            <label for="programmes">Programmes of Interest (multiple) *</label>
            <select id="programmes" multiple name="programmes[]" required size="4">
              <option value="business">
                Business & Management
              </option>
              <option value="engineering">
                Engineering
              </option>
              <option value="computer_science">
                Computer Science
              </option>
              <option value="medicine">
                Medicine & Health
              </option>
              <option value="law">Law</option>
              <option value="arts">
                Arts & Humanities
              </option>
              <option value="social_sciences">
                Social Sciences
              </option>
              <option value="natural_sciences">
                Natural Sciences
              </option>
            </select>
            <small style="color: #666">Hold Ctrl/Cmd to select multiple</small>
          </div>

          <div class="form-group">
            <label for="countries">Preferred Countries (multiple) *</label>
            <select id="countries" multiple name='countries[]' required size="4">
              <option value="uk">United Kingdom</option>
              <option value="usa">United States</option>
              <option value="canada">Canada</option>
              <option value="australia">Australia</option>
              <option value="germany">Germany</option>
              <option value="france">France</option>
              <option value="netherlands">
                Netherlands
              </option>
              <option value="ireland">Ireland</option>
            </select>
            <small style="color: #666">Hold Ctrl/Cmd to select multiple</small>
          </div>

          {{-- <div class="form-group">
            <label for="tuition">Tuition Budget (per year) *</label>
            <div class="range-container">
              <input id="tuition" max="100000" min="0" name='tuition' step="1000"
                type="range" value="20000" />
              <span class="range-value" id="tuitionValue">$20,000</span>
            </div>
          </div> --}}

          <div class="form-group">
            <label for="tuition">Tuition(in $) *</label>
            <input id="tuition" max="100000" min="0" name="tuition" required
              type="number" />
          </div>

          <div class="checkbox-group">
            <input id="terms" name='terms' required type="checkbox" value="1" />
            <label for="terms">I agree to the
              <a href="#" style="color: #c6a43f">Terms and Conditions</a>
              and
              <a href="#" style="color: #c6a43f">Privacy Policy</a>
              *</label>
          </div>

          <button class="btn-submit" type="submit">
            Request Consultation
          </button>
        </form>
      </div>

      <!-- Right: Image -->
      <div class="consultation-image">
        <img alt="Diverse students studying together in a library"
          src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" />
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Get form elements
        const form = document.getElementById('consultationForm');

        // Get tuition range elements
        const tuitionRange = document.getElementById('tuition');
        const tuitionValue = document.getElementById('tuitionValue');

        // Function to update tuition value display
        function updateTuitionValue() {
          if (tuitionRange && tuitionValue) {
            const value = parseInt(tuitionRange.value);
            tuitionValue.textContent = '$' + value.toLocaleString();
          }
        }

        // Add event listeners for tuition range
        if (tuitionRange) {
          // Update when slider moves
          tuitionRange.addEventListener('input', updateTuitionValue);

          // Also update on change (for keyboard input)
          tuitionRange.addEventListener('change', updateTuitionValue);

          // Initial update to ensure display is correct
          updateTuitionValue();
        }

        // Handle form submission
        form.addEventListener('submit', async function(e) {
          e.preventDefault();

          // Get form data
          const programmesSelect = document.getElementById('programmes');
          const programmes = Array.from(programmesSelect.selectedOptions).map(option => option
            .value);

          const countriesSelect = document.getElementById('countries');
          const countries = Array.from(countriesSelect.selectedOptions).map(option => option
            .value);

          const formData = {
            fullname: document.getElementById('fullname').value.trim(),
            email: document.getElementById('email').value.trim(),
            phone: document.getElementById('phone').value.trim(),
            education: document.getElementById('education').value,
            programmes: programmes,
            countries: countries,
            tuition: parseInt(document.getElementById('tuition').value),
            terms: document.getElementById('terms').checked ? 'on' : null,
            _token: '{{ csrf_token() }}'
          };

          // Validate required fields
          if (!formData.fullname) {
            window.showToast('Please enter your full name.', 'error');
            return;
          }

          if (!formData.email) {
            window.showToast('Please enter your email address.', 'error');
            return;
          }

          // Validate email format
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(formData.email)) {
            window.showToast('Please enter a valid email address.', 'error');
            return;
          }

          if (!formData.phone) {
            window.showToast('Please enter your phone number.', 'error');
            return;
          }

          if (!formData.education) {
            window.showToast('Please select your level of education.', 'error');
            return;
          }

          if (formData.programmes.length === 0) {
            window.showToast('Please select at least one programme of interest.', 'error');
            return;
          }

          if (formData.countries.length === 0) {
            window.showToast('Please select at least one preferred country.', 'error');
            return;
          }

          if (!formData.terms) {
            window.showToast('You must agree to the Terms and Conditions and Privacy Policy.', 'error');
            return;
          }

          // Disable submit button and show loading state
          const submitBtn = form.querySelector('.btn-submit');
          const originalText = submitBtn.textContent;
          submitBtn.disabled = true;
          submitBtn.textContent = 'Submitting...';

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
              // Handle validation errors from backend
              if (result.errors) {
                const errorMessages = Object.values(result.errors).flat().join('\n');
                alert(errorMessages);
              } else if (result.message) {
                alert(result.message);
              } else {
                alert('Failed to submit your request. Please try again.');
              }
              return;
            }

            if (result.success) {
              // Show success toast
              window.showToast('Thank you! Your consultation request has been submitted successfully.', 'success');

              // Reset form
              form.reset();

              // Reset tuition slider to default
              if (tuitionRange) {
                tuitionRange.value = 20000;
                updateTuitionValue();
              }

              // Clear selected options from multiselects
              programmesSelect.selectedIndex = -1;
              countriesSelect.selectedIndex = -1;

              // Uncheck terms
              document.getElementById('terms').checked = false;
            } else {
              window.showToast(result.message || 'Failed to submit your request. Please try again.', 'error');
            }
          } catch (error) {
            console.error('Error:', error);
            window.showToast('An error occurred. Please try again later.', 'error');
          } finally {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
          }
        });
      });
    </script>
  </x-slot:scripts>
</x-app-layout>
