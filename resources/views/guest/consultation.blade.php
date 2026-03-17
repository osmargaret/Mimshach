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
        border-radius: 50px;
        margin-top: 20px;
        display: none;
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

        <div class="success-message" id="successMessage">
          <i class="fas fa-check-circle"></i>
          Congratulation! You just took a great step.
        </div>

        <form id="consultationForm">
          <div class="form-group">
            <label for="fullname">Full Name *</label>
            <input id="fullname" required type="text" />
          </div>

          <div class="form-group">
            <label for="email">Email *</label>
            <input id="email" required type="email" />
          </div>

          <div class="form-group">
            <label for="phone">Phone *</label>
            <input id="phone" required type="tel" />
          </div>

          <div class="form-group">
            <label for="education">Level of Education *</label>
            <select id="education" required>
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
            <select id="programmes" multiple required size="4">
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
            <select id="countries" multiple required size="4">
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

          <div class="form-group">
            <label for="tuition">Tuition Budget (per year) *</label>
            <div class="range-container">
              <input id="tuition" max="100000" min="0" step="1000" type="range"
                value="20000" />
              <span class="range-value" id="tuitionValue">$20,000</span>
            </div>
          </div>

          <div class="checkbox-group">
            <input id="terms" required type="checkbox" />
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
</x-app-layout>
