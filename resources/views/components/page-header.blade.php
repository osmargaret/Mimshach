@props(['title', 'subtitle'])

<style>
  /* page header */
  .page-header {
    background: #0A192F;
    color: white;
    padding: 140px 0 60px;
    text-align: center;
  }

  .page-header h1 {
    font-size: 56px;
    margin-bottom: 16px;
  }

  .page-header p {
    font-size: 18px;
    opacity: 0.8;
    max-width: 600px;
    margin: 0 auto;
  }
</style>

<!-- Page Header -->
<section class="page-header">
  <div class="container">
    <h1>{{ $title }}</h1>
    <p>{{ $subtitle }}</p>
  </div>
</section>
