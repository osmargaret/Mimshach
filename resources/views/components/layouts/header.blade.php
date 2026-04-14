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
</nav>
