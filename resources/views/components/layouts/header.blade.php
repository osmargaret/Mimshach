@php
  $links = config('data.links');
@endphp

<!-- Navigation -->
<nav class="navbar" id="navbar">
  <div class="logo">MIMSHACH</div>
  <button aria-label="Toggle navigation" class="nav-toggle" id="navToggle"><i
      class="fas fa-bars"></i></button>
  <ul class="nav-menu" id="navMenu">
    @foreach ($links as $link)
      @if(Route::has($link['route']))
        <li>
          <a href="{{ route($link['route']) }}" class="@if(request()->routeIs($link['route'])) active @endif {{ $link['style'] ?? '' }}">
        {{ $link['label'] }}
          </a>
        </li>
      @else
        <li>
          <a href="#"
         @isset($link['class']) class="{{ $link['class'] }} disabled" @else class="disabled" @endisset>
        {{ $link['label'] }} (Coming Soon)
          </a>
        </li>
      @endif
    @endforeach
  </ul>

  {{-- <ul class="nav-menu" id="navMenu">
    <li><a href="index.html">Home</a></li>
    <li><a href="Admission.html">Admission</a></li>
    <li>
      <a href="studentloanselect.html">Student Funding</a>
      <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
      <ul class="dropdown-content">
        <li><a href="studentloanselect.html">Student Loan</a></li>
        <li><a href="scholarship.html">Scholarship</a></li>
        <li><a href="grant.html">Grants</a></li>
      </ul>
    </li>
    <li><a href="Universities.html">Universities</a></li>
    <li><a href="event.html">Events</a></li>
    <li><a href="event.html">Blog</a></li>
    <li><a href="contact.html">Contact</a></li>
    <li><a class="nav-cta" href="StartHere.html">Start Here</a></li>
  </ul> --}}
</nav>
