@props(['funding'])

<a href="{{ route('fundings.funding', $funding) }}" class="funding-card">
  <div class="funding-image">
    <img src="{{ $funding->image ?? 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80' }}" 
         alt="{{ $funding->name }}">
    <div class="funding-badge">{{ $funding->name }}</div>
  </div>
  <div class="funding-content">
    <h3 class="funding-title">{{ $funding->name }}</h3>
    <div class="funding-university">
      <i class="fas fa-university"></i>
      {{ $funding->university->name ?? 'Multiple Partner Universities' }}
    </div>
    <p class="funding-description">{{ Str::limit($funding->description, 120) }}</p>
    <div class="funding-footer">
      <span class="education-level">
        <i class="fas fa-graduation-cap"></i> {{ $funding->education_level }}
      </span>
      <span class="view-link">
        View Details <i class="fas fa-arrow-right"></i>
      </span>
    </div>
  </div>
</a>