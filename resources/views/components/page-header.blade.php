@props(['title', 'subtitle'])

<!-- Page Header -->
<section class="bg-primary text-white py-28 flex flex-col items-center justify-center text-center">
  <div class="container">
    <h1 class='text-4xl md:text-6xl mb-10'>{{ $title }}</h1>
    <p class='text-sm md:text-xl max-w-xs sm:max-w-sm md:max-w-md lg:max-w-2xl mx-auto'>{{ $subtitle }}</p>
  </div>
</section>
