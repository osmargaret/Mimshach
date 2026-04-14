<x-app-layout>
  <x-slot:styles>
    <style>
      /* Blog specific styles */
      /* contact section */
      .contact-section {
        margin: 60px 0;
      }

      .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        background: white;
        border-radius: 40px;
        padding: 50px;
        box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.1);
      }

      .contact-info h2 {
        font-size: 32px;
        margin-bottom: 20px;
      }

      .contact-info p {
        color: #4a5568;
        margin-bottom: 30px;
        font-size: 18px;
      }

      .info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
      }

      .info-icon {
        width: 50px;
        height: 50px;
        background: #f0eee9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #c6a43f;
        font-size: 20px;
      }

      .info-content h4 {
        font-size: 18px;
        margin-bottom: 5px;
      }

      .info-content p {
        margin-bottom: 0;
        color: #4a5568;
      }

      .social-links {
        display: flex;
        gap: 20px;
        margin-top: 30px;
      }

      .social-links a {
        width: 45px;
        height: 45px;
        background: #f0eee9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0a192f;
        font-size: 20px;
        transition: 0.2s;
      }

      .social-links a:hover {
        background: #c6a43f;
        color: white;
      }

      .contact-form h2 {
        font-size: 32px;
        margin-bottom: 20px;
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
      .form-group textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid #e0e0e0;
        border-radius: 30px;
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        background: #f9f7f5;
      }

      .form-group textarea {
        border-radius: 20px;
        resize: vertical;
      }

      .form-group input:focus,
      .form-group textarea:focus {
        outline: none;
        border-color: #c6a43f;
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

      /* map */
      .map-container {
        margin: 60px 0;
        border-radius: 40px;
        overflow: hidden;
        height: 400px;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
      }

      .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
      }

      @media (max-width: 768px) {
        .contact-grid {
          grid-template-columns: 1fr;
          padding: 30px;
        }

        .footer-grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </x-slot:styles>

  <x-page-header
    subtitle="Get in touch with our team - we're here to help you achieve your global education dreams"
    title="Contact Us" />

  <!-- Contact Section -->
  <div class="contact-section container">
    <div class="contact-grid">
      <!-- Left: Contact Info -->
      <div class="contact-info">
        <h2>Let's Connect</h2>
        <p>
          Whether you have questions about admissions,
          funding, or our services, we're ready to assist
          you.
        </p>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="info-content">
            <h4>Visit Us</h4>
            <p>
              Simon Mwansa kapwepwe Avenue,<br />12,
              Avondale
            </p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-phone-alt"></i>
          </div>
          <div class="info-content">
            <h4>Call Us</h4>
            <p>+260973260412<br />Mon-Fri 9am-6pm GMT</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="info-content">
            <h4>Email Us</h4>
            <p>Info@mimshachconsultancy.com<br /></p>
          </div>
        </div>

        <div class="social-links">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Right: Contact Form -->
      <div class="contact-form">
        <h2>Send a Message</h2>
        <form id="contactForm">
          @csrf
          <div class="form-group">
            <label for="name">Full Name *</label>
            <input id="name" name="name" required type="text" />
          </div>
          <div class="form-group">
            <label for="email">Email *</label>
            <input id="email" name="email" required type="email" />
          </div>
          <div class="form-group">
            <label for="subject">Subject *</label>
            <input id="subject" name="subject" type="text" />
          </div>
          <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" required rows="5"></textarea>
          </div>
          <button class="btn-submit" type="submit">
            Send Message
          </button>
        </form>
      </div>
    </div>

    <!-- Map -->
    <div class="map-container">
      <iframe allowfullscreen="" loading="lazy"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.5454374764347!2d-0.10553468422931346!3d51.51411747963698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b4b3e2e1b7f%3A0x8f8b6f8f8f8f8f8f!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1620000000000"></iframe>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');

        form.addEventListener('submit', async function(e) {
          e.preventDefault();

          // Get form data
          const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,
            _token: '{{ csrf_token() }}'
          };
          console.log('Form Data:', formData);

          // Disable submit button and show loading state
          const submitBtn = form.querySelector('.btn-submit');
          const originalText = submitBtn.textContent;
          submitBtn.disabled = true;
          submitBtn.textContent = 'Sending...';

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
            // console.log('Response:', response);

            if (result.success) {
              // Show success toast
              window.showToast('Thank you for your message! We\'ll get back to you soon.', 'success');

              // Reset form
              form.reset();
            } else {
              window.showToast(result.message || 'Failed to send message. Please try again.', 'error');
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
