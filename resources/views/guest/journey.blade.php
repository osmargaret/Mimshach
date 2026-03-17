<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Start Your Journey | Mimshach</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
      rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: 'Inter', sans-serif;
        background: #F9F7F5;
        color: #0A192F;
        line-height: 1.6;
      }

      .container {
        max-width: 700px;
        margin: 80px auto;
        padding: 40px;
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
      }

      h1 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        margin-bottom: 16px;
        color: #0A192F;
      }

      .back-link {
        margin-bottom: 30px;
        display: inline-block;
        color: #C6A43F;
        text-decoration: none;
        font-weight: 500;
      }

      .back-link i {
        margin-right: 8px;
      }

      .form-group {
        margin-bottom: 24px;
      }

      label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
      }

      input,
      select,
      textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid #ddd;
        border-radius: 50px;
        font-size: 16px;
        font-family: 'Inter', sans-serif;
      }

      textarea {
        border-radius: 20px;
        resize: vertical;
      }

      button {
        background: #C6A43F;
        color: #0A192F;
        border: none;
        padding: 16px 40px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 18px;
        cursor: pointer;
        width: 100%;
        transition: 0.2s;
      }

      button:hover {
        background: #b38f2e;
        transform: translateY(-2px);
      }

      .note {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
        text-align: center;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <a class="back-link" href="index.html"><i class="fas fa-arrow-left"></i> Back to Home</a>
      <h1>Start Your Journey</h1>
      <p style="margin-bottom: 30px; font-size: 18px;">Fill in your details and we’ll get back to
        you within 24 hours.</p>
      <form>
        <div class="form-group">
          <label>Full name *</label>
          <input placeholder="e.g., Sarah Johnson" required type="text">
        </div>
        <div class="form-group">
          <label>Email address *</label>
          <input placeholder="sarah@example.com" required type="email">
        </div>
        <div class="form-group">
          <label>Phone number</label>
          <input placeholder="+44 ..." type="tel">
        </div>
        <div class="form-group">
          <label>Country of interest</label>
          <select>
            <option>United Kingdom</option>
            <option>United States</option>
            <option>Canada</option>
            <option>Australia</option>
            <option>Germany</option>
            <option>Other</option>
          </select>
        </div>
        <div class="form-group">
          <label>Level of study</label>
          <select>
            <option>Undergraduate</option>
            <option>Postgraduate</option>
            <option>PhD</option>
            <option>Diploma</option>
          </select>
        </div>
        <div class="form-group">
          <label>Message (optional)</label>
          <textarea placeholder="Tell us about your goals..." rows="4"></textarea>
        </div>
        <button onclick="window.location.href='Starthere.html'" type="button">Submit
          Request</button>
        <p class="note">We respect your privacy. No spam.</p>
      </form>
    </div>
  </body>
</html>
