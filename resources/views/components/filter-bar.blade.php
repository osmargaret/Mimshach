@props([
    'filters' => [],
    'action' => url()->current(),
    'method' => 'GET'
])

<style>
  /* filter bar */
  .filter-bar {
    background: white;
    border-radius: 30px;
    padding: 25px 30px;
    margin-top: -40px;
    box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 10;
  }

  .filter-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
  }

  .search-box {
    flex: 2;
    min-width: 240px;
    display: flex;
    align-items: center;
    background: #F9F7F5;
    border-radius: 50px;
    padding: 0 20px;
    border: 1px solid #e0e0e0;
  }

  .search-box i {
    color: #C6A43F;
  }

  .search-box input {
    width: 100%;
    padding: 14px 10px;
    border: none;
    background: transparent;
    font-size: 16px;
    outline: none;
  }

  .filter-checkboxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: center;
    flex: 3;
  }

  .filter-checkboxes label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 500;
    cursor: pointer;
  }

  .filter-checkboxes input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #C6A43F;
  }

  .filter-select {
    flex: 1;
    min-width: 150px;
    padding: 12px 20px;
    border: 1px solid #e0e0e0;
    border-radius: 50px;
    font-family: 'Inter', sans-serif;
    background: #F9F7F5;
    color: #0A192F;
    cursor: pointer;
    font-size: 15px;
  }

  .clear-btn {
    background: transparent;
    border: 2px solid #C6A43F;
    color: #0A192F;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
    white-space: nowrap;
    text-decoration: none;
  }

  .clear-btn:hover {
    background: #C6A43F;
    color: white;
  }
</style>

<div class="filter-bar">
  <form action="{{ $action }}" method="{{ $method }}">
    <div class="filter-row">

      @foreach ($filters as $filter)
        @php
          $type = $filter['type'] ?? 'text';
          $name = $filter['name'] ?? null;

          // Ensure we have a consistent value for multi-value controls
          $value = request($name);
          $values = is_array($value) ? $value : (array) $value;
        @endphp

        @switch($type)
          {{-- SEARCH INPUT --}}
          @case('search')
            <div class="search-box">
              <input name="{{ $name }}" placeholder="{{ $filter['placeholder'] ?? '' }}"
                type="text" value="{{ $value }}">
            </div>
          @break

          {{-- TEXT INPUT --}}
          @case('text')
            <div class="search-box">
              <input name="{{ $name }}" placeholder="{{ $filter['placeholder'] ?? '' }}"
                type="text" value="{{ $value }}">
            </div>
          @break

          {{-- DATE INPUT --}}
          @case('date')
            <div class="search-box">
              <input name="{{ $name }}" type="date" value="{{ $value }}">
            </div>
          @break

          {{-- SELECT DROPDOWN --}}
          @case('select')
            <select class="filter-select" name="{{ $name }}">
              @foreach ($filter['options'] as $option)
                <option @selected($value == $option) value="{{ $option }}">
                  {{ $option }}
                </option>
              @endforeach
            </select>
          @break

          {{-- RADIO BUTTONS --}}
          @case('radio')
            <div class="filter-select">
              <label>{{ $filter['label'] }}</label>

              <div class="radio-group">
                @foreach ($filter['options'] as $option)
                  <label>
                    <input @checked($value == ($option['value'] ?? $option)) name="{{ $name }}" type="radio"
                      value="{{ $option['value'] ?? $option }}">
                    {{ $option['label'] ?? $option }}
                  </label>
                @endforeach
              </div>
            </div>
          @break

          {{-- CHECKBOX GROUP --}}
          @case('checkboxes')
            <div class="filter-checkboxes">
              @foreach ($filter['options'] as $option)
                @php
                  $optValue = $option['value'] ?? $option;
                  $optLabel = $option['label'] ?? $option;
                @endphp

                <label>
                  <input @checked(in_array($optValue, $values)) name="{{ $name }}[]" type="checkbox"
                    value="{{ $optValue }}">
                  {{ $optLabel }}
                </label>
              @endforeach
            </div>
          @break

          {{-- FALLBACK (plain input) --}}

          @default
            <div class="search-box">
              <input name="{{ $name }}" type="text" value="{{ $value }}">
            </div>
        @endswitch
      @endforeach

      @php
        $hasActiveFilters = false;
        foreach ($filters as $filter) {
            $name = $filter['name'] ?? null;
            if ($name && request()->has($name) && !empty(request($name))) {
                $hasActiveFilters = true;
                break;
            }
        }
      @endphp

      @if ($hasActiveFilters)
        <a class="clear-btn" href="{{ url()->current() }}" id="clearFilters">Clear Filters</a>
      @endif

    </div>
  </form>
</div>
